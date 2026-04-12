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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('service_name');
            $table->string('slug')->unique();

            $table->text('S_description');

            // JSON for multiple select
            $table->json('category_id');
            $table->json('species_id');

            // Relations
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('upazila_id');
            $table->unsignedBigInteger('union_id');

            // Location
            $table->string('location')->nullable();

            // Pricing
            $table->decimal('base_price', 10, 2);
            $table->string('timing')->default('Hourly');
            $table->decimal('offer_price', 10, 2)->nullable();

            // Capacity
            $table->integer('capacity')->nullable();

            // Media
            $table->string('cover_image')->nullable();

            // Status
            $table->boolean('is_published')->default(1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
