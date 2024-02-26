<?php

namespace App\Enums;

enum Positions: string
{
    case GK = 'goalkeeper';

    case RB = 'right-back';

    case CB = 'center-back';

    case LB = 'left-back';

    case CM = 'central-midfielder';

    case RM = 'right-midfielder';

    case LM = 'left-midfielder';

    case CAM = 'center-atacking-midfielder';

    case CDM = 'center-defending-midfielder';

    case LWB = 'left-wing-back';

    case RWB = 'right-wing-back';

    case RW = 'right-wing';

    case ST = 'striker';

    case CF = 'center-forward';

    case LW = 'left-wing';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
