<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProxyOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'proxy_id',
        'approved_by',
        'order_number',
        'proxy_name',
        'proxy_type',
        'proxy_protocol',
        'quantity',
        'unit_price',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'buyer_telegram',
        'customer_note',
        'admin_note',
        'proxy_host',
        'proxy_port',
        'proxy_username',
        'proxy_password',
        'proxy_protocol_delivered',
        'proxy_ip_list',
        'proxy_whitelist',
        'proxy_connection_limit',
        'proxy_expires_at',
        'proxy_setup_guide',
        'delivery_note',
        'approved_at',
    ];

    protected $casts = [
        'unit_price' => 'decimal:0',
        'total_amount' => 'decimal:0',
        'proxy_expires_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proxy()
    {
        return $this->belongsTo(Proxy::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
