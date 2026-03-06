<?php

namespace App\Filament\Admin\Resources\Grades\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                Select::make('evaluation')
                    ->options([2 => '2', '2.5' => '2.5', 3 => '3', '3.5' => '3.5', 4 => '4', '4.5' => '4.5', 5 => '5'])
                    ->required(),
            ]);
    }
}
