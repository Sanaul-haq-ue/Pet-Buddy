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
        Schema::create('booking_pets', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->integer('booking_service_id')->nullable();
            $table->integer('species_id')->nullable();
            $table->integer('breed_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_pets');
    }
};
