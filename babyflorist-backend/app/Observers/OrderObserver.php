<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\CourseEnrollment;
use Illuminate\Support\Carbon;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // 1. Sync Enrollment Status
        $this->syncEnrollmentStatus($order);

        // 2. Handle Payment Creation if explicitly successful
        $isPaid = $order->payment_status === 'paid';
        $isCompleted = $order->order_status === 'completed';
        $wasPaid = $order->getOriginal('payment_status') === 'paid';

        if ($isPaid && !$wasPaid) {
            $this->createPaymentRecord($order);
        }
    }

    protected function syncEnrollmentStatus(Order $order)
    {
        // Skip if order has no customer (guest checkout without email)
        if (!$order->customer_id) {
            return;
        }

        // Only process course orders
        if ($order->order_type !== 'course') {
            return;
        }

        // Determine Target Enrollment Status (Is Active)
        $isActive = false;

        if ($order->payment_status === 'paid' || $order->order_status === 'completed' || $order->order_status === 'shipping') {
            $isActive = true;
        }

        // Get Course Items
        $items = OrderItem::where('order_id', $order->id)
            ->where('item_type', 'course')
            ->get();

        foreach ($items as $item) {
            CourseEnrollment::updateOrCreate(
                [
                    'customer_id' => $order->customer_id,
                    'course_id' => $item->item_id,
                ],
                [
                    'order_id' => $order->id,
                    'is_active' => $isActive,
                    'purchased_at' => $order->created_at,
                ]
            );
        }
    }

    protected function createPaymentRecord(Order $order)
    {
        $existingPayment = Payment::where('order_id', $order->id)->where('status', 'success')->exists();

        if (!$existingPayment) {
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'bank_transfer',
                'amount' => $order->final_amount,
                'status' => 'success',
                'transfer_content' => "Thanh toán cho đơn hàng #{$order->order_number}",
            ]);
        }
    }
}

