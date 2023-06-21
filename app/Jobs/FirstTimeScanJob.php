<?php

namespace App\Jobs;

use App\DTO\ScanHistory\ScanHistoryStore;
use App\Models\Website;
use App\Repositories\ScanHistoryRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Scrapper\Checker;
use Scrapper\Exceptions\MethodNotFoundException;
use Scrapper\Exceptions\ScrapperException;

class FirstTimeScanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly Website $website
    ) {}

    public function handle(ScanHistoryRepository $scanHistoryRepository): void
    {
        try {
            $checked = Checker::setMethod(config('checker.method'))
                ->check($this->website->url);

            $scanHistoryRepository->store(
                new ScanHistoryStore(
                    website_id: $this->website->id,
                    status_code: $checked->status_code->value,
                    response_time: $checked->response_time,
                )
            );
        } catch (MethodNotFoundException|ScrapperException $e) {
            logger()->error("Error while checking website {$this->website->url}");
            logger()->error($e->getMessage());
        }
    }
}
