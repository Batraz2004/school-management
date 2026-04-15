<?php

namespace App\Filament\Admin\Resources\HomeWorkSubmissions\Pages;

use App\Filament\Admin\Resources\HomeWorkSubmissions\HomeWorkSubmissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeWorkSubmissions extends ListRecords
{
    protected static string $resource = HomeWorkSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
