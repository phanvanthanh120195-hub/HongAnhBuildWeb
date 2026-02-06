<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseCurriculum extends Model
{
    use HasFactory;

    protected $table = 'course_curriculums';

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'sort_order',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CourseCurriculumItem::class, 'curriculum_id')->orderBy('sort_order');
    }

    protected static function booted(): void
    {
        static::saved(function (self $model) {
            if (blank($model->title)) {
                $model->delete();
            }
        });
    }
}
