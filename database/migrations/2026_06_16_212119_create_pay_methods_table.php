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
        Schema::create('pay_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pay_type_id')
                ->constrained('pay_types')
                ->cascadeOnDelete();

            $table->string('name')->unique();
            $table->text('note')->nullable();
            $table->boolean('status')->default(1)->comment('1 for active, 0 for inactive');

            $table->string('mbanking_number')->nullable()->unique();

            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable()->unique();
            $table->string('routing_number')->nullable();
            $table->string('branch_name')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_methods');
    }
};
