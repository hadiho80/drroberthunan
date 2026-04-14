<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomepageServiceCard extends Model
{
    protected $fillable = [
        'homepage_content_id',
        'service_id',
        'sort_order',
    ];

    public function homepage(): BelongsTo
    {
        return $this->belongsTo(HomepageContent::class, 'homepage_content_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
