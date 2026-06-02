<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Schedule\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct(public ScheduleService $scheduleService) {}

    public function getCurrentWeekSchedule()
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $this->scheduleService->getCurrentWeekSchedule($user);

        return view('pages.schedule.current-week_schedule', $data);
    }

    public function getBySwitchSchedule(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $weekOffset = (int) $request->query('weekOffset', 0);

        $data = $this->scheduleService->getCurrentWeekSchedule($user, $weekOffset);

        return view('pages.schedule.current-week_schedule', $data);
    }
}
