<?php

namespace App\Enums;

enum Staff_Roles: string
{
    case admin = 'admin';

    case coach = 'coach';

    case doctor = 'doctor';

    case player = 'player';

    case scout = 'scout';

    case staff = 'staff';

    case team_manager = 'team-manager';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
