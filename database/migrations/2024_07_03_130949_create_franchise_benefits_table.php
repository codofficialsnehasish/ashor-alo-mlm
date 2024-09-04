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
        Schema::create('franchise_benefits', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->integer('income')->nullable();
            $table->tinyInteger('visiblity')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchise_benefits');
    }
};
