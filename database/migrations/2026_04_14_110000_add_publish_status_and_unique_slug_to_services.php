<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('is_published')->default(true)->after('is_featured');
        });

        DB::table('services')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->update(['is_published' => true]);

        Schema::table('services', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('is_published');
        });
    }
};
