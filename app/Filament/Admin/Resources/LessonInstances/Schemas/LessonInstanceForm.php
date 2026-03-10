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
                    ->preload()
                    ->relationship('lesson.subject', 'name')
                    ->required()
                    ->translateLabel(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->required()
                    ->translateLabel(),
                Select::make('school_class_room_id')
                    ->relationship('schoolClassRoom', 'id')
                    ->required()
                    ->translateLabel(),
                Textarea::make('lesson_theme')
                    ->columnSpanFull()
                    ->translateLabel(),
                DatePicker::make('date_event')
                    ->required()
                    ->translateLabel(),
            ]);
    }
}
