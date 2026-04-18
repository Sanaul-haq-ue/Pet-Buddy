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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('service_id')->nullable();
            $table->integer('service_pricing_id')->nullable();

            $table->string('booking_type');
            
            // appointment
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();

            // duration
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->integer('pet_count')->default(1);

            $table->decimal('total_price', 10, 2);
            $table->integer('coupon_id')->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->decimal('final_price', 10, 2);

            $table->tinyInteger('status')->default(0); // 0: pending, 1: confirmed, 2: completed, 3: cancelled
            $table->tinyInteger('payment_status')->default(0); // 0: unpaid, 1: paid, 2: refunded

            $table->integer('payment_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();

            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
