<?php

namespace App\Services\Scraper\Interfaces;

interface PlatformScraperInterface
{
    public function login();
    public function scrapeProfileData(string $url): array;
    public function handlePagination();
    public function parseContent(string $html): array;
}