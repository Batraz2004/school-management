<?php

namespace App\Filament\Admin\Resources\SchoolClasses\RelationManagers;

use App\Enums\WeekDaysEnum;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject.name')
                    ->searchable()
                    ->translateLabel(),
                TextColumn::make('semester')
                    ->badge()
                    ->translateLabel(),
                TextColumn::make('week_day')
                    ->badge()
                    ->translateLabel(),
                TextColumn::make('time_start')
                    ->time()
                    ->sortable()
                    ->translateLabel(),
                TextColumn::make('time_end')
                    ->time()
                    ->sortable()
                    ->translateLabel(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Добавить предмет')
                    ->schema([
                        Select::make('subject_id')
                            ->relationship('subject', 'name')
                            ->required()->translateLabel(),
                        Select::make('semester')
                            ->options(['autumn' => 'Autumn', 'spring' => 'Spring'])
                            ->required()->translateLabel(),
                        Select::make('week_day')
                            ->options(WeekDaysEnum::labels())
                            ->required()->translateLabel(),
                        TimePicker::make('time_start')
                            ->required()->translateLabel(),
                        TimePicker::make('time_end')
                            ->required()->translateLabel(),
                    ]),
            ]);
    }
}
