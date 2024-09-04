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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->nullable();
            $table->unsignedBigInteger('buyer_id');
            $table->decimal('price_subtotal', 10, 2)->nullable();
            $table->decimal('price_gst', 10, 2)->nullable();
            $table->decimal('price_shipping', 10, 2)->nullable();
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->decimal('price_total', 10, 2)->nullable();
            $table->string('price_currency', 3)->nullable();
            $table->string('coupon_code')->nullable();
            $table->tinyInteger('status')->default(false)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('order_status')->nullable();
            $table->string('placed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
