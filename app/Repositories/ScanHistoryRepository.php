<?php

namespace App\Repositories;

use App\DTO\ScanHistory\ScanHistoryStore;
use App\Models\ScanHistory;
use App\Repositories\Interfaces\ScanHistoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ScanHistoryRepository implements ScanHistoryInterface
{
    public static function getAll(int $website): Collection
    {
        return ScanHistory::where('website_id', $website)
            ->get();
    }

    public static function getLatest(int $website): ?ScanHistory
    {
        return ScanHistory::where('website_id', $website)
            ->latest()
            ->first();
    }

    public function store(ScanHistoryStore $store): ScanHistory
    {
        return ScanHistory::create(
            $store->toArray()
        );
    }

    public function delete(ScanHistory $scanHistory): bool
    {
        return $scanHistory->delete();
    }
}
