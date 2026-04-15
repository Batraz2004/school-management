<?php

namespace App\Filament\Admin\Resources\Exams\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->translateLabel(),
                    Select::make('school_class_id')
                        ->relationship('schoolClass', 'name')
                        ->required()
                        ->translateLabel(),
                    Select::make('teacher_id')
                        ->relationship('teacher', 'name')
                        ->required()
                        ->translateLabel(),
                    Select::make('subject_id')
                        ->relationship('subject', 'name')
                        ->required()
                        ->translateLabel(),
                ])->columnSpan(2),
                Section::make()->schema([
                    DateTimePicker::make('event_date')
                        ->required()
                        ->translateLabel(),
                    DateTimePicker::make('created_at')
                        ->translateLabel(),
                    DateTimePicker::make('updated_at')
                        ->translateLabel(),
                ])->columnSpan(1)
            ])->columns(3);
    }
}
