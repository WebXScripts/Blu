<?php

namespace App\Services;

use App\Repositories\Interfaces\ScanHistoryInterface;
use Scrapper\Http\Codes;

class StatisticsService
{
    private ScanHistoryInterface $scanHistoryRepository;

    public function __construct(ScanHistoryInterface $scanHistoryRepository)
    {
        $this->scanHistoryRepository = $scanHistoryRepository;
    }

    public function calculateAverageUpTimePercent(): float
    {
        $all = $this->scanHistoryRepository->getAll();
        return ($all
                ->where('created_at', '>=', now()->subDays(30))
                ->where('status_code', Codes::ONLINE->value)
                ->count() /
            $all->where('created_at', '>=', now()->subDays(30))
                ->count()) * 100;
    }
}
