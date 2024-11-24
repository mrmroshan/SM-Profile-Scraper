<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    protected $fillable = [
        'name',
        'base_url',
        'rate_limit',
        'user_agent'
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}