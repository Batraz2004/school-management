<?php

namespace App\Filament\Admin\Resources\Users\RelationManagers;

use App\Enums\EvaluationEnum;
use App\Enums\RoleEnum;
use App\Filament\Admin\Resources\Grades\GradeResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use App\Models\Grade;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class GradesRelationManager extends RelationManager
{
    protected static string $relationship = 'grades';

    protected static ?string $relatedResource = GradeResource::class;

    protected static ?string $title = 'Оценки';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject.name')
                    ->searchable()
                    ->translateLabel(),
                TextColumn::make('evaluation')
                    ->badge()
                    ->translateLabel(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->translateLabel(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                Action::make('create')
                    ->schema([
                        Select::make('subject_id')
                            ->relationship('subject', 'name')
                            ->required()
                            ->translateLabel(),
                        Select::make('evaluation')
                            ->options(EvaluationEnum::floatValues())
                            ->required()
                            ->translateLabel(),
                    ])->action(function (Action $action, array $data): void {
                        $data['student_id'] = $this->getOwnerRecord()->id;
                        Grade::create($data);
                        $action->success();
                    })
                    ->label('Добавить оценку'),
            ])
            ->recordActions([
                EditAction::make()
                    ->schema([
                        Select::make('subject_id')
                            ->relationship('subject', 'name')
                            ->required()
                            ->translateLabel(),
                        Select::make('evaluation')
                            ->options(EvaluationEnum::floatValues())
                            ->required()
                            ->translateLabel(),
                    ]),
                DeleteAction::make(),
            ]);
    }
}
