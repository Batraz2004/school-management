<?php

namespace App\Filament\Admin\Resources\HomeWorkSubmissions\Schemas;

use App\Enums\HomeWorkStatusEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomeWorkSubmissionForm
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
                    Select::make('homework_id')
                        ->relationship('homework', 'name')
                        ->required()
                        ->translateLabel(),
                    Select::make('home_work_status')
                        ->options(HomeWorkStatusEnum::labels())
                        ->required()
                        ->translateLabel(),
                ])->columnSpan(2),

                Section::make()->schema([
                    DateTimePicker::make('created_at')->translateLabel(),
                    DateTimePicker::make('updated_at')->translateLabel(),
                ])->columnSpan(1),
            ])->columns(3);
    }
}
