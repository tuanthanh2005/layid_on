<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'protocol',
        'location',
        'duration',
        'bandwidth',
        'stock',
        'price',
        'original_price',
        'badge_text',
        'purchase_link',
        'description',
        'is_featured',
        'status',
        'order_index',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:0',
        'original_price' => 'decimal:0',
    ];
}
