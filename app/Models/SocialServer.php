<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_service_id',
        'name',
        'price_per_unit',
        'min_quantity',
        'max_quantity',
        'description',
        'status'
    ];

    protected $casts = [
        'price_per_unit' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(SocialService::class, 'social_service_id');
    }

    public function orders()
    {
        return $this->hasMany(SocialOrder::class);
    }
}
