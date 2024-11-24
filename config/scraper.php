<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Scraping Queue Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure the queue settings for scraping tasks
    |
    */
    'queue' => [
        'name' => 'scraping',
        'connection' => 'redis',
        'retry_after' => 3600, // 1 hour
        'max_attempts' => 3,
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Global rate limiting settings that apply to all platforms
    | unless overridden in the platform configuration
    |
    */
    'rate_limit' => [
        'default' => 60, // requests per minute
        'decay' => 60,   // time window in seconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Task Cleanup
    |--------------------------------------------------------------------------
    |
    | Settings for cleaning up old tasks and failed jobs
    |
    */
    'cleanup' => [
        'keep_completed_for_days' => 7,
        'keep_failed_for_days' => 30,
    ],
];