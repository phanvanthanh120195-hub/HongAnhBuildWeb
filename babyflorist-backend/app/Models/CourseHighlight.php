<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseHighlight extends Model
{
    protected $fillable = [
        'course_id',
        'content',
        'sort_order',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    protected static function booted(): void
    {
        static::saved(function (self $model) {
            if (blank($model->content)) {
                $model->delete();
            }
        });
    }
}
