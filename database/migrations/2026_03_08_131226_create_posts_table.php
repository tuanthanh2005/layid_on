<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            
            // Media (Thumbnail or Icon/Color)
            $table->string('thumbnail')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            
            // SEO Meta
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            // Position Toggles (Home Showcases)
            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false); // Top Header
            $table->boolean('is_grid')->default(false); // The 4 Top Grid Items
            $table->boolean('is_recommended')->default(false); // Sidebar Top
            $table->boolean('is_interested')->default(false); // Sidebar Bottom
            $table->boolean('is_video')->default(false); // Bottom Videos
            
            // Optional metrics
            $table->integer('views')->default(0);
            $table->integer('comments_count')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
