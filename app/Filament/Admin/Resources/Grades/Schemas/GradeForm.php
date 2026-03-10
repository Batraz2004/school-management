<?php

namespace App\Filament\Admin\Resources\Grades\Schemas;

use App\Enums\EvaluationEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Select::make('subject_id')
                        ->relationship('subject', 'name')
                        ->required()
                        ->translateLabel(),
                    Select::make('student_id')
                        ->relationship('student', 'name')
                        ->required()
                        ->translateLabel(),
                    Select::make('evaluation')
                        ->options(EvaluationEnum::floatValues())
                        ->required()
                        ->translateLabel(),
                ])->columnSpan(2),
                Section::make()->schema([
                    DateTimePicker::make('created_at')->translateLabel(),
                    DateTimePicker::make('updated_at')->translateLabel(),
                    DateTimePicker::make('deleted_at')->translateLabel(),
                ])->columnSpan(1),

            ])->columns(3);
    }
}
