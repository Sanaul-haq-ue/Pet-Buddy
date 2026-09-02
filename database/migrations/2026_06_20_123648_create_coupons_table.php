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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code')->unique();

            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 6, 2);

            $table->decimal('min_order_amount', 10, 2)->nullable();
            $table->decimal('max_discount_amount', 10, 2)->nullable();

            $table->integer('usage_limit')->nullable();
            $table->integer('usage_per_customer')->nullable();

            $table->dateTime('start_date');
            $table->dateTime('expiry_date');

            $table->text('note')->nullable();

            $table->boolean('status')->default(1)->comment('1 for active, 0 for inactive');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
