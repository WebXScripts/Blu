<?php

namespace App\Actions\Servers;

class ServerDotMatchAction
{
    const NOT_SCANNED = 'bg-white';
    const CANNOT_SCAN = 'bg-yellow-500';
    const ONLINE = 'bg-green-500';
    const OFFLINE = 'bg-red-500';

    public static function handle(?int $status): string
    {
        return match($status) {
            null => self::NOT_SCANNED,
            1 => self::CANNOT_SCAN,
            default => $status >= 400 ? self::OFFLINE : self::ONLINE,
        };
    }
}
