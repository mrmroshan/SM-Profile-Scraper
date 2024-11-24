<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\Scraper\TwitterScraper;

class TwitterScraperTest extends TestCase
{
    private TwitterScraper $scraper;

    protected function setUp(): void
    {
        parent::setUp();
        
        $config = [
            'user_agent' => 'Mozilla/5.0',
            'rate_limit' => 100
        ];

        $this->scraper = new TwitterScraper($config);
    }

    public function test_can_scrape_profile_data()
    {
        $url = 'https://twitter.com/testuser';
        $result = $this->scraper->scrapeProfileData($url);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('followers', $result['data']);
        $this->assertArrayHasKey('following', $result['data']);
        $this->assertArrayHasKey('tweets', $result['data']);
    }
}