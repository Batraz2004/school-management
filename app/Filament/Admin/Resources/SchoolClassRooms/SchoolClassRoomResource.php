<?php

namespace App\Filament\Admin\Resources\SchoolClassRooms;

use App\Filament\Admin\Resources\SchoolClassRooms\Pages\CreateSchoolClassRoom;
use App\Filament\Admin\Resources\SchoolClassRooms\Pages\EditSchoolClassRoom;
use App\Filament\Admin\Resources\SchoolClassRooms\Pages\ListSchoolClassRooms;
use App\Filament\Admin\Resources\SchoolClassRooms\Schemas\SchoolClassRoomForm;
use App\Filament\Admin\Resources\SchoolClassRooms\Tables\SchoolClassRoomsTable;
use App\Models\SchoolClassRoom;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SchoolClassRoomResource extends Resource
{
    protected static ?string $model = SchoolClassRoom::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $pluralModelLabel = "Номера кабинетов";
    protected static ?string $modelLabel = "Номер кабинета";

    public static function form(Schema $schema): Schema
    {
        return SchoolClassRoomForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolClassRoomsTable::configure($table);
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
            'index' => ListSchoolClassRooms::route('/'),
            'create' => CreateSchoolClassRoom::route('/create'),
            'edit' => EditSchoolClassRoom::route('/{record}/edit'),
        ];
    }
}
