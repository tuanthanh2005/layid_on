<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    /**
     * Gửi thông báo tới admin qua Telegram
     */
    public static function notifyAdmin($message)
    {
        $token = Setting::getVal('telegram_bot_token');
        $chatId = Setting::getVal('telegram_admin_chat_id');

        if (!$token || !$chatId) {
            Log::warning('Telegram Notification failed: Token or Chat ID not set.');
            return false;
        }

        try {
            $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ]);

            if ($response->failed()) {
                Log::error('Telegram API Error: ' . $response->body());
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Telegram Exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Tạo nội dung thông báo đơn hàng mới
     */
    public static function sendNewOrder($order)
    {
        $user = $order->user;
        $userName = $user ? $user->name : 'Khách vãng lai';
        $userEmail = $user ? $user->email : 'N/A';
        
        $msg = "<b>🔔 THÔNG BÁO ĐƠN HÀNG MỚI</b>\n";
        $msg .= "--------------------------------\n";
        $msg .= "🔹 <b>Mã đơn:</b> <code>{$order->order_number}</code>\n";
        $msg .= "🔹 <b>Tổng tiền:</b> <code>" . number_format($order->total_amount) . "đ</code>\n";
        $msg .= "🔹 <b>Phương thức:</b> {$order->payment_method}\n";
        $msg .= "🔹 <b>Chi tiết:</b> {$order->notes}\n";
        $msg .= "--------------------------------\n";
        $msg .= "👤 <b>Người mua:</b> {$userName}\n";
        $msg .= "📧 <b>Email:</b> {$userEmail}\n";
        $msg .= "📍 <b>Thời gian:</b> " . now()->format('d/m/Y H:i:s') . "\n";
        $msg .= "--------------------------------\n";
        $msg .= "🔗 <a href='" . route('admin.orders.show', $order->id) . "'>Xem chi tiết trong Admin</a>";

        return self::notifyAdmin($msg);
    }
}
