<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('ФИО')
                    ->required()
                    ->translateLabel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->translateLabel(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->translateLabel(),
                TextInput::make('two_factor_secret')
                    ->password()
                    ->translateLabel(),
                TextInput::make('two_factor_recovery_codes')
                    ->password()
                    ->translateLabel(),
                DateTimePicker::make('two_factor_confirmed_at')
                ->translateLabel(),
            ]);
    }
}
