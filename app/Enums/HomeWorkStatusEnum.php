<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum HomeWorkStatusEnum: string
{
    use EnumTrait;

    case fullfiled        = 'fullfiled';
    case partially_made   = 'partially_made';
    case not_done         = 'not_done';
    case not_done_excused = 'not_done_excused';
    case in_process       = 'in_process';

    public function label(): string
    {
        return match ($this) {
            self::fullfiled        => 'Выполнил(ла)',
            self::partially_made   => 'Частично сделал(ла)',
            self::not_done         => 'Не сделал(ла)',
            self::not_done_excused => 'Не сделал(ла) по уважительной причине',
            self::in_process => 'в процессе выполнения',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::fullfiled        => 'success',
            self::partially_made   => 'warning',
            self::not_done         => 'danger',
            self::not_done_excused => 'gray',
            self::in_process       => 'gray',

        };
    }
}
