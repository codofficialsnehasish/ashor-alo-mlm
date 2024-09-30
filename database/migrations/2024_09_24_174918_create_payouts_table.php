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
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('tds_persentage')->default(0);
            $table->integer('repurchase_persentage')->default(0);
            $table->integer('service_charge_persentage')->default(0);

            $table->decimal('direct_bonus',10,2)->default(0.00);
            $table->decimal('direct_bonus_tds_deduction',10,2)->default(0.00);
            $table->decimal('direct_bonus_repurchase_deduction',10,2)->default(0.00);

            $table->decimal('lavel_bonus',10,2)->default(0.00);
            $table->decimal('lavel_bonus_tds_deduction',10,2)->default(0.00);
            $table->decimal('lavel_bonus_repurchase_deduction',10,2)->default(0.00);

            $table->decimal('remuneration_bonus',10,2)->default(0.00);
            $table->decimal('remuneration_bonus_tds_deduction',10,2)->default(0.00);
            $table->decimal('remuneration_bonus_repurchase_deduction',10,2)->default(0.00);

            $table->decimal('roi',10,2)->default(0.00);
            $table->decimal('roi_tds_deduction',10,2)->default(0.00);

            $table->decimal('hold_amount_added',10,2)->default(0.00);
            $table->decimal('hold_amount',10,2)->default(0.00);

            $table->decimal('total_payout',10,2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
