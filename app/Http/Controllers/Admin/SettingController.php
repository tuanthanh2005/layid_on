<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Trang cấu hình giao diện chung
     */
    public function interface()
    {
        try {
            $settings = Setting::where('group', 'interface')->orWhere('key', 'favicon')->get()
                               ->pluck('value', 'key');
        } catch (\Throwable $e) {
            // Nếu bảng chưa có, trả về mảng rỗng để không bị lỗi 500
            $settings = collect([]);
        }
        
        return view('admin.settings.interface', compact('settings'));
    }

    /**
     * Lưu cấu hình chung
     */
    public function updateInterface(Request $request)
    {
        // 1. Xử lý Favicon (Nếu có file mới)
        if ($request->hasFile('favicon_file')) {
            $file = $request->file('favicon_file');
            // Favicon thường nên đặt tên là favicon.png hoặc dùng timestamp để tránh cache
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/system', $filename, 'public_uploads');
            Setting::set('favicon', '/uploads/system/' . $filename, 'image', 'interface');
        }

        // 2. Xử lý Màu Theme
        if ($request->has('theme_color')) {
            Setting::set('theme_color', $request->theme_color, 'color', 'interface');
        }

        // 3. Xử lý Màu Theme Sub (Thứ cấp)
        if ($request->has('theme_color_sub')) {
            Setting::set('theme_color_sub', $request->theme_color_sub, 'color', 'interface');
        }

        // Màu Nền
        if ($request->has('bg_color')) {
            Setting::set('bg_color', $request->bg_color, 'color', 'interface');
        }

        // Màu Chữ
        if ($request->has('text_color')) {
            Setting::set('text_color', $request->text_color, 'color', 'interface');
        }

        // Tiêu đề Website
        if ($request->has('site_title')) {
            Setting::set('site_title', $request->site_title, 'text', 'interface');
        }

        // Mã xác minh Google
        if ($request->has('google_verification')) {
            // Trim lấy mã sạch
            $code = trim($request->google_verification);
            Setting::set('google_verification', $code, 'text', 'interface');
        }

        return redirect()->back()->with('success', 'Đã cập nhật giao diện thành công!');
    }
}
