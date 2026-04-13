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
    ];

    public static function singleton(): self
    {
        return static::query()->firstOrCreate(['id' => 1], CmsDefaults::siteSettings());
    }
}
