<x-layouts::app :title="__('Расписание')">
<div style="max-width: 1152px; margin: 0 auto; padding: 0 1rem;">
    @php
        $palette = ['#0ea5e9','#8b5cf6','#10b981','#f59e0b','#ef4444','#6366f1','#ec4899','#14b8a6','#f97316','#84cc16'];
        $subjectColor = fn(?string $name): string =>
            $name ? $palette[abs(crc32($name)) % count($palette)] : '#94a3b8';
    @endphp

    {{-- Заголовок --}}
    <div class="flex items-start justify-between mb-6 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100">Расписание недели</h1>
            <p class="text-sm text-zinc-500 mt-1">
                {{ $weekStart->format('j') }} — {{ $weekEnd->translatedFormat('j M Y') }}
                @if($schoolClass) · {{ $schoolClass->name }} @endif
            </p>
        </div>
        <div class="flex items-center gap-2 mt-1">
            <button class="p-2 rounded-lg border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-800 text-zinc-600 dark:text-zinc-300">
                ←
            </button>
            <button class="px-4 py-2 rounded-lg border border-zinc-200 dark:border-zinc-700 text-sm font-medium hover:bg-zinc-50 dark:hover:bg-zinc-800 text-zinc-700 dark:text-zinc-300">
                Эта неделя
            </button>
            <button class="p-2 rounded-lg border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-800 text-zinc-600 dark:text-zinc-300">
                →
            </button>
        </div>
    </div>

    @if($allLessons->isEmpty())
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 text-center py-16">
            <div class="text-4xl mb-3">📅</div>
            <div class="font-semibold text-zinc-700 dark:text-zinc-300">На этой неделе уроков нет</div>
            <div class="text-sm text-zinc-400 mt-1">Возможно, вы ещё не записаны в класс</div>
        </div>
    @else
        {{-- Сетка расписания --}}
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-x-auto">
            <table class="border-collapse" style="width: auto; min-width: 100%">
                {{-- Шапка дней --}}
                <thead>
                    <tr class="border-b border-zinc-200 dark:border-zinc-700">
                        <th class="w-20 p-3 text-left text-[11px] font-semibold uppercase tracking-wider text-zinc-400 border-r border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800/50">
                            ВРЕМЯ
                        </th>
                        @foreach($weekDays as $dayKey => $dayInfo)
                            @php $isToday = $dayKey === $today; @endphp
                            <th class="w-40 p-3 text-left border-r last:border-r-0 border-zinc-200 dark:border-zinc-700 {{ $isToday ? 'bg-sky-50 dark:bg-sky-900/20' : 'bg-zinc-50 dark:bg-zinc-800/50' }}">
                                <div class="text-[11px] font-semibold uppercase tracking-wider {{ $isToday ? 'text-sky-600 dark:text-sky-400' : 'text-zinc-400' }}">
                                    {{ $dayInfo['short'] }}
                                </div>
                                <div class="text-base font-bold mt-0.5 {{ $isToday ? 'text-sky-700 dark:text-sky-300' : 'text-zinc-800 dark:text-zinc-100' }}">
                                    {{ $dayInfo['date'] }}
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>

                {{-- Строки времени --}}
                <tbody>
                    @foreach($timeSlots as $slot)
                        <tr class="border-b last:border-b-0 border-zinc-100 dark:border-zinc-700/50" style="min-height: 96px;">
                            {{-- Время --}}
                            <td class="w-20 p-3 border-r border-zinc-100 dark:border-zinc-700/50 align-top bg-zinc-50/50 dark:bg-zinc-800/30">
                                <div class="text-sm font-bold text-zinc-700 dark:text-zinc-300 tabular-nums">{{ $slot['start'] }}</div>
                                <div class="text-[11px] text-zinc-400 tabular-nums">{{ $slot['end'] }}</div>
                            </td>

                            {{-- Ячейки по дням --}}
                            @foreach($weekDays as $dayKey => $dayInfo)
                                @php
                                    $isToday = $dayKey === $today;
                                    $lesson  = ($schedule[$dayKey] ?? collect())
                                        ->first(fn($l) => \Carbon\Carbon::parse($l->time_start)->format('H:i') === $slot['start']);
                                    $color   = $lesson ? $subjectColor($lesson->subject?->name) : null;
                                    $instance = $lesson?->lessonInstances->first(); //first потому что на одно расписание в неделю у олдного предмета одно проведение
                                @endphp
                                <td class="p-2 border-r last:border-r-0 border-zinc-100 dark:border-zinc-700/50 align-top {{ $isToday ? 'bg-sky-50/30 dark:bg-sky-900/10' : '' }}">
                                    @if($lesson)
                                        <div class="rounded-lg p-2.5 h-full flex flex-col gap-1"
                                            style="background: {{ $color }}12; border: 1px solid {{ $color }}25; border-left: 3px solid {{ $color }};">
                                            @if(filled($lesson->subject["homeworks"]))
                                            {{'📎'}}
                                            @endif
                                            @if($instance?->control_work)
                                            <span>⚠</span>
                                            @endif
                                            {{-- Предмет --}}
                                            <div class="text-xs font-bold leading-tight" style="color: {{ $color }}">
                                                {{ $lesson->subject?->name ?? '—' }}
                                            </div>

                                            {{-- Тема урока (из instance) --}}
                                            @if($instance?->lesson_theme)
                                                <div class="text-xs text-zinc-600 dark:text-zinc-400 leading-tight">
                                                    {{ $instance->lesson_theme }}
                                                </div>
                                            @endif

                                            {{-- Кабинет и учитель --}}
                                            <div class="text-[11px] text-zinc-400 mt-auto">
                                                @if($instance?->schoolClassRoom)
                                                    Каб. {{ $instance->schoolClassRoom->number }}
                                                @endif
                                                @if($instance?->teacher)
                                                    · {{ \Illuminate\Support\Str::limit($instance->teacher->name, 12, '…') }}
                                                @endif
                                                @if(!$instance)
                                                    {{ \Carbon\Carbon::parse($lesson->time_start)->format('H:i') }}–{{ \Carbon\Carbon::parse($lesson->time_end)->format('H:i') }}
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Легенда --}}
        <div class="flex items-center justify-between mt-4 text-xs text-zinc-500 flex-wrap gap-2">
            <div class="flex items-center gap-4">
                <span>📎 Есть домашнее задание</span>
                <span>⚠ Контрольная работа</span>
            </div>
            <span class="tabular-nums">
                Звонки: {{ $timeSlots->map(fn($s) => $s['start'])->implode(' · ') }}
            </span>
        </div>
    @endif
</div>
</x-layouts::app>