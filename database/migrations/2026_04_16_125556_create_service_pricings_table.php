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
        Schema::create('service_pricings', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');

            $table->enum('pricing_type', ['hourly', 'daily', 'fixed', 'session', 'per_pet']);
            $table->string('unit'); // hour, day, booking, pet

            $table->decimal('price', 10, 2);
            $table->decimal('offer_price', 10, 2)->nullable();

            $table->integer('max_capacity')->nullable();
            $table->integer('min_quantity')->nullable();
            $table->integer('max_quantity')->nullable();

            $table->string('label')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_pricings');
    }
};
