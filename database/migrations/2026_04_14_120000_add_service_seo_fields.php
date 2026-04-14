<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('services', 'seo_title') || ! Schema::hasColumn('services', 'seo_description')) {
            Schema::table('services', function (Blueprint $table) {
                if (! Schema::hasColumn('services', 'seo_title')) {
                    $table->string('seo_title')->nullable()->after('is_published');
                }

                if (! Schema::hasColumn('services', 'seo_description')) {
                    $table->string('seo_description', 320)->nullable()->after('seo_title');
                }
            });
        }

        DB::table('services')
            ->whereNotNull('slug')
            ->orderBy('id')
            ->get()
            ->each(function ($service): void {
                DB::table('services')
                    ->where('id', $service->id)
                    ->update([
                        'seo_title' => $service->title,
                        'seo_description' => mb_substr((string) ($service->intro ?: $service->card_description ?: $service->description), 0, 320),
                    ]);
            });
    }

    public function down(): void
    {
        $columns = [];

        if (Schema::hasColumn('services', 'seo_title')) {
            $columns[] = 'seo_title';
        }

        if (Schema::hasColumn('services', 'seo_description')) {
            $columns[] = 'seo_description';
        }

        if ($columns !== []) {
            Schema::table('services', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
