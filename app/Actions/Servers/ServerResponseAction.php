<?php

namespace App\Actions\Servers;

use Illuminate\Support\Facades\Http;

class ServerResponseAction
{
    public static function handle(string $url): bool
    {
        try {
            return Http::get($url)->ok();
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return false;
        }
    }
}
