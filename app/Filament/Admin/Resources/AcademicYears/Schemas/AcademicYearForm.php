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
                Section::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->translateLabel()
                        ->disabled()
                        ->dehydrated(true)
                        ->translateLabel(),
                ]),

                Section::make('укажите временный диапазон')->schema([
                    DatePicker::make('date_start')
                        ->reactive()
                        ->afterStateUpdated(function ($set, $state) {
                            $year = new Carbon($state)->year;
                            $set('name', $year);
                            $set('date_end', null);
                        })
                        ->required()
                        ->translateLabel(),

                    DatePicker::make('date_end')
                        ->reactive()
                        ->displayFormat('Y')
                        ->hidden(function ($get) {
                            if (empty($get('date_start'))) {
                                return true;
                            }
                        })
                        ->afterStateUpdated(function ($set, $get, $state) {
                            $startYear = (string)new Carbon($get('date_start'))->year;
                            $endYear = (string)new Carbon($state)->year;

                            $yearScope = $startYear . "-" . $endYear;

                            $set('name', $yearScope);
                        })
                        ->required()
                        ->translateLabel(),
                ])

            ]);
    }
}
