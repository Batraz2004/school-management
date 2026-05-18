<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Schedule\ScheduleService;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct(public ScheduleService $scheduleService) {}

    public function getCurrentWeekSchedule()
    {
        /** @var User $user */
        $user = Auth::user();

        $currentWeekSchedule = $this->scheduleService->getCurrentWeekSchedule($user);

        $viewName = 'pages.schedule.current-week_schedule';

        return $this->getView($viewName, ['schedule' => $currentWeekSchedule]);
    }
}
