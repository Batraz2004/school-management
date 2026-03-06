<?php

namespace App\Filament\Admin\Resources\LessonInstances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LessonInstanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lesson_id')
                    ->relationship('lesson', 'id')
                    ->required(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->required(),
                Select::make('school_class_room_id')
                    ->relationship('schoolClassRoom', 'id')
                    ->required(),
                Textarea::make('lesson_theme')
                    ->columnSpanFull(),
                DatePicker::make('date_event')
                    ->required(),
            ]);
    }
}
