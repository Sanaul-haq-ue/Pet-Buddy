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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('pet_name')->nullable();
            $table->string('pet_age')->nullable();
            $table->string('species')->nullable();
            $table->string('breed')->nullable();
            $table->boolean('status')->default(1)
                ->comment('1 = active, 0 = inactive');
            $table->text('pet_description')->nullable();
            $table->string('pet_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
