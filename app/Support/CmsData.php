<?php

namespace App\Support;

use App\Models\ContactInfo;
use App\Models\DoctorProfile;
use App\Models\HomepageContent;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class CmsData
{
    public function siteSettings(): SiteSetting
    {
        return SiteSetting::singleton();
    }

    public function homepage(): HomepageContent
    {
        return HomepageContent::query()
            ->with(['highlights', 'serviceCards.service'])
            ->firstOr(fn () => HomepageContent::singleton()->load(['highlights', 'serviceCards.service']));
    }

    public function doctorProfile(): DoctorProfile
    {
        return DoctorProfile::query()->with('sections')->firstOr(fn () => DoctorProfile::singleton()->load('sections'));
    }

    public function contactInfo(): ContactInfo
    {
        return ContactInfo::query()->with('schedules')->firstOr(fn () => ContactInfo::singleton()->load('schedules'));
    }

    public function services()
    {
        return Service::query()
            ->with('sections')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    public function mediaUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        if (str_starts_with($path, '/')) {
            return url($path);
        }

        return Storage::url($path);
    }

    public function appUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, '/')) {
            return url($path);
        }

        return $path;
    }
}
