<?php

namespace App\Filament\Admin\Resources\Homework\Schemas;

use App\Enums\RoleEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class HomeworkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()->translateLabel(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull()->translateLabel(),
                Select::make('school_class_id')
                    ->relationship('schoolClass', 'name')
                    ->required()->translateLabel(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'name', function (Builder $query) {
                        $query->whereHas('roles', //связь из трейта hasRoles
                        function (Builder $q) {
                            return $q->where('name', RoleEnum::teacher->value);
                        }
                        );
                    })->translateLabel(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required()->translateLabel(),
                DatePicker::make('start_day')
                    ->required()->translateLabel(),
                DatePicker::make('last_day')
                    ->required()->translateLabel(),
            ]);
    }
}
