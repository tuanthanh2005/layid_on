<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'social_server_id',
        'link',
        'quantity',
        'total_price',
        'note',
        'status',
        'payment_status'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function server()
    {
        return $this->belongsTo(SocialServer::class, 'social_server_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
