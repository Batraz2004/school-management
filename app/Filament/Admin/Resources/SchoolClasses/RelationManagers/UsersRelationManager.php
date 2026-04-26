<?php

namespace App\Filament\Admin\Resources\SchoolClasses\RelationManagers;

use App\Enums\RoleEnum;
use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $relatedResource = UserResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.name')
                    ->label('Роль')
                    ->formatStateUsing(fn($state) => RoleEnum::tryFrom($state)?->label() ?? $state),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->label('Роль'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(fn($query) => $query->whereHas('roles', fn($q) => $q->whereIn('name', ['student', 'teacher']))),
            ])
            ->recordActions([
                DetachAction::make(),
            ]);
    }
}
