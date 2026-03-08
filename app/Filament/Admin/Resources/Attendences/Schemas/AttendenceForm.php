<?php

namespace App\Filament\Admin\Resources\Attendences\Schemas;

use App\Enums\AttendenceStatusEnum;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AttendenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Select::make('student_id')
                        ->relationship('student', 'name')
                        ->required()
                        ->translateLabel(),
                    Select::make('lesson_instance_id')
                        ->relationship('lessonInstance', 'date_event')
                        ->required()
                        ->translateLabel(),
                    Select::make('attendence_status')
                        ->options(AttendenceStatusEnum::class)
                        ->required()
                        ->translateLabel(),
                ])
            ]);
    }
}
