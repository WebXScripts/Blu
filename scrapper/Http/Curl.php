<?php

namespace Scrapper\Http;

use Scrapper\Abstract\Method;
use Scrapper\DTO\Response;

class Curl extends Method
{
    public function status(string $url): Response
    {
        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_exec($ch);
            curl_close($ch);

            return new Response(
                status_code: Codes::tryFrom(curl_getinfo($ch, CURLINFO_HTTP_CODE)) ?? Codes::UNKNOWN,
                response_time: (curl_getinfo($ch, CURLINFO_TOTAL_TIME) * 1000) ?? null
            );
        } catch (\Exception $e) {
            return new Response(
                status_code: Codes::CANNOT_CONNECT,
                response_time: 0
            );
        }
    }
}
