<?php

namespace App\Enums;

enum IntervalUnit: string
{
    case Minutes = 'minutes';
    case Hours = 'hours';
    case Days = 'days';
    case Weeks = 'weeks';
    case Months = 'months';
    case Years = 'years';

    public function convertToSeconds(int $value): int
    {
        return match ($this) {
            self::Minutes => $value * 60,
            self::Hours => $value * 60 * 60,
            self::Days => $value * 60 * 60 * 24,
            self::Weeks => $value * 60 * 60 * 24 * 7,
            self::Months => $value * 60 * 60 * 24 * 30,
            self::Years => $value * 60 * 60 * 24 * 365,
        };
    }
}
