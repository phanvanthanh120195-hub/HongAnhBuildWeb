<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedReview extends Model
{
    protected $fillable = [
        'source_type',
        'source_id',
        'display_name',
        'display_avatar',
        'display_label',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the product review if source_type is 'product'
     */
    public function productReview()
    {
        return $this->belongsTo(ProductReview::class, 'source_id');
    }

    /**
     * Get the course review if source_type is 'course'
     */
    public function courseReview()
    {
        return $this->belongsTo(CourseReview::class, 'source_id');
    }

    /**
     * Get the review (product or course) dynamically
     */
    public function getReviewAttribute()
    {
        if ($this->source_type === 'product') {
            return $this->productReview;
        } elseif ($this->source_type === 'course') {
            return $this->courseReview;
        }
        return null;
    }

    /**
     * Get display name or fallback to customer name
     */
    public function getDisplayNameAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        $review = $this->review;
        return $review?->customer->name ?? 'N/A';
    }

    /**
     * Helper to get original content safely
     */
    public function getContentAttribute()
    {
        $review = $this->review;
        return $review?->content;
    }

    /**
     * Helper to get original rating safely
     */
    public function getRatingAttribute()
    {
        $review = $this->review;
        return $review?->rating;
    }
}
