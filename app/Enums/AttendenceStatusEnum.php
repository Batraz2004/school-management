<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum AttendenceStatusEnum: string
{
    use EnumTrait;

    case present = 'present';
    case absent = 'absent';
    case excused = 'excused';
    case late = 'late';

    public function label(): string
    {
        return match ($this) {
            self::present => 'присутствовал',
            self::absent => 'отсутствовал (без уважительной причины)',
            self::excused => 'отсутствовал (по уважительной причине)',
            self::late => 'опоздал',
        };
    }
}
