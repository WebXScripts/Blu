<?php

namespace Scrapper\Http;

use Scrapper\Abstract\Method;
use Scrapper\DTO\Response;

class Http extends Method
{
    public function status(string $url): Response
    {
        try {
            $response = \Illuminate\Support\Facades\Http::get($url);
            return new Response(
                status_code: Codes::tryFrom($response->status()) ?? Codes::UNKNOWN,
                response_time: ($response->handlerStats()['total_time'] * 1000) ?? null
            );
        } catch (\Exception $e) {
            return new Response(
                status_code: Codes::CANNOT_CONNECT,
                response_time: 0
            );
        }
    }
}
