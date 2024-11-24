<?php

namespace App\Services\Scraper;

use InvalidArgumentException;
use App\Services\Scraper\Interfaces\PlatformScraperInterface;
use App\Services\Scraper\InstagramScraper;
use App\Services\Scraper\TwitterScraper;

class ScraperFactory
{
    public static function create(string $platform, array $config): PlatformScraperInterface
    {
        switch (strtolower($platform)) {
            case 'instagram':
                return new InstagramScraper($config);
            case 'twitter':
                return new TwitterScraper($config);
            default:
                throw new InvalidArgumentException("Unsupported platform: {$platform}");
        }
    }
}