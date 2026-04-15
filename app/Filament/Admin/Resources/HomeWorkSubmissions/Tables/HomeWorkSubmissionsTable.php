<?php

namespace App\Filament\Admin\Resources\HomeWorkSubmissions\Tables;

use App\Enums\HomeWorkStatusEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomeWorkSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->searchable()
                    ->translateLabel(),
                TextColumn::make('homework.name')
                    ->sortable()
                    ->translateLabel(),
                // SelectColumn::make('home_work_status')->options(HomeWorkStatusEnum::labels())
                //     ->placeholder('Без описания')
                //     ->selectablePlaceholder(false)
                //     ->translateLabel(),
                TextColumn::make('home_work_status')
                    ->formatStateUsing(function ($state) {
                        $valueFromHomeworkEnum = HomeWorkStatusEnum::tryFrom($state)->label();
                        return $valueFromHomeworkEnum;
                    })
                    ->badge()
                    ->color(fn(string $state): string => HomeWorkStatusEnum::tryFrom($state)->color())
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
