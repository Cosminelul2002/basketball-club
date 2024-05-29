<?php

namespace App\Enums;

enum Currency: string
{
    case RON = 'RON';

    case EUR = 'EUR';

    case USD = 'USD';

    case GBP = 'GBP';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
