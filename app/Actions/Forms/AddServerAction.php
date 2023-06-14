<?php

namespace App\Actions\Forms;

use App\DTO\Website\WebsiteStore;
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
        $this->cacheService->store($this->repository->store($store));
    }
}
