<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'base_url',
        'rate_limit',
        'user_agent'
    ];
}
