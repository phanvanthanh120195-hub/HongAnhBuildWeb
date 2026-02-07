<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkshopExperience extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'image',
        'sort_order',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
