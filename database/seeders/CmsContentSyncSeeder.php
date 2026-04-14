<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use App\Models\DoctorProfile;
use App\Models\HomepageContent;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Support\CmsDefaults;
use App\Support\ServiceContentDefaults;
use Illuminate\Database\Seeder;

class CmsContentSyncSeeder extends Seeder
{
    public function run(): void
    {
        $this->syncSiteSettings();
        $this->syncHomepage();
        $this->syncDoctorProfile();
        $this->syncContactInfo();
        $this->syncServices();
    }

    private function syncSiteSettings(): void
    {
        SiteSetting::query()->updateOrCreate(['id' => 1], CmsDefaults::siteSettings());
    }

    private function syncHomepage(): void
    {
        $homepage = HomepageContent::query()->updateOrCreate(['id' => 1], CmsDefaults::homepage() + CmsDefaults::homepageContactForm());
        $homepage->highlights()->delete();
        $homepage->serviceCards()->delete();

        foreach (CmsDefaults::homepageHighlights() as $highlight) {
            $homepage->highlights()->create($highlight);
        }

        foreach (CmsDefaults::homepageServiceCards() as $card) {
            $serviceId = Service::query()->where('slug', $card['service_slug'])->value('id');

            if (! $serviceId) {
                continue;
            }

            $homepage->serviceCards()->create([
                'service_id' => $serviceId,
                'sort_order' => $card['sort_order'],
            ]);
        }
    }

    private function syncDoctorProfile(): void
    {
        $profile = DoctorProfile::query()->updateOrCreate(['id' => 1], CmsDefaults::doctorProfile());
        $profile->sections()->delete();

        foreach (CmsDefaults::doctorProfileSections() as $section) {
            $profile->sections()->create($section);
        }
    }

    private function syncContactInfo(): void
    {
        $contact = ContactInfo::query()->updateOrCreate(['id' => 1], CmsDefaults::contactInfo());
        $contact->schedules()->delete();

        foreach (CmsDefaults::contactSchedules() as $schedule) {
            $contact->schedules()->create($schedule);
        }
    }

    private function syncServices(): void
    {
        foreach (ServiceContentDefaults::all() as $serviceData) {
            $sections = $serviceData['service_sections'] ?? [];
            unset($serviceData['service_sections']);

            $service = Service::query()->updateOrCreate(
                ['slug' => $serviceData['slug']],
                $serviceData + [
                    'description' => $serviceData['intro'] ?? $serviceData['card_description'] ?? $serviceData['title'],
                ]
            );

            $service->sections()->delete();

            foreach ($sections as $section) {
                $service->sections()->create($section);
            }
        }
    }
}
