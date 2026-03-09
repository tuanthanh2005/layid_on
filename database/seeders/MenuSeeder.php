<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['name' => 'Trang chủ', 'url' => '/', 'icon' => 'fa-solid fa-home', 'order' => 1],
            ['name' => 'AI Giá Rẻ', 'url' => '/store/ai-accounts', 'icon' => 'fa-solid fa-store', 'order' => 2],
            ['name' => 'Tool AI', 'url' => '#', 'icon' => 'fa-solid fa-robot', 'order' => 3, 'children' => [
                ['name' => 'Gemini Business Free', 'url' => '/gemini-business-free', 'icon' => 'fa-solid fa-gift', 'order' => 1],
                ['name' => 'Xóa Watermark Ảnh', 'url' => '/tools/remove-gemini-logo', 'icon' => 'fa-solid fa-eraser', 'order' => 2],
            ]],
            ['name' => '2FA Code', 'url' => '/tools/2fa', 'icon' => 'fa-solid fa-shield-halved', 'order' => 4],
            ['name' => 'Dịch vụ MXH', 'url' => '#', 'icon' => 'fa-solid fa-fire', 'order' => 5, 'children' => [
                ['name' => 'Buff TikTok', 'url' => '/placeholder/buff', 'icon' => 'fa-brands fa-tiktok', 'order' => 1],
                ['name' => 'Buff Facebook', 'url' => '/placeholder/buff', 'icon' => 'fa-brands fa-facebook', 'order' => 2],
            ]],
            ['name' => 'Học IT Miễn Phí', 'url' => '/courses', 'icon' => 'fa-solid fa-graduation-cap', 'order' => 6],
            ['name' => 'Blog & Mẹo AI', 'url' => '/blog', 'icon' => 'fa-solid fa-book', 'order' => 7],
            ['name' => 'Review Phim', 'url' => '/movies', 'icon' => 'fa-solid fa-film', 'order' => 8],
        ];

        foreach ($menus as $m) {
            $children = $m['children'] ?? [];
            unset($m['children']);
            
            $parent = Menu::create($m);
            
            foreach ($children as $c) {
                $c['parent_id'] = $parent->id;
                Menu::create($c);
            }
        }
    }
}
