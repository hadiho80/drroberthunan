<?php

namespace App\Models;

use App\Support\CmsDefaults;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactInfo extends Model
{
    protected $fillable = [
        'page_title',
        // 'page_intro',
        'phone',
        'email',
        'address',
        'whatsapp_link',
        'schedule_heading',
        'ask_label',
        'contact_image',
    ];

    public static function singleton(): self
    {
        return static::query()->firstOrCreate(['id' => 1], CmsDefaults::contactInfo());
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ContactSchedule::class)->orderBy('sort_order');
    }
}
