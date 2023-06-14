<?php

namespace App\Actions\Servers;

use App\Models\Website;

class ServerResponseMatchAction
{
    const NOT_SCANNED = 0;
    const CANNOT_SCAN = 1;
    const ONLINE = 200;
    const OFFLINE = 400;

    public static function handle(Website $website): int
    {
        $responseCode = $website
            ->scanHistories
            ->last()
            ?->status_code;

        return match($responseCode) {
            null => self::NOT_SCANNED,
            1 => self::CANNOT_SCAN,
            default => $responseCode >= 400 ? self::OFFLINE : self::ONLINE,
        };
    }
}
