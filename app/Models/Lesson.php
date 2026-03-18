<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'slug', 'video_url', 'video_type', 'content', 'order', 'is_free'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
