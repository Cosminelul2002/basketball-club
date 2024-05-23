<?php

namespace App\Enums;

enum Salary_Types: string
{
    case fixed = 'fixed';

    case hourly = 'hourly';

    case daily = 'daily';

    case weekly = 'weekly';

    case monthly = 'monthly';

    case commission = 'commission';

    case bonus = 'bonus';

    case other = 'other';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
