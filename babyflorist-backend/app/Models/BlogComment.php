<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'blog_comments';

    protected $fillable = [
        'blog_post_id',
        'customer_id',
        'content',
        'parent_id',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function parent()
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id');
    }

    /**
     * Kiểm tra xem comment này có phải từ admin không
     */
    public function isFromAdmin(): bool
    {
        return $this->customer && $this->customer->customer_type === 'admin';
    }
}
