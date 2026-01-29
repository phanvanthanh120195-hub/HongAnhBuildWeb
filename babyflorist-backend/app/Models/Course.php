<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'price',
        'sale_price',
        'discount_percent',
        'thumbnail',
        'instructor',
        'lesson_count',
        'student_count',
        'is_active',
        'sale_start',
        'sale_end',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
    ];
}
