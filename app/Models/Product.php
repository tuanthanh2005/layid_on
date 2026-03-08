<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'image',
        'url',
        'badge_text',
        'status',
        'order_index',
    ];

    protected $casts = [
        'status' => 'boolean',
        'price' => 'decimal:0',
        'discount_price' => 'decimal:0',
    ];
}
