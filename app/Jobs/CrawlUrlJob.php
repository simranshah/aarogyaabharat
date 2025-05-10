<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\Log;

class CrawlUrlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;
    protected $baseDomain;
    protected $depth;

    public function __construct($url, $baseDomain, $depth)
    {
        $this->url = $url;
        $this->baseDomain = $baseDomain;
        $this->depth = $depth;
    }

    public function handle()
    {
        $client = new Client(['timeout' => 5, 'verify' => false]);
        try {
            $response = $client->get($this->url);
            $html = (string) $response->getBody();

            // Save HTML or SEO analysis here
            // Example log for now
            Log::info("Crawled: {$this->url}");

            // Extract links and dispatch further jobs if depth allows
            if ($this->depth > 0) {
                preg_match_all('/<a[^>]+href=["\']?([^"\'>#]+)["\']?/i', $html, $matches);
                $links = array_unique($matches[1]);

                foreach ($links as $link) {
                    $fullUrl = $this->normalizeUrl($link);
                    if ($fullUrl) {
                        CrawlUrlJob::dispatch($fullUrl, $this->baseDomain, $this->depth - 1)->onQueue('crawler');
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error("Failed to crawl {$this->url}: " . $e->getMessage());
        }
    }

    private function normalizeUrl($link)
    {
        if (strpos($link, 'http') === 0 && str_contains($link, $this->baseDomain)) {
            return $link;
        } elseif (strpos($link, '/') === 0) {
            return rtrim($this->baseDomain, '/') . $link;
        }
        return null;
    }
}
