<?php

namespace App\Actions;

use App\Interfaces\IAction;
use App\Models\Website;

class ServerResponseMatchAction implements IAction
{
    const NOT_SCANNED = 0;
    const CANNOT_SCAN = 1;
    const ONLINE = 200;
    const OFFLINE = 400;

    public static function make(...$parameters): int
    {
        /** @var Website $_server */
        $_server = $parameters[0];
        $responseCode = $_server
            ->scanHistories
            ->last()
            ?->status_code;

        if($responseCode == null) return self::NOT_SCANNED;
        if($responseCode == 1) return self::CANNOT_SCAN;
        if($responseCode >= 400) return self::OFFLINE;
        return self::ONLINE;
    }
}
