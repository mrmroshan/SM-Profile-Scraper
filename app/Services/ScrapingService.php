<?php

namespace App\Services;

use App\Models\Platform;
use App\Models\Task;
use App\Models\Profile;
use App\Services\Scraper\ScraperFactory;
use Exception;
use InvalidArgumentException;

class ScrapingService
{
    // ... existing createTask method ...

    public function executeTask(int $taskId): bool
    {
        $task = Task::findOrFail($taskId);
        $task->update(['status' => 'processing']);

        try {
            // Get platform configuration
            $platform = $task->platform;
            $config = [
                'user_agent' => $platform->user_agent,
                'rate_limit' => $platform->rate_limit,
            ];

            // Create scraper instance
            $scraper = ScraperFactory::create($platform->name, $config);

            // Execute scraping
            $profileData = $scraper->scrapeProfileData($task->profile_url);

            // Store or update profile data
            $profile = Profile::updateOrCreate(
                [
                    'platform_id' => $platform->id,
                    'profile_url' => $task->profile_url,
                ],
                [
                    'profile_data' => $profileData,
                    'last_scraped_at' => now(),
                ]
            );

            // Update task status
            $task->update([
                'status' => 'completed',
                'error_message' => null
            ]);

            return true;

        } catch (Exception $e) {
            // Log error and update task status
            \Log::error("Task execution failed: {$e->getMessage()}", [
                'task_id' => $taskId,
                'url' => $task->profile_url
            ]);

            $task->update([
                'status' => 'failed',
                'error_message' => $e->getMessage()
            ]);

            return false;
        }
    }
}