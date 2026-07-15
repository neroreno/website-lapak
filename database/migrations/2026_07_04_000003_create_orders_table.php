<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_phone', 20)->nullable();
            $table->text('customer_address')->nullable();
            $table->text('notes')->nullable();
            $table->integer('subtotal');
            $table->integer('discount')->default(0);
            $table->integer('total');
            $table->integer('points_earned')->default(0);
            $table->integer('points_used')->default(0);
            $table->enum('payment_method', ['gopay', 'ovo', 'dana', 'bca', 'mandiri', 'bri', 'qris'])->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'expired'])->default('pending');
            $table->enum('order_status', ['pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled'])->default('pending');
            $table->boolean('is_preorder')->default(false);
            $table->date('delivery_date')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
