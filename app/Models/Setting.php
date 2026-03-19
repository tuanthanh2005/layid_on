<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'type', 'group'];

    /**
     * Hàm lấy giá trị nhanh: Setting::getVal('favicon', '/favicon.ico')
     */
    public static function getVal($key, $default = null)
    {
        try {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Throwable $e) {
            // Nếu bảng chưa tồn tại hoặc lỗi DB, trả về giá trị mặc định luôn
            return $default;
        }
    }
    
    /**
     * Hàm set giá trị nhanh: Setting::set('favicon', 'path/to/icon')
     */
    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
    }
}
