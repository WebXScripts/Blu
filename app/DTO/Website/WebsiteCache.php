<?php

namespace App\DTO\Website;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class WebsiteCache extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $url,
        public readonly int $interval,
        public readonly ?Carbon $last_checked_at
    ) {}
}
