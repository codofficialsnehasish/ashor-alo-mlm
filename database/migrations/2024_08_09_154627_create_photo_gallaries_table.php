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
        Schema::create('photo_gallaries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('is_visiable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_gallaries');
    }
};
