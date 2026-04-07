<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Obstetrics',
                'description' => 'Safe and structured support from early pregnancy through post-partum care.',
            ],
            [
                'title' => 'Gynaecology',
                'description' => 'Assessment, diagnosis, and treatment planning for common and complex gynecologic concerns.',
            ],
            [
                'title' => 'Minimally Invasive Surgery',
                'description' => 'Laparoscopic and minimally invasive approaches designed for precision, recovery, and patient comfort.',
            ],
            [
                'title' => 'Laparoscopy',
                'description' => 'Modern keyhole surgery options with smaller incisions, less pain, and faster recovery.',
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
