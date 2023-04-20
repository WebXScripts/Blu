<?php

namespace App\Console\Commands;

use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CacheWebsitesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache-websites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache websites in Redis.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Caching websites in Redis...');
        \Cache::store('redis')->forget("websites");
        \Cache::store('redis')->rememberForever("websites", static function()
        {
            return Website::all()->map(static function (Website $website)
            {
                return [
                    'id' => $website->id,
                    'url' => $website->url,
                    'interval' => $website->parameters->scan_interval ?? 10,
                    'last_checked_at' => null,
                ];
            })->collect();
        });
        $this->info('Done!');
    }
}
