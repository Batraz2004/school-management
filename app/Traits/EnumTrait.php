<?php

namespace App\Traits;

trait EnumTrait
{
    public function label(): string
    {
        return match ($this) {
            default => 'default',
        };
    }

    public static function labels(): array
    {
        $result = [];

        foreach (self::cases() as $case) {
            $result[$case->value] = $case->label();
        }

        return $result;
    }
}
