<?php

namespace App\Services;

class SingularLowerNouns
{
    public static function makeSingularLowercase($noun)
    {
        $lastLetter = substr($noun, -1);
        $lastTwoLetters = substr($noun, -2);

        if ($lastTwoLetters === 'es') {
            return substr($noun, 0, -2);
        }

        if ($lastLetter === 's') {
            return substr($noun, 0, -1);
        }
        
        return $noun;
    }
}
