<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->longText('details')->nullable()->after('description'); // Rich HTML chi tiết sản phẩm
            $table->string('video_url')->nullable()->after('details');     // YouTube embed URL
            $table->json('features')->nullable()->after('video_url');      // Danh sách tính năng JSON
            $table->string('category_label')->nullable()->after('features'); // Nhãn danh mục (ChatGPT, Gemini...)
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['details', 'video_url', 'features', 'category_label']);
        });
    }
};
