<?php

namespace Scrapper\Http;

use Illuminate\Log\Logger;
use Scrapper\Abstract\Method;

class Http extends Method
{
    public function status(string $url): Codes
    {
        try {
            $response = \Illuminate\Support\Facades\Http::get($url);
            return Codes::tryFrom($response->status()) ?? Codes::UNKNOWN;
        } catch (\Exception $e) {
            return Codes::CANNOT_CONNECT;
        }
    }
}
