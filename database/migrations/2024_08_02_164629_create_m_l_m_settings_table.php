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
        Schema::create('m_l_m_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('minimum_purchase_amount')->nullable();
            $table->integer('agent_direct_bonus');
            $table->integer('tds');
            $table->integer('repurchase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_l_m_settings');
    }
};
