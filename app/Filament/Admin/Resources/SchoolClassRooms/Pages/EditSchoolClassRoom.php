<?php

namespace App\Filament\Admin\Resources\SchoolClassRooms\Pages;

use App\Filament\Admin\Resources\SchoolClassRooms\SchoolClassRoomResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSchoolClassRoom extends EditRecord
{
    protected static string $resource = SchoolClassRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
