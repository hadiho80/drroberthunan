<?php

use App\Support\CmsContentSynchronizer;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        app(CmsContentSynchronizer::class)->sync();
    }

    public function down(): void
    {
        // Content snapshot migration is intentionally not reversed.
    }
};
