<?php

namespace App\Enums;

enum HomeWorkStatusEnum: string
{
    case fullfiled        = 'fullfiled';
    case partially_made   = 'partially_made';
    case not_done         = 'not_done';
    case not_done_excused = 'not_done_excused';

    public function label(): string
    {
        return match ($this) {
            self::fullfiled        => 'Выполнил(ла)',
            self::partially_made   => 'Частично сделал(ла)',
            self::not_done         => 'Не сделал(ла)',
            self::not_done_excused => 'Не сделал(ла) по уважительной причине',
        };
    }
}
