<?php

namespace App\Enums;

enum Coach_Roles: string
{
    case Fondator = 'Patron';
    case HeadCoach = 'Antrenor Principal';
    case AssistantCoach = 'Antrenor Asistent';
    case PlayerCoach = 'Antrenor Jucător';
    case TeamCoach = 'Antrenor Echipă';
    case Coach = 'Antrenor';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
