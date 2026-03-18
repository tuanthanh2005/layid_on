<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 
        'thumbnail', 'icon', 'color',
        'meta_title', 'meta_description',
        'status', 'is_featured', 'is_grid', 'is_trending', 'is_recommended', 'is_interested', 'is_video', 'is_blog_sidebar',
        'views', 'comments_count'
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'is_grid' => 'boolean',
        'is_trending' => 'boolean',
        'is_recommended' => 'boolean',
        'is_interested' => 'boolean',
        'is_video' => 'boolean',
        'is_blog_sidebar' => 'boolean',
    ];
}
