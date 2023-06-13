<?php

namespace App\DTO\ScanHistory;

use Spatie\LaravelData\Data;

class ScanHistoryStore extends Data
{
    public function __construct(
        public readonly string $website_id,
        public readonly int $status_code,
        public readonly int $response_time,
    ) {}
}
