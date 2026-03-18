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
        Schema::create('social_servers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('social_service_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('price_per_unit', 15, 2)->default(0);
            $table->integer('min_quantity')->default(1);
            $table->integer('max_quantity')->default(1000000);
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_servers');
    }
};
