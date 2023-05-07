<?php

namespace App\Console;

use App\Jobs\CheckWebsitesJob;
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
     * @throws BindingResolutionException
     * @throws MethodNotFoundException
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(
            new CheckWebsitesJob(
                app()->make(\App\Services\WebsiteCacheService::class),
                app()->make(\App\Repositories\Interfaces\ScanHistoryInterface::class),
                Checker::setMethod(config('checker.method', Http::class))
            )
        )->everyThreeMinutes();
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
