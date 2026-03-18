<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialService extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'status', 'show_on_home', 'order'];

    public function servers()
    {
        return $this->hasMany(SocialServer::class);
    }
}
