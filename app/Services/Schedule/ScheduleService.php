<?php

namespace App\Services\Schedule;

use App\Enums\WeekDaysEnum;
use App\Models\Lesson;
use App\Models\SchoolClass;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class ScheduleService
{
    public function getCurrentWeekSchedule(User $user): array
    {
        /** @var SchoolClass|null $schoolClass */
        $schoolClass = $user->schoolClasses()->first();

        $weekStart = CarbonImmutable::now()->locale(config('app.locale'))->startOfWeek();
        $weekEnd   = $weekStart->endOfWeek();
        $today = strtolower(now()->englishDayOfWeek);

        /** @var Collection<int,Lesson> $lessons*/
        $lessons = $schoolClass
            ?->lessons()
            ->with('subject.homeworks', function ($query) {
                $query->whereDate('last_day', '>=', now());
            })
            ->with('lessonInstances', function ($query) use ($weekStart, $weekEnd) {
                $query->whereBetween('date_event', [$weekStart, $weekEnd]);
            })
            ->orderBy('time_start')
            ->get() ?? collect();

        $grouped = $lessons->groupBy('week_day');

        $schedule = collect(WeekDaysEnum::cases())->mapWithKeys(
            fn(WeekDaysEnum $day) => [$day->value => $grouped->get($day->value, collect())]
        );

        $timeSlots = $lessons
            ->map(fn($lesson) => [
                'start' => Carbon::parse($lesson->time_start)->format('H:i'),
                'end'   => Carbon::parse($lesson->time_end)->format('H:i'),
            ])
            ->unique('start')
            ->sortBy('start')
            ->values();

        return [
            'schedule'    => $schedule,
            'allLessons'  => $lessons,
            'timeSlots'   => $timeSlots,
            'weekStart'   => $weekStart,
            'weekEnd'     => $weekEnd,
            'weekDays'    => WeekDaysEnum::getWeekDays($weekStart),
            'today'       => $today,
            'schoolClass' => $schoolClass,
        ];
    }
}
