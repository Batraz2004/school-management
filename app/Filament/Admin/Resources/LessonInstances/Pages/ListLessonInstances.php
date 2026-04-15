<?php

namespace App\Filament\Admin\Resources\LessonInstances\Pages;

use App\Filament\Admin\Resources\LessonInstances\LessonInstanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLessonInstances extends ListRecords
{
    protected static string $resource = LessonInstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
