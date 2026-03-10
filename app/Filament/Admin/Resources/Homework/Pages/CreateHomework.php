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

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $schoolClassId = $data['school_class_id'];

    //     $schoolClass = SchoolClass::query()->with('users')->find($schoolClassId);

    //     if (filled($schoolClass)) {
    //         foreach ($schoolClass->users as $user) {
    //             if ($user->hasRole(RoleEnum::student->value)) {
    //                 HomeWorkSubmission::query()->updateOrCreate([
    //                     'subject_id' => $data['subject_id'],
    //                     'student_id' => $user->id,
    //                 ], [
    //                     'subject_id' => $data['subject_id'],
    //                     'student_id' => $user->id,
    //                     'attendence_status' => HomeWorkStatusEnum::in_process->value,
    //                 ]);
    //             }
    //         }
    //     }

    //     return $data;
    // }

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
                        'subject_id' => $homeWork->subject_id,
                        'student_id' => $user->id,
                    ], [
                        'subject_id' => $homeWork->subject_id,
                        'student_id' => $user->id,
                        'attendence_status' => HomeWorkStatusEnum::in_process->value,
                    ]);
                }
            }
        }
    }
}
