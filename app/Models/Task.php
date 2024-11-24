<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'platform_id',
        'profile_url',
        'status',
        'error_message'
    ];

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
}