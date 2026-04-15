<?php

namespace App\Filament\Admin\Resources\Attendences\Pages;

use App\Filament\Admin\Resources\Attendences\AttendenceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAttendence extends CreateRecord
{
    protected static string $resource = AttendenceResource::class;
}
