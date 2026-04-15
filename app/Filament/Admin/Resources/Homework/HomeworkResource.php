<?php

namespace App\Filament\Admin\Resources\Homework;

use App\Filament\Admin\Resources\Homework\Pages\CreateHomework;
use App\Filament\Admin\Resources\Homework\Pages\EditHomework;
use App\Filament\Admin\Resources\Homework\Pages\ListHomework;
use App\Filament\Admin\Resources\Homework\RelationManagers\SubmissonsRelationManager;
use App\Filament\Admin\Resources\Homework\Schemas\HomeworkForm;
use App\Filament\Admin\Resources\Homework\Tables\HomeworkTable;
use App\Models\Homework;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeworkResource extends Resource
{
    protected static ?string $model = Homework::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Домашние задания';
    protected static ?string $modelLabel = 'Домашнее задание';


    public static function form(Schema $schema): Schema
    {
        return HomeworkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeworkTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SubmissonsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomework::route('/'),
            'create' => CreateHomework::route('/create'),
            'edit' => EditHomework::route('/{record}/edit'),
        ];
    }
}
