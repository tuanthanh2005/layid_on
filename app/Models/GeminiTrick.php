<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeminiTrick extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'image', 'status', 'order'
    ];
}
