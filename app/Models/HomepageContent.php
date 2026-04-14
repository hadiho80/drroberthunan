<?php

namespace App\Models;

use App\Support\CmsDefaults;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomepageContent extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'hero_primary_cta_label',
        'hero_primary_cta_url',
        'hero_image',
        'doctor_intro_title',
        'doctor_intro_body',
        'doctor_intro_stat',
        'doctor_intro_cta_label',
        'doctor_intro_cta_url',
        'doctor_intro_image',
        'about_title',
        'about_body',
        'about_secondary_body',
        'about_cta_label',
        'about_cta_url',
        'about_image',
        'services_title',
        'highlights_title',
        'highlight_bottom_image',
        'contact_title',
        'contact_image',
        'contact_success_message',
        'contact_name_placeholder',
        'contact_phone_placeholder',
        'contact_email_placeholder',
        'contact_message_placeholder',
        'contact_button_label',
    ];

    public static function singleton(): self
    {
        return static::query()->firstOrCreate(['id' => 1], CmsDefaults::homepage());
    }

    public function highlights(): HasMany
    {
        return $this->hasMany(HomepageHighlight::class, 'homepage_content_id')->orderBy('sort_order');
    }

    public function serviceCards(): HasMany
    {
        return $this->hasMany(HomepageServiceCard::class, 'homepage_content_id')->orderBy('sort_order');
    }
}
