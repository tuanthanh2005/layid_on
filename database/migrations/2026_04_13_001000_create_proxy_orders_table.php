<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proxy_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('proxy_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('order_number')->unique();
            $table->string('proxy_name');
            $table->string('proxy_type')->nullable();
            $table->string('proxy_protocol')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_price', 12, 0);
            $table->decimal('total_amount', 12, 0);
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('submitted');
            $table->string('payment_method')->nullable();
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone')->nullable();
            $table->string('buyer_telegram')->nullable();
            $table->text('customer_note')->nullable();
            $table->text('admin_note')->nullable();
            $table->string('proxy_host')->nullable();
            $table->string('proxy_port')->nullable();
            $table->string('proxy_username')->nullable();
            $table->string('proxy_password')->nullable();
            $table->string('proxy_protocol_delivered')->nullable();
            $table->text('proxy_ip_list')->nullable();
            $table->text('proxy_whitelist')->nullable();
            $table->string('proxy_connection_limit')->nullable();
            $table->timestamp('proxy_expires_at')->nullable();
            $table->text('proxy_setup_guide')->nullable();
            $table->text('delivery_note')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proxy_orders');
    }
};
