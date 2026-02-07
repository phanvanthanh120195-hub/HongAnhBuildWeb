<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'format',
        'label',
        'name',
        'subtitle',
        'slug',
        'type',
        'description',
        'content',
        'location',
        'targets',
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
        'start_time',
        'end_time',
        'course_category_id',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'targets' => 'array',
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    protected $appends = ['remaining_slots'];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function faqs()
    {
        return $this->hasMany(CourseFAQ::class)->orderBy('sort_order');
    }

    public function curriculums()
    {
        return $this->hasMany(CourseCurriculum::class)->orderBy('sort_order');
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class)->where('is_active', true)->orderByDesc('created_at');
    }

    public function highlights()
    {
        return $this->hasMany(CourseHighlight::class)->orderBy('sort_order');
    }

    public function experiences()
    {
        return $this->hasMany(WorkshopExperience::class)->orderBy('sort_order');
    }

    public function benefits()
    {
        return $this->hasMany(CourseBenefit::class)->orderBy('sort_order');
    }

    public function getRemainingSlotsAttribute()
    {
        $enrolled = $this->enrollments()->where('is_active', true)->count();
        return max(0, $this->student_count - $enrolled);
    }
}
