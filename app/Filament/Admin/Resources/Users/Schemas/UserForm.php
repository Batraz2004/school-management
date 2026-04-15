<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make()->columnSpan(2)->schema([
                    Section::make()
                        ->columns(2)
                        ->columnSpan(2)
                        ->schema([
                            TextInput::make('name')
                                ->label('ФИО')
                                ->required()
                                ->translateLabel(),
                            TextInput::make('email')
                                ->label('Email address')
                                ->email()
                                ->required()
                                ->translateLabel(),
                            TextInput::make('password')
                                ->password()
                                ->required()
                                ->translateLabel(),

                            Grid::make()
                                ->columnSpanFull()
                                ->schema([
                                    TextInput::make('two_factor_secret')
                                        ->password()
                                        ->translateLabel(),
                                    TextInput::make('two_factor_recovery_codes')
                                        ->password()
                                        ->translateLabel(),
                                ])
                        ]),
                    Section::make()
                        ->columns(2)
                        ->columnSpan(2)
                        ->schema([
                            Select::make('roles')
                                ->label('Role')
                                ->translateLabel()
                                ->relationship('roles', 'name'),
                            Select::make('schoolClasses')
                                ->label('School class')
                                ->translateLabel()
                                ->relationship('schoolClasses', 'name'),
                        ]),
                ]),
        
                Section::make()->columnSpan(1)->schema([
                    DateTimePicker::make('created_at')
                        ->translateLabel(),
                    DateTimePicker::make('updated_at')
                        ->translateLabel(),
                    DateTimePicker::make('email_verified_at'),
                    DateTimePicker::make('two_factor_confirmed_at')
                        ->translateLabel(),
                ]),
            ]);
    }
}
