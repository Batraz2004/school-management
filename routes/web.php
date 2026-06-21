<?php

use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('schedule_on_week', [ScheduleController::class, 'getCurrentWeekSchedule'])->name('schedule_on_week');
    Route::get('switch_schedule', [ScheduleController::class, 'getBySwitchSchedule'])->name('switch_schedule_week');

    Route::prefix('homework')->group(function () {
        Route::get('paginate', [HomeworkController::class, 'paginate'])->name('homework_paginate');
    });
});

require __DIR__ . '/settings.php';
