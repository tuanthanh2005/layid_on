<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utility;

class UtilitySeeder extends Seeder
{
    public function run(): void
    {
        Utility::truncate();
        
        $data = [
            [
                'title' => 'Xóa Logo Gemini',
                'description' => 'AI Xóa logo ảnh cực nhanh.',
                'icon' => 'fa-solid fa-wand-magic-sparkles',
                'color' => 'linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%)',
                'url' => '/tools/remove-gemini-logo',
                'order_index' => 0,
                'status' => true,
            ],
            [
                'title' => 'Tóm tắt YouTube bằng AI',
                'description' => 'Dán link YouTube, AI tóm tắt nội dung cực nhanh.',
                'icon' => 'fa-brands fa-youtube',
                'color' => 'linear-gradient(135deg, #FF0000 0%, #CC0000 100%)',
                'url' => '/tools/youtube-summary',
                'order_index' => 1,
                'status' => true,
            ],
            [
                'title' => 'AI Content Writer',
                'description' => 'Viết bài SEO, Facebook, TikTok theo chuẩn gợi ý AI.',
                'icon' => 'fa-solid fa-pen-nib',
                'color' => 'linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%)',
                'url' => '/tools/content-writer',
                'order_index' => 2,
                'status' => true,
            ],
            [
                'title' => 'Xóa nền ảnh AI',
                'description' => 'Tách nền ảnh nhanh chóng, chuyên nghiệp bằng AI.',
                'icon' => 'fa-solid fa-image-portrait',
                'color' => 'linear-gradient(135deg, #10B981 0%, #059669 100%)',
                'url' => '/tools/remove-bg',
                'order_index' => 3,
                'status' => true,
            ],
        ];

        foreach ($data as $u) {
            Utility::create($u);
        }
    }
}
