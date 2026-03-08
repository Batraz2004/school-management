<?php

namespace App\Filament\Admin\Resources\AcademicYears\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('укажите временный диапазон')->schema([
                    DatePicker::make('date_start')
                        ->required()
                        ->translateLabel(),

                    DatePicker::make('date_end')
                        ->required()
                        ->translateLabel(),
                ])
            ]);
    }
}
