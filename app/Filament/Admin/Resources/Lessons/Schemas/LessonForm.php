<?php

namespace App\Filament\Admin\Resources\Lessons\Schemas;

use App\Enums\WeekDaysEnum;
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
                    ->required()->translateLabel(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required()->translateLabel(),
                Select::make('semester')
                    ->options(['autumn' => 'Autumn', 'spring' => 'Spring'])
                    ->required()->translateLabel(),
                Select::make('week_day')
                    ->options(WeekDaysEnum::labels())
                    ->required()->translateLabel(),
                TimePicker::make('time_start')
                    ->required()->translateLabel(),
                TimePicker::make('time_end')
                    ->required()->translateLabel(),
            ]);
    }
}
