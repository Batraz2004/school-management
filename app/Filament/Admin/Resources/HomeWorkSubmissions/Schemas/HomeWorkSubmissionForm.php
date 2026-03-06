<?php

namespace App\Filament\Admin\Resources\HomeWorkSubmissions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HomeWorkSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                TextInput::make('homework_id')
                    ->required()
                    ->numeric(),
                Select::make('home_work_status')
                    ->options([
                        'fullfiled' => 'Fullfiled',
                        'partially_made' => 'Partially made',
                        'not_done' => 'Not done',
                        'not_done_excused' => 'Not done excused',
                    ])
                    ->required(),
            ]);
    }
}
