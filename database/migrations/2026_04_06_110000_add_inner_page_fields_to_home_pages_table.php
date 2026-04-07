<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->string('doctor_profile_title')->nullable()->after('quote_author');
            $table->text('doctor_profile_intro')->nullable()->after('doctor_profile_title');
            $table->string('doctor_profile_image')->nullable()->after('doctor_profile_intro');
            $table->string('contact_page_title')->nullable()->after('contact_address');
            $table->text('contact_page_intro')->nullable()->after('contact_page_title');
            $table->string('facility_image')->nullable()->after('contact_page_intro');
        });
    }

    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'doctor_profile_title',
                'doctor_profile_intro',
                'doctor_profile_image',
                'contact_page_title',
                'contact_page_intro',
                'facility_image',
            ]);
        });
    }
};
