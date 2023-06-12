<?php

namespace App\Repositories;

use App\DTO\ScanHistory\ScanHistoryStore;
use App\Models\ScanHistory;
use App\Query\Implements\ScanHistoryQuery;
use App\Repositories\Interfaces\ScanHistoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class ScanHistoryRepository implements ScanHistoryInterface
{
    public function __construct(
        private ScanHistoryQuery $query,
        private ScanHistory $model
    ) {}

    public function getAll(): Collection
    {
        return $this->model
            ->all();
    }

    public function getAllForWebsite(int $website): Collection
    {
        return $this->query
            ->byWebsiteId($website)
            ->get();
    }

    public function getLatestForWebsite(int $website): ?ScanHistory
    {
        return $this->query
            ->byWebsiteId($website)
            ->latest()
            ->first();
    }

    public function getLatest(): ?ScanHistory
    {
        return $this->query
            ->latest()
            ->first();
    }

    public function store(ScanHistoryStore $store): ScanHistory
    {
        return $this->model->create(
            $store->toArray()
        );
    }

    public function delete(ScanHistory $scanHistory): bool
    {
        return $scanHistory->delete();
    }
}
