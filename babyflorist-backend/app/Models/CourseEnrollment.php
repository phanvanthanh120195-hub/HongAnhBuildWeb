<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    protected $fillable = [
        'customer_id',
        'course_id',
        'order_id',
        'is_active',
        'purchased_at',
        'progress',
        'last_accessed_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'purchased_at' => 'datetime',
        'last_accessed_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

