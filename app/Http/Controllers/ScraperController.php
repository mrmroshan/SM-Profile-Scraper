<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\Task;
use App\Services\ScrapingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ScraperController extends Controller
{
    private ScrapingService $scrapingService;

    public function __construct(ScrapingService $scrapingService)
    {
        $this->scrapingService = $scrapingService;
    }

    public function scheduleScrapingTask(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'profile_url' => 'required|url'
        ]);

        $task = $this->scrapingService->createTask(
            $validated['platform_id'],
            $validated['profile_url']
        );

        return response()->json([
            'message' => 'Task scheduled successfully',
            'task_id' => $task->id
        ]);
    }

    public function getScrapingStatus(): JsonResponse
    {
        $tasks = Task::with('platform')
            ->latest()
            ->take(50)
            ->get();

        return response()->json([
            'tasks' => $tasks
        ]);
    }

    public function getPlatformConfig(Platform $platform): JsonResponse
    {
        return response()->json([
            'platform' => $platform->only([
                'id', 'name', 'base_url', 'rate_limit', 'user_agent'
            ])
        ]);
    }
}