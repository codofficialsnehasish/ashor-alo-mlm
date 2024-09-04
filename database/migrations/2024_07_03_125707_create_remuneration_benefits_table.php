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
        Schema::create('remuneration_benefits', function (Blueprint $table) {
            $table->id();
            $table->string('rank')->nullable();
            $table->decimal('target',10,2)->default(0.00)->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('month_validity')->nullable();
            $table->tinyInteger('visiblity')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remuneration_benefits');
    }
};
