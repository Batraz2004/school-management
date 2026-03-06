<?php

namespace App\Filament\Admin\Resources\Attendences\Schemas;

use App\Enums\AttendenceStatusEnum;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class AttendenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                Select::make('lesson_instance_id')
                    ->relationship('lessonInstance', 'id')
                    ->required(),
                Select::make('attendence_status')
                    ->options(AttendenceStatusEnum::class)
                    ->required(),
            ]);
    }
}
