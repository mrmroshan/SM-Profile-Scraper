<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Platform;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlatformTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_platform()
    {
        $platformData = [
            'name' => 'LinkedIn',
            'base_url' => 'https://www.linkedin.com',
            'rate_limit' => 50,
            'user_agent' => 'Mozilla/5.0'
        ];

        Platform::create($platformData);

        $this->assertDatabaseHas('platforms', [
            'name' => 'LinkedIn'
        ]);
    }
}