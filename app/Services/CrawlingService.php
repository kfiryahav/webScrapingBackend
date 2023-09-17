<?php

namespace App\Services;

use App\Models\Urls;
use Goutte\Client;
use Illuminate\Support\Facades\Log;

class CrawlingService
{
    public function crawl(string $url, int $depth, bool $crawl_again = false)
    {
        $existingUrl = Urls::where('url', $url)->first();
        if ($existingUrl && !$crawl_again) {
            return ['existingUrl' => $existingUrl];
        }

        $client = new Client();
        $responseHtmlContent = $client->request('GET', $url);
        // Extract links from the page
        $links = $responseHtmlContent->filter('a')->links();

        try {
            foreach ($links as $link) {
                $linkUrl = $link->getUri();
                // Check if this URL has already been crawled
                $existingUrl = Urls::where('url', $linkUrl)->first();

                // If it doesn't exist or the depth is greater, update the depth and save
                if (!$existingUrl || $existingUrl->depth < $depth) {
                    // Save the link with the current depth
                    $newUrl = $existingUrl ?? new Urls;
                    $newUrl->url = $linkUrl;
                    $newUrl->depth = max($existingUrl->depth ?? 0, $depth); // Store the greater depth
                    $newUrl->save();
                    // If depth allows, continue crawling
                    if ($depth > 0) {
                        $this->crawl($linkUrl, $depth - 1, $crawl_again);
                    }
                }
            }
            return ['message' => 'Success'];
        } catch (\Exception $e) {
            Log::error('HTTP request error: ' . $e->getMessage());
            return ['message' => 'Crawling stopped'];
        }
    }
}
