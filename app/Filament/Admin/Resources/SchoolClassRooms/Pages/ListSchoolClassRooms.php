<?php

namespace App\Filament\Admin\Resources\SchoolClassRooms\Pages;

use App\Filament\Admin\Resources\SchoolClassRooms\SchoolClassRoomResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchoolClassRooms extends ListRecords
{
    protected static string $resource = SchoolClassRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
