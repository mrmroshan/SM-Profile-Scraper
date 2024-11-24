<?php

use App\Http\Controllers\ScraperController;
use Illuminate\Support\Facades\Route;

// Existing route
Route::get('/', function () {
    return view('welcome');
});

// New scraper routes
Route::prefix('api/scraper')->group(function () {
    Route::post('/tasks', [ScraperController::class, 'scheduleScrapingTask']);
    Route::get('/tasks', [ScraperController::class, 'getScrapingStatus']);
    Route::get('/platforms/{platform}', [ScraperController::class, 'getPlatformConfig']);
});