<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('home_slug')->nullable()->after('facebook_link');
            $table->boolean('home_is_published')->default(true)->after('home_slug');
            $table->string('home_seo_title')->nullable()->after('home_is_published');
            $table->string('home_seo_description', 320)->nullable()->after('home_seo_title');
            $table->string('home_seo_keywords', 500)->nullable()->after('home_seo_description');
            $table->string('home_og_image')->nullable()->after('home_seo_keywords');

            $table->string('profile_slug')->nullable()->after('home_og_image');
            $table->boolean('profile_is_published')->default(true)->after('profile_slug');
            $table->string('profile_seo_title')->nullable()->after('profile_is_published');
            $table->string('profile_seo_description', 320)->nullable()->after('profile_seo_title');
            $table->string('profile_seo_keywords', 500)->nullable()->after('profile_seo_description');
            $table->string('profile_og_image')->nullable()->after('profile_seo_keywords');

            $table->string('services_slug')->nullable()->after('profile_og_image');
            $table->boolean('services_is_published')->default(true)->after('services_slug');
            $table->string('services_seo_title')->nullable()->after('services_is_published');
            $table->string('services_seo_description', 320)->nullable()->after('services_seo_title');
            $table->string('services_seo_keywords', 500)->nullable()->after('services_seo_description');
            $table->string('services_og_image')->nullable()->after('services_seo_keywords');

            $table->string('contact_slug')->nullable()->after('services_og_image');
            $table->boolean('contact_is_published')->default(true)->after('contact_slug');
            $table->string('contact_seo_title')->nullable()->after('contact_is_published');
            $table->string('contact_seo_description', 320)->nullable()->after('contact_seo_title');
            $table->string('contact_seo_keywords', 500)->nullable()->after('contact_seo_description');
            $table->string('contact_og_image')->nullable()->after('contact_seo_keywords');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('seo_keywords', 500)->nullable()->after('seo_description');
            $table->string('og_image')->nullable()->after('seo_keywords');
        });

        DB::table('site_settings')->update([
            'home_slug' => 'home',
            'home_is_published' => true,
            'profile_slug' => 'doctor-profile',
            'profile_is_published' => true,
            'services_slug' => 'services',
            'services_is_published' => true,
            'contact_slug' => 'contact-us',
            'contact_is_published' => true,
        ]);
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'seo_keywords',
                'og_image',
            ]);
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'home_slug',
                'home_is_published',
                'home_seo_title',
                'home_seo_description',
                'home_seo_keywords',
                'home_og_image',
                'profile_slug',
                'profile_is_published',
                'profile_seo_title',
                'profile_seo_description',
                'profile_seo_keywords',
                'profile_og_image',
                'services_slug',
                'services_is_published',
                'services_seo_title',
                'services_seo_description',
                'services_seo_keywords',
                'services_og_image',
                'contact_slug',
                'contact_is_published',
                'contact_seo_title',
                'contact_seo_description',
                'contact_seo_keywords',
                'contact_og_image',
            ]);
        });
    }
};
