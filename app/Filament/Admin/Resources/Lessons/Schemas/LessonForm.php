<?php

namespace App\Filament\Admin\Resources\Lessons\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_class_id')
                    ->relationship('schoolClass', 'name')
                    ->required(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                Select::make('semester')
                    ->options(['autumn' => 'Autumn', 'spring' => 'Spring'])
                    ->required(),
                Select::make('week_day')
                    ->options([
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
        ])
                    ->required(),
                TimePicker::make('time_start')
                    ->required(),
                TimePicker::make('time_end')
                    ->required(),
            ]);
    }
}
