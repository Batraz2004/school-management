<?php

namespace App\Filament\Admin\Resources\LessonInstances\Pages;

use App\Filament\Admin\Resources\LessonInstances\LessonInstanceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLessonInstance extends EditRecord
{
    protected static string $resource = LessonInstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
