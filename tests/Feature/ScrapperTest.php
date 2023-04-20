<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Scrapper\Checker;
use Scrapper\Exceptions\MethodNotFoundException;
use Scrapper\Http\Curl;
use Scrapper\Http\Http;
use Tests\TestCase;

class ScrapperTest extends TestCase
{
    public function testHttpOnGoogle(): void
    {
        $response = Checker::setMethod(Http::class)->check('https://google.com');
        $this->assertEquals(200, $response->value);
    }

    public function testHttpOnFacebook(): void
    {
        $response = Checker::setMethod(Http::class)->check('https://facebook.com');
        $this->assertEquals(200, $response->value);
    }

    public function testCurlOnGoogle(): void
    {
        $response = Checker::setMethod(Curl::class)->check('https://google.com');
        $this->assertEquals(200, $response->value);
    }

    public function testCurlOnFacebook(): void
    {
        $response = Checker::setMethod(Curl::class)->check('https://facebook.com');
        $this->assertEquals(200, $response->value);
    }

    public function testHttpOnNotExisting(): void
    {
        $_random = Str::random(10);
        $response = Checker::setMethod(Http::class)->check("https://{$_random}.com");
        $this->assertEquals(1, $response->value);
    }

    public function testCurlOnNotExisting(): void
    {
        $_random = Str::random(10);
        $response = Checker::setMethod(Curl::class)->check("https://{$_random}.com");
        $this->assertEquals(0, $response->value);
    }

    public function testNotExistingMethod(): void
    {
        $_random = Str::random(10);
        try {
            Checker::setMethod($_random)->check("https://{$_random}.com");
        } catch (MethodNotFoundException $e) {
            $this->assertTrue(true, $e->getMessage());
        }
    }
}
