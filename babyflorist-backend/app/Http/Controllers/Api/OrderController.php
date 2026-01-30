<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Course;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Create a new order
     */
    public function store(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Order Store Start', $request->all());
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            // course_id is now optional (for cart checkout)
            'course_id' => 'nullable|exists:courses,id',
            'items' => 'nullable|array', // For cart checkout
            'bank_id' => 'nullable', // Optional if COD
            'voucher_code' => 'nullable|string',
            'payment_method' => 'nullable|string' // bank or cod or qr_code
        ]);

        try {
            DB::beginTransaction();
             \Illuminate\Support\Facades\Log::info('Transaction Started');

            $originalPrice = 0;
            $orderItemsData = [];
            $notes = '';
            $orderType = 'product'; // Default

            // CASE 1: Single Course Checkout (Legacy/Direct)
            if ($request->has('course_id')) {
                $course = Course::findOrFail($request->course_id);
                $originalPrice = $course->sale_price ?? $course->price;
                $notes = 'Đăng ký khóa học: ' . $course->name;
                $orderType = 'course';
                
                $orderItemsData[] = [
                    'item_type' => 'course',
                    'item_id' => $course->id,
                    'item_name' => $course->name,
                    'item_price' => $originalPrice,
                    'quantity' => 1,
                    'subtotal' => $originalPrice
                ];
            } 
            // CASE 2: Cart Checkout (Multiple Products)
            else if ($request->has('items') && is_array($request->items)) {
                foreach ($request->items as $item) {
                    // Assuming item has { id, quantity }
                    // We need to fetch Product to get price for security
                    $product = \App\Models\Product::find($item['id']);
                    if (!$product) continue;

                    $price = $product->sale_price ?? $product->price;
                    $qty = $item['quantity'] ?? 1;
                    $subtotal = $price * $qty;

                    $originalPrice += $subtotal;
                    
                    $orderItemsData[] = [
                        'item_type' => 'product',
                        'item_id' => $product->id,
                        'item_name' => $product->name,
                        'item_price' => $price,
                        'quantity' => $qty,
                        'subtotal' => $subtotal
                    ];
                }
                $notes = 'Đơn hàng mua sản phẩm (' . count($orderItemsData) . ' món)';
            } else {
                 return response()->json(['success' => false, 'message' => 'No items provided'], 400);
            }
            
            $discountAmount = 0;
            $voucherCode = $request->voucher_code;

            // Validate Voucher Server-side again
            if ($voucherCode) {
                $voucher = Voucher::where('code', $voucherCode)
                    ->where('is_active', true)
                    ->first();
                
                if ($voucher) {
                    $now = Carbon::now();
                    if (
                        (!$voucher->valid_from || $now->gte($voucher->valid_from)) &&
                        (!$voucher->valid_to || $now->lte($voucher->valid_to)) &&
                        (!$voucher->usage_limit || $voucher->used_count < $voucher->usage_limit)
                    ) {
                        // Apply percentage discount
                        if ($voucher->discount_percentage > 0) {
                            $discountAmount = ($originalPrice * $voucher->discount_percentage) / 100;
                        }
                    }
                }
            }

            // Determine User ID
            $userId = auth('sanctum')->id();
            
            if (!$userId && $request->email) {
                // Try to find user by email
                $existingUser = \App\Models\User::where('email', $request->email)->first();
                if ($existingUser) {
                    $userId = $existingUser->id;
                } else {
                    // Create new user for Guest
                    $newUser = \App\Models\User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' => bcrypt(Str::random(10)), // Random password
                        'is_active' => true 
                    ]);
                    $userId = $newUser->id;
                }
            }

             \Illuminate\Support\Facades\Log::info('User ID Determined: ' . $userId);

            $finalAmount = max(0, $originalPrice - $discountAmount);

            // Create Order
             \Illuminate\Support\Facades\Log::info('Creating Order...');
            $order = Order::create([
                'order_number' => $this->generateOrderNumber(),
                'order_type' => $orderType,
                'user_id' => $userId,
                'total_amount' => $originalPrice,
                'discount_amount' => $discountAmount,
                'final_amount' => $finalAmount,
                'voucher_code' => $voucherCode,
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'payment_method' => 'qr_code',
                'shipping_name' => $request->name,
                'shipping_phone' => $request->phone,
                'shipping_address' => $request->address ?? 'N/A', 
                'notes' => $notes
            ]);
             \Illuminate\Support\Facades\Log::info('Order Created ID: ' . $order->id);

            // Create Order Items
             \Illuminate\Support\Facades\Log::info('Creating Order Items...');
            foreach ($orderItemsData as $itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);
            }

            // Increment voucher usage
            if (isset($voucher)) {
                $voucher->increment('used_count');
            }

            DB::commit();
             \Illuminate\Support\Facades\Log::info('Order Commit Success');

            return response()->json([
                'success' => true,
                'message' => 'Tạo đơn hàng thành công',
                'data' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'final_amount' => $finalAmount
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
             \Illuminate\Support\Facades\Log::error('Order Error: ' . $e->getMessage());
             \Illuminate\Support\Facades\Log::error($e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi tạo đơn hàng: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Customer confirms transfer
     */
    public function confirm($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Đơn hàng không tồn tại'], 404);
        }

        // Check if already confirmed/paid to avoid spam
        if ($order->payment_status === 'paid') {
             return response()->json(['success' => true, 'message' => 'Đơn hàng đã được thanh toán']);
        }

        // Update status or note
        // User requirement: "Cập nhật trạng thái dơn hàng = Chờ xác nhận"
        // Since we use 'pending' as default, we can perhaps add a flag or text to notes. 
        // Or if 'pending' IS 'Chờ xác nhận', we just acknowledge.
        // Let's append to notes for Clarity
        $order->notes = $order->notes . " | Khách xác nhận đã chuyển khoản lúc " . now()->format('H:i d/m');
        // $order->order_status = 'pending'; // Explicitly set ensure
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Đã gửi xác nhận thanh toán. Vui lòng chờ Admin duyệt.'
        ]);
    }

    private function generateOrderNumber()
    {
        // Format: ORD-{Year}{Month}{Day}-{Random}
        // or just random 5 chars as user requested previously "5-char Order Code"
        // User said: "Stores the generated 5-char Order Code in order_number"
        // I will stick to 5-char random upper string to match frontend logic
        do {
            $code = Str::upper(Str::random(5));
        } while (Order::where('order_number', $code)->exists());

        return $code;
    }
}
