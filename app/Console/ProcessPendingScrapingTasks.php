<?php

namespace App\Console\Commands;

use App\Jobs\ExecuteScrapingTask;
use App\Models\Task;
use Illuminate\Console\Command;

class ProcessPendingScrapingTasks extends Command
{
    protected $signature = 'scraper:process-pending';
    protected $description = 'Process all pending scraping tasks';

    public function handle()
    {
        $pendingTasks = Task::where('status', 'pending')
            ->with('platform')
            ->get();

        $this->info("Found {$pendingTasks->count()} pending tasks");

        foreach ($pendingTasks as $task) {
            $this->line("Dispatching task {$task->id} for {$task->platform->name}");
            ExecuteScrapingTask::dispatch($task->id)
                ->onQueue('scraping');
        }

        $this->info('All pending tasks have been queued');
    }
}