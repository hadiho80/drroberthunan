<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->string('doctor_profile_subtitle')->nullable()->after('doctor_profile_title');
            $table->text('doctor_profile_biography')->nullable()->after('doctor_profile_intro');
            $table->text('doctor_profile_experience')->nullable()->after('doctor_profile_biography');
            $table->text('doctor_profile_education')->nullable()->after('doctor_profile_experience');
            $table->text('doctor_profile_training')->nullable()->after('doctor_profile_education');
        });
    }

    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'doctor_profile_subtitle',
                'doctor_profile_biography',
                'doctor_profile_experience',
                'doctor_profile_education',
                'doctor_profile_training',
            ]);
        });
    }
};
