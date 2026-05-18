<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum WeekDaysEnum: string
{
    use EnumTrait;

    case monday = 'monday';
    case tuesday = 'tuesday';
    case wednesday = 'wednesday';
    case thursday = 'thursday';
    case friday = 'friday';
    case saturday = 'saturday';
    case sunday = 'sunday';

    public function label(): string
    {
        return match ($this) {
            self::monday    => 'Понидельник',
            self::tuesday   => 'Вторник',
            self::wednesday => 'Среда',
            self::thursday  => 'Четверг',
            self::friday    => 'Пятница',
            self::saturday  => 'Суббота',
            self::sunday    => 'Воскресенье',
        };
    }

    public static function values(): array
    {
        $result = [];
        foreach (self::cases() as $item) {
            $result[] = $item->value;
        }
        return $result;
    }
}
