<?php

namespace App\Models;

use App\Support\CmsDefaults;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'seo_title_default',
        'seo_description_default',
        'seo_keywords',
        'seo_image',
        'seo_og_locale',
        'seo_lang',
        'doctor_name',
        'doctor_subtitle',
        'clinic_name',
        'clinic_department',
        'contact_phone',
        'contact_email',
        'contact_address',
        'contact_city',
        'contact_region',
        'contact_postal_code',
        'contact_country',
        'whatsapp_link',
        'insurance_link',
        'google_maps_link',
        'instagram_link',
        'facebook_link',
        'home_slug',
        'home_is_published',
        'home_seo_title',
        'home_seo_description',
        'home_seo_keywords',
        'home_og_image',
        'profile_slug',
        'profile_is_published',
        'profile_seo_title',
        'profile_seo_description',
        'profile_seo_keywords',
        'profile_og_image',
        'services_slug',
        'services_is_published',
        'services_seo_title',
        'services_seo_description',
        'services_seo_keywords',
        'services_og_image',
        'contact_slug',
        'contact_is_published',
        'contact_seo_title',
        'contact_seo_description',
        'contact_seo_keywords',
        'contact_og_image',
    ];

    public static function singleton(): self
    {
        return static::query()->firstOrCreate(['id' => 1], CmsDefaults::siteSettings());
    }
}
