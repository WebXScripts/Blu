<?php

namespace App\Actions\Forms;

use App\DTO\Website\WebsiteStore;
use App\Jobs\FirstTimeScanJob;
use App\Repositories\Interfaces\WebsiteRepositoryInterface;
use App\Services\WebsiteCacheService;

readonly class AddServerAction
{
    public function __construct(
        private WebsiteRepositoryInterface $repository,
        private WebsiteCacheService $cacheService,
    ) {}

    public function handle(WebsiteStore $store): void
    {
        $website = $this->repository->store($store);
        $website->parameters()->create([
            'scan_interval' => $store->intervalUnit->convertToSeconds($store->interval)
        ]);
        $this->cacheService->store($website);
        FirstTimeScanJob::dispatch($website);
    }
}
