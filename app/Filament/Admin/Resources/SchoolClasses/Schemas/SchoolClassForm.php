<?php

namespace App\Filament\Admin\Resources\SchoolClasses\Schemas;

use App\Enums\SchoolClassNameEnum;
use App\Models\AcademicYear;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SchoolClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->translateLabel(),
                Select::make('academic_year_id')
                    ->preload()
                    ->options(AcademicYear::all()->pluck('period', 'id'))
                    ->required()
                    ->translateLabel(),
            ]);
    }
}
