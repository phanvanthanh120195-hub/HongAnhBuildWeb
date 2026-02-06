<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseCurriculumItem extends Model
{
    use HasFactory;

    protected $table = 'course_curriculum_items';

    protected $fillable = [
        'curriculum_id',
        'icon',
        'content',
        'sort_order',
    ];

    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(CourseCurriculum::class, 'curriculum_id');
    }
}
