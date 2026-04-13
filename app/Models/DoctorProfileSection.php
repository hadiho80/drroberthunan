<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorProfileSection extends Model
{
    protected $fillable = [
        'doctor_profile_id',
        'key',
        'title',
        'intro',
        'items',
        'sort_order',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function doctorProfile(): BelongsTo
    {
        return $this->belongsTo(DoctorProfile::class);
    }
}
