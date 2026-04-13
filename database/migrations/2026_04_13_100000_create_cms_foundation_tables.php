<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('seo_title_default');
            $table->string('seo_description_default', 320);
            $table->string('seo_keywords', 500)->nullable();
            $table->string('seo_image')->nullable();
            $table->string('seo_og_locale', 10)->default('en_US');
            $table->string('seo_lang', 10)->default('en');
            $table->string('doctor_name');
            $table->string('doctor_subtitle')->nullable();
            $table->string('clinic_name');
            $table->string('clinic_department')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_city')->nullable();
            $table->string('contact_region')->nullable();
            $table->string('contact_postal_code', 20)->nullable();
            $table->string('contact_country', 10)->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('insurance_link')->nullable();
            $table->string('google_maps_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->timestamps();
        });

        Schema::create('homepage_contents', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->text('hero_description')->nullable();
            $table->string('hero_primary_cta_label')->nullable();
            $table->string('hero_primary_cta_url')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('doctor_intro_title')->nullable();
            $table->text('doctor_intro_body')->nullable();
            $table->string('doctor_intro_stat')->nullable();
            $table->string('doctor_intro_cta_label')->nullable();
            $table->string('doctor_intro_cta_url')->nullable();
            $table->string('doctor_intro_image')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_body')->nullable();
            $table->text('about_secondary_body')->nullable();
            $table->string('about_cta_label')->nullable();
            $table->string('about_cta_url')->nullable();
            $table->string('about_image')->nullable();
            $table->string('services_title')->nullable();
            $table->string('highlights_title')->nullable();
            $table->string('highlight_bottom_image')->nullable();
            $table->string('contact_title')->nullable();
            $table->string('contact_image')->nullable();
            $table->timestamps();
        });

        Schema::create('homepage_highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homepage_content_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('url');
            $table->string('image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('intro')->nullable();
            $table->longText('biography')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('doctor_profile_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_profile_id')->constrained()->cascadeOnDelete();
            $table->string('key')->nullable();
            $table->string('title');
            $table->text('intro')->nullable();
            $table->json('items')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->text('page_intro')->nullable();
            $table->string('schedule_heading')->nullable();
            $table->string('ask_label')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_info_id')->constrained()->cascadeOnDelete();
            $table->string('day_label');
            $table->string('time_label');
            $table->string('opens_at', 10)->nullable();
            $table->string('closes_at', 10)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_schedules');
        Schema::dropIfExists('contact_infos');
        Schema::dropIfExists('doctor_profile_sections');
        Schema::dropIfExists('doctor_profiles');
        Schema::dropIfExists('homepage_highlights');
        Schema::dropIfExists('homepage_contents');
        Schema::dropIfExists('site_settings');
    }
};
