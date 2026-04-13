<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactSchedule extends Model
{
    protected $fillable = [
        'contact_info_id',
        'day_label',
        'time_label',
        'opens_at',
        'closes_at',
        'sort_order',
    ];

    public function contactInfo(): BelongsTo
    {
        return $this->belongsTo(ContactInfo::class);
    }
}
