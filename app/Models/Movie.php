<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'slug', 'original_title', 'genre', 'country', 'release_year',
        'director', 'duration_text', 'rating', 'rating_label',
        'thumbnail', 'icon', 'color',
        'summary', 'content', 'trailer_url', 'tags',
        'status', 'is_featured', 'is_interested', 'is_trending', 'is_main_featured',
        'meta_title', 'meta_description', 'views', 'order',
    ];

    protected $casts = [
        'status'          => 'boolean',
        'is_featured'     => 'boolean',
        'is_interested'   => 'boolean',
        'is_trending'     => 'boolean',
        'is_main_featured'=> 'boolean',
        'rating'          => 'float',
        'release_year'    => 'integer',
    ];

    // Helper: trả về mảng tags
    public function getTagsArrayAttribute(): array
    {
        if (!$this->tags) return [];
        return array_map('trim', explode(',', $this->tags));
    }

    // Route-model binding theo slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
