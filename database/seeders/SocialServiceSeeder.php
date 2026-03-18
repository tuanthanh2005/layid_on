<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialService;
use App\Models\SocialServer;

class SocialServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiktok = SocialService::create([
            'name' => 'Buff TikTok',
            'slug' => 'buff-tiktok',
            'icon' => 'fa-brands fa-tiktok',
            'order' => 1,
        ]);

        SocialServer::create([
            'social_service_id' => $tiktok->id,
            'name' => 'Server 1 - Follow Chất Lượng',
            'price_per_unit' => 100.00,
            'min_quantity' => 10,
            'max_quantity' => 100000,
            'description' => 'Tăng follow thật, không tụt.',
        ]);

        SocialServer::create([
            'social_service_id' => $tiktok->id,
            'name' => 'Server 2 - Follow Giá Rẻ',
            'price_per_unit' => 50.00,
            'min_quantity' => 100,
            'max_quantity' => 500000,
            'description' => 'Follow clone, có thể tụt.',
        ]);

        $facebook = SocialService::create([
            'name' => 'Buff Facebook',
            'slug' => 'buff-facebook',
            'icon' => 'fa-brands fa-facebook',
            'order' => 2,
        ]);

        SocialServer::create([
            'social_service_id' => $facebook->id,
            'name' => 'Server 1 - Like Page',
            'price_per_unit' => 150.00,
            'min_quantity' => 100,
            'max_quantity' => 200000,
            'description' => 'Tăng like fanpage người dùng thật.',
        ]);
    }
}
