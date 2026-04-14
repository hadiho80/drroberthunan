<?php

use App\Support\CmsDefaults;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage_contents', function (Blueprint $table) {
            $table->text('contact_success_message')->nullable()->after('contact_image');
            $table->string('contact_name_placeholder')->nullable()->after('contact_success_message');
            $table->string('contact_phone_placeholder')->nullable()->after('contact_name_placeholder');
            $table->string('contact_email_placeholder')->nullable()->after('contact_phone_placeholder');
            $table->string('contact_message_placeholder')->nullable()->after('contact_email_placeholder');
            $table->string('contact_button_label')->nullable()->after('contact_message_placeholder');
        });

        Schema::create('homepage_service_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homepage_content_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('homepage_contents')
            ->where('id', 1)
            ->update(array_merge(
                CmsDefaults::homepageContactForm(),
                [
                    'updated_at' => now(),
                ]
            ));

        $homepageId = DB::table('homepage_contents')->orderBy('id')->value('id');

        if ($homepageId) {
            $serviceIds = DB::table('services')
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->limit(3)
                ->pluck('id');

            foreach ($serviceIds as $index => $serviceId) {
                DB::table('homepage_service_cards')->insert([
                    'homepage_content_id' => $homepageId,
                    'service_id' => $serviceId,
                    'sort_order' => ($index + 1) * 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_service_cards');

        Schema::table('homepage_contents', function (Blueprint $table) {
            $table->dropColumn([
                'contact_success_message',
                'contact_name_placeholder',
                'contact_phone_placeholder',
                'contact_email_placeholder',
                'contact_message_placeholder',
                'contact_button_label',
            ]);
        });
    }
};
