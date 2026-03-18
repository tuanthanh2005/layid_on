<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'thumbnail', 'description', 'level', 'duration', 'status', 'order'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }
}
