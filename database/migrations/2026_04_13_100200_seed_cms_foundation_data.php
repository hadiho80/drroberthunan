<?php

use App\Support\CmsDefaults;
use App\Support\ServiceContentDefaults;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $legacyHomepage = Schema::hasTable('home_pages')
            ? DB::table('home_pages')->orderBy('id')->first()
            : null;

        $siteSettings = array_merge(CmsDefaults::siteSettings(), [
            'site_name' => $legacyHomepage->site_name ?? CmsDefaults::siteSettings()['site_name'],
            'seo_title_default' => $legacyHomepage->seo_title ?? CmsDefaults::siteSettings()['seo_title_default'],
            'seo_description_default' => $legacyHomepage->seo_description ?? CmsDefaults::siteSettings()['seo_description_default'],
            'seo_keywords' => $legacyHomepage->seo_keywords ?? CmsDefaults::siteSettings()['seo_keywords'],
            'seo_image' => $legacyHomepage->seo_image ?? CmsDefaults::siteSettings()['seo_image'],
            'contact_phone' => $legacyHomepage->contact_phone ?? CmsDefaults::siteSettings()['contact_phone'],
            'contact_email' => $legacyHomepage->contact_email ?? CmsDefaults::siteSettings()['contact_email'],
            'contact_address' => $legacyHomepage->contact_address ?? CmsDefaults::siteSettings()['contact_address'],
        ]);

        DB::table('site_settings')->updateOrInsert(['id' => 1], $siteSettings + $this->timestamps());
        DB::table('homepage_contents')->updateOrInsert(['id' => 1], CmsDefaults::homepage() + $this->timestamps());
        DB::table('doctor_profiles')->updateOrInsert(['id' => 1], array_merge(CmsDefaults::doctorProfile(), [
            'intro' => $legacyHomepage->doctor_profile_intro ?? CmsDefaults::doctorProfile()['intro'],
            'biography' => $legacyHomepage->doctor_profile_biography ?? CmsDefaults::doctorProfile()['biography'],
            'image' => $legacyHomepage->doctor_profile_image ?? CmsDefaults::doctorProfile()['image'],
        ]) + $this->timestamps());
        DB::table('contact_infos')->updateOrInsert(['id' => 1], array_merge(CmsDefaults::contactInfo(), [
            'page_title' => $legacyHomepage->contact_page_title ?? CmsDefaults::contactInfo()['page_title'],
            'page_intro' => $legacyHomepage->contact_page_intro ?? CmsDefaults::contactInfo()['page_intro'],
        ]) + $this->timestamps());

        foreach (CmsDefaults::homepageHighlights() as $highlight) {
            DB::table('homepage_highlights')->updateOrInsert(
                ['homepage_content_id' => 1, 'title' => $highlight['title']],
                $highlight + ['homepage_content_id' => 1] + $this->timestamps()
            );
        }

        foreach (CmsDefaults::doctorProfileSections() as $section) {
            $items = match ($section['key']) {
                'experience' => $this->legacyLines($legacyHomepage->doctor_profile_experience ?? null) ?: $section['items'],
                'education' => $this->legacyLines($legacyHomepage->doctor_profile_education ?? null) ?: $section['items'],
                'training' => $this->legacyLines($legacyHomepage->doctor_profile_training ?? null) ?: $section['items'],
                default => $section['items'],
            };

            DB::table('doctor_profile_sections')->updateOrInsert(
                ['doctor_profile_id' => 1, 'key' => $section['key']],
                [
                    'doctor_profile_id' => 1,
                    'title' => $section['title'],
                    'intro' => $section['intro'],
                    'items' => json_encode($items, JSON_UNESCAPED_UNICODE),
                    'sort_order' => $section['sort_order'],
                ] + $this->timestamps()
            );
        }

        foreach (CmsDefaults::contactSchedules() as $schedule) {
            DB::table('contact_schedules')->updateOrInsert(
                ['contact_info_id' => 1, 'sort_order' => $schedule['sort_order']],
                ['contact_info_id' => 1] + $schedule + $this->timestamps()
            );
        }

        foreach (ServiceContentDefaults::all() as $service) {
            $sections = $service['service_sections'];
            unset($service['service_sections']);

            DB::table('services')->updateOrInsert(
                ['slug' => $service['slug']],
                $this->encodeServicePayload($service) + $this->timestamps()
            );

            $serviceId = DB::table('services')->where('slug', $service['slug'])->value('id');

            foreach ($sections as $section) {
                DB::table('service_sections')->updateOrInsert(
                    ['service_id' => $serviceId, 'sort_order' => $section['sort_order']],
                    [
                        'service_id' => $serviceId,
                        'title' => $section['title'],
                        'copy' => $section['copy'] ?? null,
                        'list_items' => isset($section['list_items']) ? json_encode($section['list_items'], JSON_UNESCAPED_UNICODE) : null,
                        'copy_blocks' => isset($section['copy_blocks']) ? json_encode($section['copy_blocks'], JSON_UNESCAPED_UNICODE) : null,
                        'split_columns' => $section['split_columns'] ?? false,
                    ] + $this->timestamps()
                );
            }
        }
    }

    public function down(): void
    {
        DB::table('service_sections')->delete();
        DB::table('services')->whereNotNull('slug')->delete();
        DB::table('contact_schedules')->delete();
        DB::table('contact_infos')->delete();
        DB::table('doctor_profile_sections')->delete();
        DB::table('doctor_profiles')->delete();
        DB::table('homepage_highlights')->delete();
        DB::table('homepage_contents')->delete();
        DB::table('site_settings')->delete();
    }

    private function encodeServicePayload(array $service): array
    {
        $service['description'] = $service['intro'] ?? $service['card_description'] ?? $service['title'];

        foreach (['overview_items', 'feature_images', 'gallery_images', 'feature_copy'] as $field) {
            if (isset($service[$field])) {
                $service[$field] = json_encode($service[$field], JSON_UNESCAPED_UNICODE);
            }
        }

        return $service;
    }

    private function timestamps(): array
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function legacyLines(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value) ?: [])
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }
};
