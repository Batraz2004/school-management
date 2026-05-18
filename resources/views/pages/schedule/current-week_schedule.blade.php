<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Расписание</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sky-50 min-h-screen">

    <x-menu-navigation/>

    {{-- Заголовок страницы --}}
    <div class="max-w-7xl mx-auto px-6 pt-8 pb-4 flex flex-col items-center text-center">
        <h1 class="text-2xl font-bold text-sky-900">Расписание на текущую неделю</h1>
        <p class="text-sky-600 text-sm mt-1">{{ now()->startOfWeek()->format('d.m.Y') }} — {{ now()->endOfWeek()->format('d.m.Y') }}</p>
    </div>

    {{-- Расписание: горизонтально по дням --}}
    <div class="max-w-7xl mx-auto px-6 pb-10 overflow-x-auto">
        <div class="flex gap-4 justify-center min-w-max mx-auto">

            @foreach($schedule as $dayKey => $lessons)
                @php $dayEnum = \App\Enums\WeekDaysEnum::from($dayKey); @endphp

                <div class="w-48 flex flex-col rounded-xl overflow-hidden shadow-sm bg-white border border-sky-100">

                    {{-- Заголовок дня --}}
                    <div class="bg-sky-600 px-4 py-3 text-center">
                            {{ $dayEnum->label() }}
                    </div>

                    {{-- Уроки --}}
                    <div class="flex flex-col gap-2 p-3 flex-1">
                        @if($lessons->isEmpty())
                            <div class="flex-1 flex items-center justify-center py-6">
                                <span class="text-sky-300 text-xs text-center italic">Нет занятий</span>
                            </div>
                        @else
                            @foreach($lessons as $lesson)
                                <div class="rounded-lg p-3 text-left
                                    {{ $lesson->lessonInstances->isNotEmpty() ? 'bg-sky-50 border border-sky-200' : 'bg-gray-50 border border-gray-200' }}">

                                    <div class="text-xs font-mono text-sky-500 mb-1">
                                        {{ \Carbon\Carbon::parse($lesson->time_start)->format('H:i') }}
                                        –
                                        {{ \Carbon\Carbon::parse($lesson->time_end)->format('H:i') }}
                                    </div>

                                    <div class="text-sm font-semibold text-sky-900 leading-tight">
                                        {{ $lesson->subject?->name ?? '—' }}
                                    </div>

                                    @if($lesson->lessonInstances->isNotEmpty())
                                        <span class="inline-block mt-1.5 text-xs bg-green-100 text-green-600 px-1.5 py-0.5 rounded-full">
                                            Проводится
                                        </span>
                                    @else
                                        <span class="inline-block mt-1.5 text-xs bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-full">
                                            Отменён
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>

</body>
</html>