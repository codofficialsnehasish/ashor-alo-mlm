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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->unsignedBigInteger('lavel_id')->nullable();
            $table->string('status')->nullable();
            $table->string('role')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->tinyInteger('is_left')->default(false)->nullable();
            $table->tinyInteger('is_right')->default(false)->nullable();
            $table->string('token')->nullable();
            $table->string('name');
            $table->text('user_image')->nullable();

            $table->string('email')->nullable();
            $table->string('email_verification_code')->nullable();
            $table->boolean('is_email_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();

            $table->string('phone')->nullable();
            $table->string('phone_verification_code')->nullable();
            $table->boolean('is_phone_verified')->default(false);
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('alternate_mobile_number')->nullable();

            $table->string('password');
            $table->rememberToken();

            $table->decimal('account_balance', 10, 2)->default(0.00);

            $table->text('address')->nullable();
            $table->string('post_office')->nullable();
            $table->string('police_station')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('aadhar_number')->nullable();
            $table->string('gpay_phonepay_paytm_number')->nullable();
            $table->string('upi_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('adding_mode')->nullable();
            $table->decimal('joining_amount')->nullable();
            $table->timestamp('join_amount_put_date')->nullable();
            $table->tinyInteger('is_seen_admin')->default(false);
            $table->tinyInteger('is_approved')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
