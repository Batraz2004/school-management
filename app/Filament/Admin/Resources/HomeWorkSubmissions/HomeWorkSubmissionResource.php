<?php

namespace App\Filament\Admin\Resources\HomeWorkSubmissions;

use App\Filament\Admin\Resources\HomeWorkSubmissions\Pages\CreateHomeWorkSubmission;
use App\Filament\Admin\Resources\HomeWorkSubmissions\Pages\EditHomeWorkSubmission;
use App\Filament\Admin\Resources\HomeWorkSubmissions\Pages\ListHomeWorkSubmissions;
use App\Filament\Admin\Resources\HomeWorkSubmissions\Schemas\HomeWorkSubmissionForm;
use App\Filament\Admin\Resources\HomeWorkSubmissions\Tables\HomeWorkSubmissionsTable;
use App\Models\HomeWorkSubmission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeWorkSubmissionResource extends Resource
{
    protected static ?string $model = HomeWorkSubmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HomeWorkSubmissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeWorkSubmissionsTable::configure($table);
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
            'index' => ListHomeWorkSubmissions::route('/'),
            'create' => CreateHomeWorkSubmission::route('/create'),
            'edit' => EditHomeWorkSubmission::route('/{record}/edit'),
        ];
    }
}
