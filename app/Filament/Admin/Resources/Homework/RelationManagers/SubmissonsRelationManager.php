<?php

namespace App\Filament\Admin\Resources\Homework\RelationManagers;

use App\Enums\HomeWorkStatusEnum;
use App\Filament\Admin\Resources\HomeWorkSubmissions\HomeWorkSubmissionResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubmissonsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissons';

    protected static ?string $relatedResource = HomeWorkSubmissionResource::class;

    public function table(Table $table): Table
    {
        return $table //я переопределяю table потому что хочу использовать здесь select column вместо text как в основной submissions таблице
            ->columns([
                TextColumn::make('student.name')
                    ->searchable()
                    ->translateLabel(),
                SelectColumn::make('home_work_status')->options(HomeWorkStatusEnum::labels())
                    ->placeholder('Без описания')
                    ->selectablePlaceholder(false)
                    ->translateLabel()
                    ->width(250),
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
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                DeleteAction::make(),
            ]);
    }
}
