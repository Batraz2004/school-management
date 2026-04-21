<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use App\Enums\ExportFormatsEnum;
use App\Enums\RoleEnum;
use App\Services\StudentExport\StudentExportService;
use App\Services\StudentImport\StudentImportService;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->translateLabel(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->translateLabel(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->formatStateUsing(function ($state) {
                        $roleLabel = RoleEnum::tryFrom($state)->label() ?? '';
                        return $roleLabel;
                    })
                    ->searchable()
                    ->translateLabel(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->translateLabel(),
                TextColumn::make('two_factor_confirmed_at')
                    ->dateTime()
                    ->sortable()
                    ->translateLabel(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([
                Action::make('students import')
                    ->label('Импорт учеников')
                    ->modalSubmitActionLabel('Импорт')
                    ->closeModalByClickingAway(false)
                    ->schema([
                        FileUpload::make('file')
                            ->preserveFilenames()
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel'
                            ])
                            ->required(true)
                            ->storeFiles(false) // иначе вместо объекта UploadedFile вернется только название файла
                            ->label('перенесите сюда файл')
                    ])
                    ->action(function (Action $action, array $data) {
                        try {
                            /** @var UploadedFile $file */
                            $file = $data['file'];

                            $importSerivce = app(StudentImportService::class);
                            $importSerivce->import($file);

                            $failedRecords = $importSerivce->getFailedRecordsByImport();

                            if (filled($failedRecords)) {
                                Notification::make()
                                    ->warning()
                                    ->title('не удалось импортировать некоторые записи')
                                    ->body(function () use ($failedRecords) {
                                        return implode(';', $failedRecords);
                                    })
                                    ->persistent()
                                    ->send();
                            }

                            $action->success();
                        } catch (Throwable $th) {
                            $action->failure();

                            Log::debug('произошла ошибка', [
                                'контекст' => "при импорте",
                                'код ошибки' => $th->getCode(),
                                'текст ошибки' => $th->getMessage(),
                                'номер строки' => $th->getLine(),
                            ]);
                        }
                    })
                    ->successNotification(Notification::make()
                        ->success()
                        ->persistent()
                        ->title('Импорт завершен'))
                    ->failureNotification(Notification::make()
                        ->danger()
                        ->persistent()
                        ->title('Импорт не был завершен или был завершен частично')),
                Action::make('students export')
                    ->label('Экспорт учеников')
                    ->schema([
                        Select::make('format')
                            ->options(ExportFormatsEnum::labels()),
                    ])
                    ->action(function (Action $action, array $data) {
                        try {
                            $formatValue = ExportFormatsEnum::{$data['format']}->value;
                            $studentExporter = app(StudentExportService::class);
                            $writer = $studentExporter->export($formatValue);

                            $date = Carbon::now();
                            $fileName = "students_$date.$formatValue";

                            $responce = new StreamedResponse(
                                function () use ($writer) {
                                    $writer->save('php://output');
                                },
                                200,
                                [
                                    'Content-Type' => 'application/vnd.ms-excel',
                                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                                    'Cache-Control' => 'max-age=0',
                                ]
                            );

                            $action->success();

                            return $responce;
                        } catch (Throwable $th) {
                            $action->failure();

                            Log::debug('произошла ошибка', [
                                'контекст' => "при экспорте",
                                'код ошибки' => $th->getCode(),
                                'текст ошибки' => $th->getMessage(),
                                'номер строки' => $th->getLine(),
                            ]);
                        }
                    })
                    ->successNotification(Notification::make()
                        ->success()
                        ->title('Экспорт завершен'))
                    ->failureNotification(Notification::make()
                        ->danger()
                        ->persistent()
                        ->title('Не удалось экспортировать файл')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
