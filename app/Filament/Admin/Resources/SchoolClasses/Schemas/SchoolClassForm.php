<?php

namespace App\Filament\Admin\Resources\SchoolClasses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SchoolClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('academic_years_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
