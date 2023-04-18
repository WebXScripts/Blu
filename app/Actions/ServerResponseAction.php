<?php

namespace App\Actions;

use App\Interfaces\IAction;
use Illuminate\Support\Facades\Http;

class ServerResponseAction implements IAction
{
    public static function make(...$parameters): bool
    {
        try {
            return self::checkServerResponse($parameters[0]);
        } catch (\Exception $_) {
            return false;
        }
    }

    private static function checkServerResponse(string $url): bool
    {
        $response = Http::get($url);
        return $response->ok();
    }
}
