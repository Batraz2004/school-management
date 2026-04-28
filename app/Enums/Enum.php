<?php

namespace App\Enums;

trait Enum
{
    public static function toArray(): array
    {
        $result = [];

        /** @method static cases() */
        foreach (self::cases() as $case) {
            $result[$case->name] = [
                'value' => $case->value,
                'label' => $case->label(),
            ];
        }

        return $result;
    }

    public static function values(): array
    {
        $result = [];

        /** @method static cases() */
        foreach (self::cases() as $caseValue) {
            $result[] = $caseValue->value;
        }

        return $result;
    }
}
