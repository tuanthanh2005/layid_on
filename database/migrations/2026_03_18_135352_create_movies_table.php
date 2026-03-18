<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('original_title')->nullable()->comment('Tên gốc (tiếng Anh)');
            $table->string('genre')->nullable()->comment('Thể loại: Hành động, Tình cảm, Kinh dị...');
            $table->string('country')->nullable()->comment('Quốc gia sản xuất');
            $table->year('release_year')->nullable()->comment('Năm phát hành');
            $table->string('director')->nullable()->comment('Đạo diễn');
            $table->string('duration_text')->nullable()->comment('Thời lượng: 2h 30p');
            $table->decimal('rating', 3, 1)->default(0)->comment('Điểm đánh giá /5');
            $table->string('rating_label')->nullable()->comment('Nhãn: Rất hay, Tuyệt đỉnh...');

            // Media
            $table->text('thumbnail')->nullable()->comment('Poster phim');
            $table->string('icon')->nullable()->comment('Fallback icon');
            $table->string('color')->nullable()->comment('Màu nền gradient');

            // Content
            $table->text('summary')->nullable()->comment('Tóm tắt ngắn / Sapô');
            $table->longText('content')->nullable()->comment('Nội dung review chi tiết');
            $table->string('trailer_url')->nullable()->comment('Link YouTube trailer');
            $table->string('tags')->nullable()->comment('Tags phân cách bằng dấu phẩy');

            // Admin toggles - vị trí hiển thị
            $table->boolean('status')->default(true)->comment('Công khai');
            $table->boolean('is_featured')->default(false)->comment('Phim Đề Xuất (sidebar movies)');
            $table->boolean('is_interested')->default(false)->comment('Phim có thể bạn quan tâm (sidebar detail)');
            $table->boolean('is_trending')->default(false)->comment('Phim Đề Xuất Top Trending (sidebar detail)');
            $table->boolean('is_main_featured')->default(false)->comment('Banner chính trang danh sách');

            // Meta
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('views')->default(0);
            $table->integer('order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
