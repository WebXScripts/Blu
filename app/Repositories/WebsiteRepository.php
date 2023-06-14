<?php

namespace App\Repositories;

use App\DTO\Website\WebsiteStore;
use App\Models\Website;
use App\Query\Implements\WebsiteQuery;
use App\Repositories\Interfaces\WebsiteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class WebsiteRepository implements WebsiteRepositoryInterface
{
    public function __construct(
        private WebsiteQuery $query,
        private Website $model
    ) {}

    public function get(int $id): ?Website
    {
        return $this->query
            ->byId($id)
            ->first();
    }

    public function getByUUID(string $uuid): ?Website
    {
        return $this->query
            ->byUUID($uuid)
            ->first();
    }

    public function getAll(): Collection
    {
        return $this->model
            ->all();
    }

    public function store(WebsiteStore $store): Website
    {
        $website = $this->model->create([
            'name' => $store->name,
            'url' => $store->url,
            'description' => $store->description,
            'user_id' => auth()->id(),
        ]);

        if($store->image) {
            try {
                $website->addMedia($store->image)
                    ->toMediaCollection('thumbnail');
            } catch (\Exception $e) {
                logger()->error($e->getMessage());
            }
        }

        $website->parameters()->create([
            'scan_interval' => 10, //todo; make this configurable
        ]);

        return $website;
    }
}
