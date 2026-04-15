<?php

namespace App\Filament\Admin\Resources\Attendences\Pages;

use App\Filament\Admin\Resources\Attendences\AttendenceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAttendence extends EditRecord
{
    protected static string $resource = AttendenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
