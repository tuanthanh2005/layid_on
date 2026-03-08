<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'icon',
        'color',
        'status',
        'order_index',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
