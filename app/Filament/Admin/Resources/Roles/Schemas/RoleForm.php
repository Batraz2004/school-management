<?php

namespace App\Filament\Admin\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->disabled(true)
                    ->dehydrated(false)
                    ->label('Name')
                    ->translateLabel(),
                TextInput::make('guard_name')
                    ->required()
                    ->disabled(true)
                    ->dehydrated(false)
                    ->label('Guard name')
                    ->translateLabel(),
            ]);
    }
}
