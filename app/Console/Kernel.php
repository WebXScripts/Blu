<?php

namespace App\Console;

use App\DTO\ScanHistory\ScanHistoryStore;
use App\Jobs\CheckWebsitesJob;
use App\Repositories\ScanHistoryRepository;
use App\Services\WebsiteCacheService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Scrapper\Checker;
use Scrapper\Exceptions\MethodNotFoundException;
use Scrapper\Http\Http;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule
            ->job(new CheckWebsitesJob(
                websiteCacheService: new WebsiteCacheService(),
                checker: Checker::setMethod(config('checker.method'))
            ))->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
