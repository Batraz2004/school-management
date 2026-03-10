<?php

namespace App\Filament\Admin\Resources\Lessons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('schoolClass.name')
                    ->searchable()
                    ->translateLabel(),
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
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
