<?php

namespace App\Filament\Admin\Resources\Homework\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HomeworkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('school_class_id')
                    ->relationship('schoolClass', 'name')
                    ->required(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->required(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                DatePicker::make('start_day')
                    ->required(),
                DatePicker::make('last_day')
                    ->required(),
            ]);
    }
}
