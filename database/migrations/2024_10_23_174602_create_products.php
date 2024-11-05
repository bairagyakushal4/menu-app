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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_sku')->unique();
            $table->string('product_image')->nullable();
            $table->string('product_name');
            $table->string('product_description');
            $table->decimal('product_price', 10, 2);
            $table->enum('product_veg_non_veg', ['veg', 'non_veg', 'na'])->default('na');
            $table->enum('product_status', ['active', 'disabled'])->default('active');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
