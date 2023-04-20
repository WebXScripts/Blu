<?php

namespace App\DTO;

use Carbon\Carbon;

readonly class WebsiteCacheDto
{
    public int $id;
    public string $url;
    public int $interval;
    public ?Carbon $last_checked_at;

    public function __construct(int $id, string $url, int $interval, ?Carbon $last_checked_at)
    {
        $this->id = $id;
        $this->url = $url;
        $this->interval = $interval;
        $this->last_checked_at = $last_checked_at;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'interval' => $this->interval,
            'last_checked_at' => $this->last_checked_at,
        ];
    }
}
