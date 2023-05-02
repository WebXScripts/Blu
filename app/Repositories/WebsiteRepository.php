<?php

namespace App\Repositories;

use App\DTO\Website\WebsiteStore;
use App\Models\Website;
use App\Repositories\Interfaces\WebsiteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class WebsiteRepository implements WebsiteRepositoryInterface
{
    public function get(int $id): ?Website
    {
        return Website::where('id', $id)->first();
    }

    public function getByUUID(string $uuid): ?Website
    {
        return Website::where('uuid', $uuid)->first();
    }

    public function getAll(): Collection
    {
        return Website::all();
    }

    public function store(WebsiteStore $store): Website
    {
        $website = Website::create([
            'name' => $store->name,
            'url' => $store->url,
            'description' => $store->description,
            'uuid' => $store->uuid,
            'user_id' => auth()->id(),
        ]);

        $website->parameters()->create([
            'scan_interval' => 10, //todo; make this configurable
        ]);

        return $website;
    }
}
