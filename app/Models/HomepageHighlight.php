<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomepageHighlight extends Model
{
    protected $fillable = [
        'homepage_content_id',
        'title',
        'url',
        'image',
        'sort_order',
    ];

    public function homepage(): BelongsTo
    {
        return $this->belongsTo(HomepageContent::class, 'homepage_content_id');
    }
}
