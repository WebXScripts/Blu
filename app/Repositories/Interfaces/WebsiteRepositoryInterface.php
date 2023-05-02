<?php

namespace App\Repositories\Interfaces;

use App\DTO\Website\WebsiteStore;
use App\Models\Website;
use Illuminate\Database\Eloquent\Collection;

interface WebsiteRepositoryInterface
{
    public function get(int $id): ?Website;

    public function getByUUID(string $uuid): ?Website;

    public function getAll(): Collection;

    public function store(WebsiteStore $store): Website;
}
