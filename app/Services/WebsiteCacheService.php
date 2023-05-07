<?php

namespace App\Services;

use App\DTO\Website\WebsiteCache;
use App\Models\Website;
use Illuminate\Support\Collection;
use Psr\SimpleCache\InvalidArgumentException;

class WebsiteCacheService //todo: make it a repository?
{
    /**
     * Get a website from cache.
     * @param int $id
     * @return array|null
     * @throws InvalidArgumentException
     */
    public function get(int $id): ?array
    {
        /** @var array $cachedWebsite */
        return \Cache::store('redis')
            ->get('websites', collect())
            ->where('id', $id)
            ->first();
    }

    /**
     * Get all cached websites.
     * @return Collection
     * @throws InvalidArgumentException
     */
    public function getAllCached(): Collection
    {
        if(!\Cache::store('redis')->get('websites')) {
            $this->mountCache();
        }

        return \Cache::store('redis')->get('websites');
    }

    /**
     * Store a website in cache.
     * @throws InvalidArgumentException
     */
    public function store(Website $website): Collection
    {
        /** @var Collection|null $cachedWebsites */
        $cachedWebsites = \Cache::store('redis')->get('websites');

        if ($cachedWebsites === null) {
            $this->mountCache();
            return \Cache::store('redis')->get('websites', collect());
        }

        $cachedWebsites->push([
            'id' => $website->id,
            'url' => $website->url,
            'interval' => $website->parameters->scan_interval ?? 10,
            'last_checked_at' => null,
        ]);

        \Cache::store('redis')->forever('websites', $cachedWebsites);
        return $cachedWebsites;
    }

    /**
     * Update a website in cache.
     * @throws InvalidArgumentException
     */
    public function update(WebsiteCache $websiteCache): Collection
    {
        /** @var Collection|null $cachedWebsites */
        $cachedWebsites = \Cache::store('redis')->get('websites');

        if ($cachedWebsites === null) {
            $this->mountCache();
            return \Cache::store('redis')->get('websites', collect());
        }

        $cachedWebsites->where('id', $websiteCache->id)->transform(static function() use ($websiteCache) {
            return $websiteCache->toArray();
        });

        \Cache::store('redis')->forever('websites', $cachedWebsites);
        return $cachedWebsites;
    }

    /**
     * Delete a website from cache.
     * @throws InvalidArgumentException
     */
    public function delete(int $id): Collection
    {
        /** @var Collection|null $cachedWebsites */
        $cachedWebsites = \Cache::store('redis')->get('websites');

        if ($cachedWebsites === null) {
            $this->mountCache();
            return \Cache::store('redis')->get('websites', collect());
        }

        //Todo: add annotation to database that website was deleted (?)
        $cachedWebsites->pull($id);

        \Cache::store('redis')->forever('websites', $cachedWebsites);
        return $cachedWebsites;
    }

    /**
     * Mount cache when it's empty.
     */
    private function mountCache(): void
    {
        \Cache::store('redis')->forget('websites');
        \Cache::store('redis')->rememberForever('websites', static function()
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
    }
}
