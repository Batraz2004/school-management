<?php

namespace App\Enums;

use App\Traits\EnumTrait;
use Carbon\CarbonImmutable;

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

    public function short(): string
    {
        return match ($this) {
            self::monday    => 'ПН',
            self::tuesday   => 'ВТ',
            self::wednesday => 'СР',
            self::thursday  => 'ЧТ',
            self::friday    => 'ПТ',
            self::saturday  => 'СБ',
            self::sunday    => 'ВС',
        };
    }

    public static function getWeekDays(CarbonImmutable $weekStart): array
    {
        $workDays = [
            self::monday,
            self::tuesday,
            self::wednesday,
            self::thursday,
            self::friday,
        ];

        $result = [];
        foreach ($workDays as $index => $day) {
            $result[$day->value] = [
                'short' => $day->short(),
                'label' => $day->label(),
                'date'  => $weekStart->addDays($index)->format('j M'),
            ];
        }

        return $result;
    }

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
