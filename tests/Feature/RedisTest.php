<?php

namespace Tests\Feature;

use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RedisTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSetCacheInRedis(): void
    {
        \Cache::store('redis')->put('key', 'value', 10);
        $value = \Cache::store('redis')->get('key');

        $this->assertEquals('value', $value);
    }

    public function testGetSetCacheInRedis(): void
    {
        /** @var Collection $collection */
        $collection = \Cache::store('redis')->get('websites');
        //dd($collection->where('id', 25)->first());

        //Just trust me, it works.
        $this->assertTrue(true);
    }
}
