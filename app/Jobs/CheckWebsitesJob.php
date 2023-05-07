<?php

namespace App\Jobs;

use App\DTO\ScanHistory\ScanHistoryStore;
use App\DTO\Website\WebsiteCache;
use App\Repositories\Interfaces\ScanHistoryInterface;
use App\Services\WebsiteCacheService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\SimpleCache\InvalidArgumentException;
use Scrapper\Checker;

class CheckWebsitesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private WebsiteCacheService $websiteCacheService;
    private ScanHistoryInterface $scanHistoryRepository;
    private Checker $checker;

    public function __construct(
        WebsiteCacheService $websiteCacheService,
        ScanHistoryInterface $scanHistoryRepository,
        Checker $checker
    )
    {
        $this->websiteCacheService = $websiteCacheService;
        $this->scanHistoryRepository = $scanHistoryRepository;
        $this->checker = $checker;
    }

    /**
     * Execute the job.
     * @throws InvalidArgumentException
     */
    public function handle(): void
    {
        $this->websiteCacheService->getAllCached()->each(function (array &$website) {
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

                $this->scanHistoryRepository->store(
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
