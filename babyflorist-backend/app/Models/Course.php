<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'format',
        'label',
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
        'is_featured',
        'is_active',
        'sale_start',
        'sale_end',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
    ];

    protected $appends = ['remaining_slots'];

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function getRemainingSlotsAttribute()
    {
        $enrolled = $this->enrollments()->where('is_active', true)->count();
        return max(0, $this->student_count - $enrolled);
    }
}
