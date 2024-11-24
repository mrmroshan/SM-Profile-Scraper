<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run()
    {
        Platform::create([
            'name' => 'Instagram',
            'base_url' => 'https://www.instagram.com',
            'rate_limit' => 100,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ]);

        Platform::create([
            'name' => 'Twitter',
            'base_url' => 'https://twitter.com',
            'rate_limit' => 150,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ]);
    }
}