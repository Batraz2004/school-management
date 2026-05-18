<?php

namespace App\Http\Controllers;

use App\Enums\WeekDaysEnum;
use App\Models\SchoolClass;
use App\Models\User;
use App\Services\Schedule\ScheduleService;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct(public ScheduleService $scheduleService) {}

    public function getCurrentWeekSchedule()
    {
        /** @var User $user */
        $user = Auth::user();

        $currentWeekSchedule = $this->scheduleService->getCurrentWeekSchedule($user);

        return view('pages.schedule.current-week_schedule', [$currentWeekSchedule]);
    }
}
