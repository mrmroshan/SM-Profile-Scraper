<?php

namespace App\Services;

use App\Models\Platform;
use App\Models\Task;
use InvalidArgumentException;

class ScrapingService
{
    public function createTask(int $platformId, string $profileUrl): Task
    {
        $platform = Platform::find($platformId);

        if (!$platform) {
            throw new InvalidArgumentException("Platform not found with ID: {$platformId}");
        }

        return Task::create([
            'platform_id' => $platformId,
            'profile_url' => $profileUrl,
            'status' => 'pending'
        ]);
    }
}