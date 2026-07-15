<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('menu_categories')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('unit', 50)->default('porsi');
            $table->enum('stock_status', ['tersedia', 'terbatas', 'habis'])->default('tersedia');
            $table->boolean('is_hot')->default(false);
            $table->string('image_path')->nullable();
            $table->boolean('is_preorder_available')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
