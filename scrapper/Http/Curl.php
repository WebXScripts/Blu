<?php

namespace Scrapper\Http;

use Scrapper\Abstract\Method;

class Curl extends Method
{
    public function status(string $url): Codes
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
            $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return Codes::tryFrom($response) ?? Codes::UNKNOWN;
        } catch (\Exception $e) {
            return Codes::CANNOT_CONNECT;
        }
    }
}
