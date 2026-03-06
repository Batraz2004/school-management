<?php

namespace App\Filament\Admin\Resources\HomeWorkSubmissions\Pages;

use App\Filament\Admin\Resources\HomeWorkSubmissions\HomeWorkSubmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeWorkSubmission extends EditRecord
{
    protected static string $resource = HomeWorkSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
