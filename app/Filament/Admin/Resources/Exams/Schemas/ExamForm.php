<?php

namespace App\Filament\Admin\Resources\Exams\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('school_class_id')
                    ->relationship('schoolClass', 'name')
                    ->required(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->required(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                DateTimePicker::make('event_date')
                    ->required(),
            ]);
    }
}
