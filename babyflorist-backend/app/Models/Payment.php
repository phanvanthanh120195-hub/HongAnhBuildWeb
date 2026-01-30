<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_method',
        'bank_id',
        'amount',
        'transfer_content',
        'transaction_code',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function bank()
    {
        return $this->belongsTo(QrCode::class, 'bank_id');
    }
}
