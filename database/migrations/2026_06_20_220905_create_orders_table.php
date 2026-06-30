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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_no')->unique();
            $table->string('coupon_code')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount_amount', 6, 2)->default(0);
            $table->decimal('shipping_charge', 5, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->unsignedTinyInteger('pay_type_id');
            $table->unsignedTinyInteger('pay_method_id');
            $table->string('transaction_no')->nullable();
            $table->string('payment_screenshot')->nullable();
            $table->string('shipping_name');
            $table->string('shipping_email');
            $table->string('shipping_mobile');
            $table->string('shipping_zone');
            $table->text('shipping_address');
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
