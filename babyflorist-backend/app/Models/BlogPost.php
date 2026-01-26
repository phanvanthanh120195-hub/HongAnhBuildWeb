<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
        'published_at',
        'category',
        'tags',
    ];

    protected $casts = [
        'published_at' => 'date',
        'tags' => 'array',
    ];
}
