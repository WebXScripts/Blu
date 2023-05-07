<?php

namespace App\Repositories\Interfaces;

use App\DTO\ScanHistory\ScanHistoryStore;
use App\Models\ScanHistory;
use App\Models\Website;
use Illuminate\Database\Eloquent\Collection;

interface ScanHistoryInterface
{
    public static function getAll(int $website): Collection;

    public static function getLatest(int $website): ?ScanHistory;

    public function store(ScanHistoryStore $store): ScanHistory;

    public function delete(ScanHistory $scanHistory): bool;
}
