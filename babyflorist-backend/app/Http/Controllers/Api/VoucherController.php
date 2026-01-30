<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = $request->code;
        $now = Carbon::now();

        $voucher = Voucher::where('code', $code)
            ->where('is_active', true)
            ->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không tồn tại hoặc không hợp lệ'
            ], 404); // Or 400
        }

        // Check dates
        if ($voucher->valid_from && $now->lt($voucher->valid_from)) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá chưa đến thời gian sử dụng'
            ], 400);
        }

        if ($voucher->valid_to && $now->gt($voucher->valid_to)) {
             return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết hạn'
            ], 400);
        }

         // Check usage limit
        if ($voucher->usage_limit && $voucher->used_count >= $voucher->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết lượt sử dụng'
            ], 400);
        }

        // Return voucher info
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $voucher->id,
                'code' => $voucher->code,
                'discount_percentage' => $voucher->discount_percentage,
                // Add fixed amount logic if schema supports it later, currently model only has percentage
            ]
        ]);
    }
}
