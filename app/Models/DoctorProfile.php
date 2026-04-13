<?php

namespace App\Models;

use App\Support\CmsDefaults;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DoctorProfile extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'intro',
        'biography',
        'image',
    ];

    public static function singleton(): self
    {
        return static::query()->firstOrCreate(['id' => 1], CmsDefaults::doctorProfile());
    }

    public function sections(): HasMany
    {
        return $this->hasMany(DoctorProfileSection::class)->orderBy('sort_order');
    }
}
