<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proxies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->default('IPv4');
            $table->string('protocol')->default('HTTP/HTTPS');
            $table->string('location')->nullable();
            $table->string('duration')->nullable();
            $table->string('bandwidth')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->decimal('price', 12, 0);
            $table->decimal('original_price', 12, 0)->nullable();
            $table->string('badge_text')->nullable();
            $table->string('purchase_link')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        $menuExists = DB::table('menus')->where('url', '/proxy')->exists();

        if (! $menuExists) {
            $nextOrder = (int) DB::table('menus')->max('order') + 1;

            DB::table('menus')->insert([
                'name' => 'Proxy',
                'url' => '/proxy',
                'icon' => 'fa-solid fa-shield-halved',
                'parent_id' => null,
                'order' => $nextOrder,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('menus')->where('url', '/proxy')->delete();
        Schema::dropIfExists('proxies');
    }
};
