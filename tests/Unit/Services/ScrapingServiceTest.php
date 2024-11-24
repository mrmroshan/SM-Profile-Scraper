<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Platform;
use App\Models\Task;
use App\Services\ScrapingService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScrapingServiceTest extends TestCase
{
    use RefreshDatabase;

    private ScrapingService $scrapingService;
    private Platform $platform;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test platform
        $this->platform = Platform::create([
            'name' => 'Instagram',
            'base_url' => 'https://www.instagram.com',
            'rate_limit' => 100,
            'user_agent' => 'Mozilla/5.0'
        ]);

        $this->scrapingService = new ScrapingService();
    }

    public function test_can_create_scraping_task()
    {
        $profileUrl = 'https://www.instagram.com/testuser';
        
        $task = $this->scrapingService->createTask(
            $this->platform->id,
            $profileUrl
        );

        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals($profileUrl, $task->profile_url);
        $this->assertEquals('pending', $task->status);
    }

    public function test_throws_exception_for_invalid_platform()
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $this->scrapingService->createTask(
            999, // Invalid platform ID
            'https://www.instagram.com/testuser'
        );
    }
}