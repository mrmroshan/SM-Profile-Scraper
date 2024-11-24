<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'platform_id',
        'profile_url',
        'profile_data',
        'last_scraped_at'
    ];

    protected $casts = [
        'profile_data' => 'array',
        'last_scraped_at' => 'datetime'
    ];

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
}