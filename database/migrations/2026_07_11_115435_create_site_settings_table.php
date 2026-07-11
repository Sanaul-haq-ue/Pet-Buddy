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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // Brand Assets
            $table->string('brand_logo_text')->nullable();
            $table->string('brand_tagline')->nullable();
            $table->string('brand_logo_path')->nullable(); // uploaded logo file path

            // Hero Section
            $table->string('hero_headline')->nullable();
            $table->text('hero_subtext')->nullable();
            $table->string('hero_image_path')->nullable(); // uploaded hero image path

            // Company Info
            $table->string('legal_entity_name')->nullable();
            $table->string('studio_location')->nullable();
            $table->text('map_embed_code')->nullable();

            // Services Section
            $table->string('services_headline')->nullable();
            $table->text('services_subtext')->nullable();
            $table->text('services_bullets')->nullable();

            // Shop Section
            $table->string('shop_headline')->nullable();
            $table->text('shop_subtext')->nullable();
            $table->text('shop_bullets')->nullable();

            // Contact Information
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('business_hours')->nullable();
            $table->string('copyright_notice')->nullable();

            // Social Media
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
