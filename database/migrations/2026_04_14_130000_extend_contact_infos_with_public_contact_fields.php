<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_infos', function (Blueprint $table) {
            if (! Schema::hasColumn('contact_infos', 'phone')) {
                $table->string('phone')->nullable()->after('page_intro');
            }

            if (! Schema::hasColumn('contact_infos', 'email')) {
                $table->string('email')->nullable()->after(Schema::hasColumn('contact_infos', 'phone') ? 'phone' : 'page_intro');
            }

            if (! Schema::hasColumn('contact_infos', 'address')) {
                $table->string('address')->nullable()->after(Schema::hasColumn('contact_infos', 'email') ? 'email' : 'page_intro');
            }

            if (! Schema::hasColumn('contact_infos', 'whatsapp_link')) {
                $table->string('whatsapp_link')->nullable()->after(Schema::hasColumn('contact_infos', 'address') ? 'address' : 'page_intro');
            }

            if (! Schema::hasColumn('contact_infos', 'contact_image')) {
                $table->string('contact_image')->nullable()->after('ask_label');
            }
        });

        $settings = DB::table('site_settings')->orderBy('id')->first();

        if ($settings) {
            DB::table('contact_infos')->update([
                'phone' => $settings->contact_phone ?? null,
                'email' => $settings->contact_email ?? null,
                'address' => $settings->contact_address ?? null,
                'whatsapp_link' => $settings->whatsapp_link ?? null,
            ]);
        }
    }

    public function down(): void
    {
        $columns = [];

        foreach (['phone', 'email', 'address', 'whatsapp_link', 'contact_image'] as $column) {
            if (Schema::hasColumn('contact_infos', $column)) {
                $columns[] = $column;
            }
        }

        if ($columns !== []) {
            Schema::table('contact_infos', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
