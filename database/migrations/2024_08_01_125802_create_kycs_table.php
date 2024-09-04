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
        Schema::create('kycs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('identy_proof_type')->nullable();
            $table->string('address_proof_type')->nullable();
            $table->string('bank_ac_proof_type')->nullable();
            $table->string('identy_proof')->nullable();
            $table->tinyInteger('identy_proof_status')->default(0);
            $table->string('identy_proof_remarks')->nullable();
            $table->string('address_proof')->nullable();
            $table->tinyInteger('address_proof_status')->default(0);
            $table->string('address_proof_remarks')->nullable();
            $table->string('bank_ac_proof')->nullable();
            $table->tinyInteger('bank_ac_proof_status')->default(0);
            $table->string('bank_ac_proof_remarks')->nullable();
            $table->string('pan_card_proof')->nullable();
            $table->tinyInteger('pan_card_proof_status')->default(0);
            $table->string('pan_card_proof_remarks')->nullable();
            $table->tinyInteger('is_seen_by_admin')->default(0);
            $table->tinyInteger('is_confirmed')->default(0);
            $table->timestamp('confirmed_date')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kycs');
    }
};
