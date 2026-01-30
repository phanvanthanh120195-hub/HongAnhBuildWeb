<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'order_type',
        'customer_id',
        'total_amount',
        'discount_amount',
        'shipping_fee',
        'final_amount',
        'voucher_code',
        'payment_status',
        'payment_method',
        'bank_id',
        'payment_reference',
        'paid_at',
        'expired_at',
        'order_status',
        'shipping_status',
        'shipping_method',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'notes',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }
}

