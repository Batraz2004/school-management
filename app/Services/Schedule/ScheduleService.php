<?php

namespace App\Services\Schedule;

use App\Enums\WeekDaysEnum;
use App\Models\SchoolClass;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScheduleService
{
    /** @param User $user */
    public function getCurrentWeekSchedule(User $user)
    {
        /** @var SchoolClass $schoolClass */
        $schoolClass = $user->schoolClasses()->first();

        $currentWeekFirstDay = CarbonImmutable::now()
            ->locale(config('app.locale'))
            ->startOfWeek();
        $currentWeekEndDay = CarbonImmutable::now()
            ->locale(config('app.locale'))
            ->endOfWeek();

        $lessonsTemplateSchedule = $schoolClass
            ->lessons()
            ->with('subject')
            ->with('lessonInstances', function (Builder|HasMany $query) use ($currentWeekFirstDay, $currentWeekEndDay) {
                $query->whereBetween('date_event', [
                    $currentWeekFirstDay,
                    $currentWeekEndDay,
                ]);
            })
            ->orderBy('week_day')
            ->orderBy('time_start')
            ->get();

        $lessonsTemplateScheduleGroupByDays = $lessonsTemplateSchedule->groupBy('week_day');

        $resultByEnumAndGroupDays = collect(WeekDaysEnum::cases())->mapWithKeys(
            fn(WeekDaysEnum $day) => [$day->value => $lessonsTemplateScheduleGroupByDays->get($day->value, collect())]
        );

        return $resultByEnumAndGroupDays;
    }
}
