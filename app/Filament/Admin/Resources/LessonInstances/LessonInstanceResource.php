<?php

namespace App\Filament\Admin\Resources\LessonInstances;

use App\Filament\Admin\Resources\LessonInstances\Pages\CreateLessonInstance;
use App\Filament\Admin\Resources\LessonInstances\Pages\EditLessonInstance;
use App\Filament\Admin\Resources\LessonInstances\Pages\ListLessonInstances;
use App\Filament\Admin\Resources\LessonInstances\Schemas\LessonInstanceForm;
use App\Filament\Admin\Resources\LessonInstances\Tables\LessonInstancesTable;
use App\Models\LessonInstance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LessonInstanceResource extends Resource
{
    protected static ?string $model = LessonInstance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LessonInstanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonInstancesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLessonInstances::route('/'),
            'create' => CreateLessonInstance::route('/create'),
            'edit' => EditLessonInstance::route('/{record}/edit'),
        ];
    }
}
