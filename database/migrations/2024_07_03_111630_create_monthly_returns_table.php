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
        Schema::create('monthly_returns', function (Blueprint $table) {
            $table->id();
            $table->decimal('form_amount',10,2)->default(0.00)->nullable();
            $table->decimal('to_amount',10,2)->default(0.00)->nullable();
            $table->integer('percentage')->nullable();
            $table->tinyInteger('visiblity')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_returns');
    }
};
