<?php

namespace App\Services\Homework;

use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeworkService
{
    public function paginate(User $user, int $perPage, ?int $subjectId): LengthAwarePaginator|null
    {
        /** @var SchoolClass $schoolClass */
        $schoolClass = $user
            ->schoolClasses()
            ->first();

        $homeworks = $schoolClass
            ?->homeworks();

        if (is_null($homeworks)) {
            return null;
        }

        $query = $homeworks
            ->getQuery();

        $query->with('subject');

        if (filled($subjectId)) {
            $query->whereHas('subject', function ($query) use ($subjectId) {
                return $query->where('id', $subjectId);
            });
        }

        $homeworksPaginate = $query
            ->paginate($perPage);

        return $homeworksPaginate;
    }
}
