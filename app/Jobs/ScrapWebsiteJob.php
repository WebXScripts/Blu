<?php

namespace App\Jobs;

use App\Models\ScanHistory;
use App\Models\Website;
use App\Services\WebsiteCacheService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\SimpleCache\InvalidArgumentException;
use Scrapper\Checker;
use Scrapper\Exceptions\MethodNotFoundException;
use Scrapper\Http\Http;

class ScrapWebsiteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     * @throws InvalidArgumentException|MethodNotFoundException
     */
    public function handle(): void
    {
        \Cache::store('redis')->forget('websites');
        $_service = new WebsiteCacheService();
        $_cache = $_service->getAllCached();
        $_scrapper = Checker::setMethod(Http::class);
        $_cache->each(static function (array &$website) use ($_scrapper) {
            if($website['last_checked_at'] === null || $website['last_checked_at'] + $website['interval'] * 60 < time()) {
                $check = $_scrapper->check($website['url']);
                $website['last_checked_at'] = time();
                $website['status'] = $check->status_code->value;

                ScanHistory::create([
                    'website_id' => $website['id'],
                    ...$check->toArray()
                ]);
            }
        });
    }
}
