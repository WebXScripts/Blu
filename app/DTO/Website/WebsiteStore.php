<?php

namespace App\DTO\Website;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class WebsiteStore extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly string $description,
        public readonly ?UploadedFile $image,
    ) {}
}
