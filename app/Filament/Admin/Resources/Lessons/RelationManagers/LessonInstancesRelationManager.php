<?php

namespace App\Filament\Admin\Resources\Lessons\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LessonInstancesRelationManager extends RelationManager
{
    protected static string $relationship = 'lessonInstances';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->required()
                    ->translateLabel(),
                Select::make('school_class_room_id')
                    ->relationship('schoolClassRoom', 'number')
                    ->required()
                    ->translateLabel(),
                Textarea::make('lesson_theme')
                    ->columnSpanFull()
                    ->translateLabel(),
                Toggle::make('control_work')
                    ->required()
                    ->translateLabel(),
                DatePicker::make('date_event')
                    ->required()
                    ->translateLabel(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('time_start')
            ->columns([
                TextColumn::make('teacher.name')
                    ->searchable()
                    ->translateLabel(),
                TextColumn::make('schoolClassRoom.number')
                    ->searchable()
                    ->translateLabel(),
                IconColumn::make('control_work')
                    ->boolean()
                    ->translateLabel(),
                TextColumn::make('date_event')
                    ->date()
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
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
