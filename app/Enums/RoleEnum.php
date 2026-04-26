<?php

namespace App\Enums;

enum RoleEnum: string{
    case admin = 'admin';
    case student = 'student';
    case teacher = 'teacher';

    public function label(): string
    {
        return match($this)
        {
            self::admin => 'Админ',
            self::student => 'Ученик',
            self::teacher => 'Учитель',
        };
    }

    // public function guardName(): string
    // {
    //     return match ($this) {
    //         static::admin => 'admin',
    //         static::student => 'student',
    //         static::teacher => 'teacher',
    //     };
    // }
}