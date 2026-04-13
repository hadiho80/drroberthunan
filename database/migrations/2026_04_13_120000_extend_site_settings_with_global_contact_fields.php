<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $columns = [
            'contact_phone' => fn (Blueprint $table) => $table->string('contact_phone')->nullable()->after('clinic_department'),
            'contact_email' => fn (Blueprint $table) => $table->string('contact_email')->nullable()->after('contact_phone'),
            'contact_address' => fn (Blueprint $table) => $table->string('contact_address')->nullable()->after('contact_email'),
            'contact_city' => fn (Blueprint $table) => $table->string('contact_city')->nullable()->after('contact_address'),
            'contact_region' => fn (Blueprint $table) => $table->string('contact_region')->nullable()->after('contact_city'),
            'contact_postal_code' => fn (Blueprint $table) => $table->string('contact_postal_code', 20)->nullable()->after('contact_region'),
            'contact_country' => fn (Blueprint $table) => $table->string('contact_country', 10)->nullable()->after('contact_postal_code'),
            'whatsapp_link' => fn (Blueprint $table) => $table->string('whatsapp_link')->nullable()->after('contact_country'),
            'insurance_link' => fn (Blueprint $table) => $table->string('insurance_link')->nullable()->after('whatsapp_link'),
            'google_maps_link' => fn (Blueprint $table) => $table->string('google_maps_link')->nullable()->after('insurance_link'),
            'instagram_link' => fn (Blueprint $table) => $table->string('instagram_link')->nullable()->after('google_maps_link'),
            'facebook_link' => fn (Blueprint $table) => $table->string('facebook_link')->nullable()->after('instagram_link'),
        ];

        foreach ($columns as $column => $definition) {
            if (! Schema::hasColumn('site_settings', $column)) {
                Schema::table('site_settings', $definition);
            }
        }

        $contact = DB::table('contact_infos')->orderBy('id')->first();

        DB::table('site_settings')->update([
            'contact_phone' => Schema::hasColumn('contact_infos', 'phone') ? ($contact->phone ?? '+628121043450') : '+628121043450',
            'contact_email' => Schema::hasColumn('contact_infos', 'email') ? ($contact->email ?? 'roberthunan@gmail.com') : 'roberthunan@gmail.com',
            'contact_address' => Schema::hasColumn('contact_infos', 'address') ? ($contact->address ?? 'Jl. Boulevard Famili Sel No.Kav. 1 Babatan, Kec. Wiyung, Surabaya, Jawa Timur 60227') : 'Jl. Boulevard Famili Sel No.Kav. 1 Babatan, Kec. Wiyung, Surabaya, Jawa Timur 60227',
            'contact_city' => Schema::hasColumn('contact_infos', 'city') ? ($contact->city ?? 'Surabaya') : 'Surabaya',
            'contact_region' => Schema::hasColumn('contact_infos', 'region') ? ($contact->region ?? 'Jawa Timur') : 'Jawa Timur',
            'contact_postal_code' => Schema::hasColumn('contact_infos', 'postal_code') ? ($contact->postal_code ?? '60227') : '60227',
            'contact_country' => Schema::hasColumn('contact_infos', 'country') ? ($contact->country ?? 'ID') : 'ID',
            'whatsapp_link' => 'https://wa.me/628121043450',
            'insurance_link' => 'https://national-hospital.com/id/mitra/mitra-asuransi?t=1774324454',
        ]);
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_phone',
                'contact_email',
                'contact_address',
                'contact_city',
                'contact_region',
                'contact_postal_code',
                'contact_country',
                'whatsapp_link',
                'insurance_link',
                'google_maps_link',
                'instagram_link',
                'facebook_link',
            ]);
        });
    }
};
