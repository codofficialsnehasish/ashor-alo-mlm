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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('sku')->unique()->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('subcategory_id')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('discount_rate')->nullable();
            $table->boolean('no_discount')->default(false)->nullable();
            $table->integer('gst_rate')->nullable();
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->decimal('gst_amount', 10, 2)->nullable();
            $table->text('short_desc')->nullable();
            $table->longText('description')->nullable();
            $table->longText('product_specification')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->integer('rating')->nullable();
            $table->string('shipping_time')->nullable();
            $table->decimal('shipping_cost', 8, 2)->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_draft')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('weight')->nullable();
            $table->string('product_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
