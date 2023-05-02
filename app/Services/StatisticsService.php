<?php

namespace App\Services;

use App\Models\Website;
use App\Repositories\Interfaces\WebsiteRepositoryInterface;

class StatisticsService
{
    private WebsiteRepositoryInterface $websiteRepository;

    public function __construct(WebsiteRepositoryInterface $websiteRepository)
    {
        $this->websiteRepository = $websiteRepository;
    }

    public function calculateAverageUpTimePercent(): float
    {
        $websites = $this->websiteRepository->getAll();
        if ($websites->count() > 0) {
            return 100 - $websites->sum(static function (Website $website) {
                    if ($website->scanHistories->where('status_code', '!=', 1)->count() > 0) {
                        (float)($website->scanHistories
                                ->where('status_code', 1)
                                ->where('status_code', '=<', 400)
                                ->count() / $website->scanHistories->count());
                        return $website->scanHistories->where('status_code', '!=', 1)
                                ->count() / $website->scanHistories->count();
                    }
                    return 0;
                });
        }
        return 0;
    }

}
