<?php

namespace App\DTO\Website;

use App\Enums\IntervalUnit;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class WebsiteStore extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly string $description,
        public readonly int $interval,
        public readonly IntervalUnit $intervalUnit,
        public readonly ?UploadedFile $image,
    ) {}
}
