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
        Schema::create('award_rewords', function (Blueprint $table) {
            $table->id();
            $table->string('rank')->nullable();
            $table->string('item_name')->nullable();
            $table->string('item_image')->nullable();
            $table->tinyInteger('visiblity')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('award_rewords');
    }
};
