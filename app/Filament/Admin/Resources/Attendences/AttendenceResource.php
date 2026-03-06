<?php

namespace App\Filament\Admin\Resources\Attendences;

use App\Filament\Admin\Resources\Attendences\Pages\CreateAttendence;
use App\Filament\Admin\Resources\Attendences\Pages\EditAttendence;
use App\Filament\Admin\Resources\Attendences\Pages\ListAttendences;
use App\Filament\Admin\Resources\Attendences\Schemas\AttendenceForm;
use App\Filament\Admin\Resources\Attendences\Tables\AttendencesTable;
use App\Models\Attendence;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AttendenceResource extends Resource
{
    protected static ?string $model = Attendence::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AttendenceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AttendencesTable::configure($table);
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
            'index' => ListAttendences::route('/'),
            'create' => CreateAttendence::route('/create'),
            'edit' => EditAttendence::route('/{record}/edit'),
        ];
    }
}
