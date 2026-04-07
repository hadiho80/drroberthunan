<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_tagline')->nullable();
            $table->string('hero_badge')->nullable();
            $table->string('hero_title');
            $table->string('hero_highlight')->nullable();
            $table->text('hero_description');
            $table->string('primary_cta_label')->nullable();
            $table->string('primary_cta_url')->nullable();
            $table->string('secondary_cta_label')->nullable();
            $table->string('secondary_cta_url')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('experience_label')->nullable();
            $table->string('experience_value')->nullable();
            $table->string('patients_label')->nullable();
            $table->string('patients_value')->nullable();
            $table->string('about_eyebrow')->nullable();
            $table->string('about_title');
            $table->text('about_description');
            $table->text('quote_text')->nullable();
            $table->string('quote_author')->nullable();
            $table->string('seo_title');
            $table->string('seo_description', 320);
            $table->string('seo_keywords', 500)->nullable();
            $table->string('seo_image')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
