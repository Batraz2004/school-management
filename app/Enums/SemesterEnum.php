<?php

namespace App\Enums;

enum SemesterEnum: string{
    case autumn = 'autumn';
    case spring = 'spring';

    public function label(): string
    {
        return match($this)
        {
            self::autumn => 'Осень',
            self::spring => 'Весна',
        };
    }
}