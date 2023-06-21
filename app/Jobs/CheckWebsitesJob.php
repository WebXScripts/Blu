<?php

namespace App\Jobs;

use App\DTO\ScanHistory\ScanHistoryStore;
use App\DTO\Website\WebsiteCache;
use App\Repositories\Interfaces\ScanHistoryInterface;
use App\Services\WebsiteCacheService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\SimpleCache\InvalidArgumentException;
use Scrapper\Checker;

class CheckWebsitesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly WebsiteCacheService $websiteCacheService,
        private readonly Checker $checker
    ) {}

    /**
     * Execute the job.
     * @throws InvalidArgumentException
     */
    public function handle(ScanHistoryInterface $repository): void
    {
        $this->websiteCacheService->getAllCached()->each(function(array $website) use ($repository) {
            if($website['last_checked_at'] === null
                || Carbon::parse($website['last_checked_at'])->addMinutes($website['interval'])->isPast()
            ) {
                $check = $this->checker->check($website['url']);
                $this->websiteCacheService->update(
                    new WebsiteCache(
                        id: $website['id'],
                        url: $website['url'],
                        interval: $website['interval'],
                        last_checked_at: Carbon::now(),
                    )
                );

                $repository->store(
                    new ScanHistoryStore(
                        website_id: $website['id'],
                        status_code: $check->status_code->value,
                        response_time: $check->response_time,
                    )
                );
            }
        });
    }
}
