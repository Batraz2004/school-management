<?php

namespace App\Filament\Admin\Resources\Homework\Pages;

use App\Enums\HomeWorkStatusEnum;
use App\Enums\RoleEnum;
use App\Filament\Admin\Resources\Homework\HomeworkResource;
use App\Models\Homework;
use App\Models\HomeWorkSubmission;
use App\Models\SchoolClass;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateHomework extends CreateRecord
{
    protected static string $resource = HomeworkResource::class;

    protected function afterCreate(): void
    {
        /** @var Homework $homeWork  */
        $homeWork = $this->record;

        $schoolClass = $homeWork?->schoolClass;
        $schoolClassUsers = $schoolClass?->users;

        if (filled($schoolClassUsers)) {
            /** @var User $user */
            foreach ($schoolClassUsers as $user) {
                if ($user->hasRole(RoleEnum::student->value)) {
                    HomeWorkSubmission::query()->updateOrCreate([
                        'homework_id' => $homeWork->id,
                        'student_id'  => $user->id,
                    ], [
                        'home_work_status' => HomeWorkStatusEnum::in_process->value,
                    ]);
                }
            }
        }
    }
}
