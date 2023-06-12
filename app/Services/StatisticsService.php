<?php

namespace App\Services;

use App\Repositories\Interfaces\ScanHistoryInterface;

readonly class StatisticsService
{
    public function __construct(
        private ScanHistoryInterface $scanHistoryRepository
    ) {}

    public function calculateAverageUpTimePercent(): float
    {
        return 100;
    }
}
