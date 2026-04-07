<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        HomePage::query()->updateOrCreate(
            ['id' => 1],
            HomePage::defaults()
        );
    }
}
