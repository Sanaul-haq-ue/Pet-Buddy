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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('brand_logo')->nullable(); // store image path
            $table->string('company_name');
            $table->tinyInteger('status')->default(0)
                ->comment('0 = active, 1 = inactive');
            $table->text('address')->nullable();
            $table->string('location')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email')->unique();
            $table->string('business_card')->nullable(); // store image path

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
