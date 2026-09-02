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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');

            $table->foreignId('brand_id')
                ->constrained('product_brands')
                ->restrictOnDelete();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained('product_sub_categories')
                ->nullOnDelete();

            $table->text('description')->nullable();

            $table->json('species_ids')->nullable();

            $table->decimal('regular_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2);
            $table->decimal('buying_price', 10, 2)->nullable();

            $table->string('unit', 255);

            $table->integer('quantity')->default(0);

            $table->string('sku_id')->nullable()->unique();

            $table->string('image')->nullable();

            $table->boolean('is_visible')->default(0)->comment('0 = hidden, 1 = visible');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
