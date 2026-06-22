<x-layouts::app :title="__('Homework')">
    <div style="max-width: 1152px; margin: 0 auto; padding: 0 1rem;">
        <div class="flex items-start justify-between mb-6 flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100">Домашние задания</h1>
                <p class="text-sm text-zinc-500 mt-1">
                    Всего: {{ $homeworksPaginate?->total() ?? 0 }}
                </p>
            </div>
        </div>
        @if(filled($subjects))
        <div class="flex gap-2 mb-6 flex-wrap">
            <a href="{{ route('homework_paginate') }}"
               class="px-3 py-1 rounded-lg border border-zinc-200 dark:border-zinc-700 text-sm font-medium {{ !request('subject_id') ? 'bg-zinc-100 dark:bg-zinc-700' : 'hover:bg-zinc-50 dark:hover:bg-zinc-800' }}">
                Все
            </a>
            @foreach($subjects as $subject)
                <a href="{{ route('homework_paginate', ['subject_id' => $subject->id]) }}"
                   class="px-3 py-1 rounded-lg border border-zinc-200 dark:border-zinc-700 text-sm font-medium {{ (int) request('subject_id') === $subject->id ? 'bg-zinc-100 dark:bg-zinc-700' : 'hover:bg-zinc-50 dark:hover:bg-zinc-800' }}">
                    {{ $subject->name }}
                </a>
            @endforeach
        </div>
        @endif
        @if(filled($homeworksPaginate))

        @if(blank($homeworksPaginate))
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 text-center py-16">
                <div class="text-4xl mb-3">📎</div>
                <div class="font-semibold text-zinc-700 dark:text-zinc-300">Домашних заданий нет</div>
            </div>
        @else
            <div class="flex flex-col gap-3">
                @foreach($homeworksPaginate as $homework)
                    <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-4">
                        <div class="flex items-start justify-between gap-4 flex-wrap">
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wider text-sky-600 dark:text-sky-400">
                                    {{ $homework->subject?->name ?? '—' }}
                                </div>
                                <div class="text-base font-bold text-zinc-900 dark:text-zinc-100 mt-0.5">
                                    {{ $homework->name }}
                                </div>
                            </div>
                            <div class="text-xs text-zinc-400 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($homework->start_day)->format('d.m.Y') }}
                                –
                                {{ \Carbon\Carbon::parse($homework->last_day)->format('d.m.Y') }}
                            </div>
                        </div>

                        @if($homework->description)
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-2">
                                {{ $homework->description }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $homeworksPaginate->links() }}
            </div>
        @endif
        @endif

    </div>
</x-layouts::app>