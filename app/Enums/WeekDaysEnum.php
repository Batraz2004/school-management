<?php

namespace App\Enums;

enum WeekDaysEnum: string
{
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
            self::monday    => 'понидельник',
            self::tuesday   => 'вторник',
            self::wednesday => 'среда',
            self::thursday  => 'четверг',
            self::friday    => 'пятница',
            self::saturday  => 'суббота',
            self::sunday    => 'воскресенье',
        };
    }
}
