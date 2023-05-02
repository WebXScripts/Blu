<?php

namespace Scrapper\DTO;

use Scrapper\Http\Codes;
use Spatie\LaravelData\Data;

class Response extends Data
{
    public function __construct(
        public readonly Codes $status_code,
        public readonly int $response_time,
    ) {}
}
