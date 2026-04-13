<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceSection extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'copy',
        'list_items',
        'copy_blocks',
        'split_columns',
        'sort_order',
    ];

    protected $casts = [
        'list_items' => 'array',
        'copy_blocks' => 'array',
        'split_columns' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
