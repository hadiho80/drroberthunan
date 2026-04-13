<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'eyebrow',
        'intro',
        'card_description',
        'card_icon',
        'card_image',
        'hero_image',
        'highlight_image',
        'hero_suffix',
        'hero_body',
        'overview_title',
        'overview_items',
        'overview_split_columns',
        'show_intro',
        'custom_layout',
        'feature_image',
        'feature_images',
        'gallery_images',
        'feature_copy',
        'image',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'overview_items' => 'array',
        'overview_split_columns' => 'boolean',
        'show_intro' => 'boolean',
        'feature_images' => 'array',
        'gallery_images' => 'array',
        'feature_copy' => 'array',
        'is_featured' => 'boolean',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(ServiceSection::class)->orderBy('sort_order');
    }
}
