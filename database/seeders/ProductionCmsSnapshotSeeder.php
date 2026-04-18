<?php

namespace Database\Seeders;

use App\Support\CmsContentSynchronizer;
use Illuminate\Database\Seeder;

class ProductionCmsSnapshotSeeder extends Seeder
{
    public function run(): void
    {
        app(CmsContentSynchronizer::class)->sync();
    }
}
