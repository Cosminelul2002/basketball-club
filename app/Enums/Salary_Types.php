<?php

namespace App\Enums;

enum Salary_Types: string
{
    case fixed = 'Fix';

    case hourly = 'Pe oră';

    case daily = 'Zilnic';

    case weekly = 'Săptămânal';

    case monthly = 'Lunar';

    case commission = 'Comision';

    case bonus = 'Bonus';

    case other = 'Altele';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
