<?php

namespace App\Enums;

enum AttendenceStatusEnum: string
{
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
