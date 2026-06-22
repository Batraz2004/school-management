<?php

namespace App\Services\Subject;

use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Collection;

class SubjectService
{
    public function get(User $user): Collection|null
    {
        /** @var SchoolClass $schoolClass */
        $schoolClass = $user
            ->schoolClasses()
            ->first();

        if (is_null($schoolClass)) {
            return null;
        }

        $subjects = Subject::query()->whereHas('lessons.schoolClass.homeworks', function ($query) use ($schoolClass) {
            return $query->where('id', $schoolClass->id);
        })->get();

        return $subjects;
    }
}
