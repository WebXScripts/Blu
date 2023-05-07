<?php

namespace App\Repositories\Interfaces;

use App\DTO\ScanHistory\ScanHistoryStore;
use App\Models\ScanHistory;
use App\Models\Website;
use Illuminate\Database\Eloquent\Collection;

interface ScanHistoryInterface
{
    public function getAll(): Collection;

    public function getAllForWebsite(int $website): Collection;

    public function getLatestForWebsite(int $website): ?ScanHistory;

    public function getLatest(): ?ScanHistory;

    public function store(ScanHistoryStore $store): ScanHistory;

    public function delete(ScanHistory $scanHistory): bool;
}
