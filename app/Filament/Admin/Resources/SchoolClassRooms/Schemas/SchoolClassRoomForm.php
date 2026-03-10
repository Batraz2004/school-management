<?php

namespace App\Filament\Admin\Resources\SchoolClassRooms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SchoolClassRoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->required()
                    ->numeric()
                    ->translateLabel(),
            ]);
    }
}
