@php
    $tasks = $tasks ?? config('stretchtasks.items');
    $taskTotalSeconds = collect($tasks)->sum('countdown_seconds');
@endphp

<div
    id="task-countdown-minute-root"
    data-tasks='@json($tasks)'
    data-total-seconds="{{ $taskTotalSeconds }}"
    class="border-2 rounded-md w-full flex flex-col min-h-0"
>

    <div class="flex items-center justify-between w-full p-5 pb-3 shrink-0">
        <h2 class="text-base font-semibold text-[#1a1d23]">ストレッチ　タスク</h2>
        <button
            type="button"
            id="start-task-countdown-minute"
            class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#eceef1] text-[#3c4149] text-sm font-medium hover:bg-[#e2e4e8] transition-colors disabled:opacity-50 disabled:cursor-not-allowed border-2 border-gray-300"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M8 5v14l11-7z"/>
            </svg>
            タスクを始める
        </button>
    </div>

    <span id="task-countdown-display" class="text-lg font-semibold text-[#3c4149] tabular-nums shrink-0 px-5 pb-3">00:00</span>

    <div class="flex flex-col divide-y divide-[#f0f1f3] w-full flex-1 min-h-0 overflow-y-auto">
        @foreach ($tasks as $task)
            <button
                type="button"
                class="task-item flex items-center gap-3 w-full px-5 py-3 text-left hover:bg-[#f8f9fa] transition-colors"
                data-task-id="{{ $task['id'] }}"
                data-countdown-seconds="{{ $task['countdown_seconds'] }}"
            >
                <span class="task-check flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 border-[#c8ccd2] text-transparent transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </span>
                <span class="task-name flex-1 text-sm text-[#1a1d23] transition-colors">{{ $task['name'] }}</span>
                <span class="task-part text-xs text-[#8b919a] tabular-nums bg-gray-200 px-2 py-1 rounded-md">{{ $task['part'] }}</span>
                <span class="task-effect text-xs text-[#8b919a] tabular-nums bg-orange-200 px-2 py-1 rounded-md">{{ $task['effect'] }}</span>
                <span class="task-duration text-xs text-[#8b919a] tabular-nums bg-blue-200 px-2 py-1 rounded-md">{{ $task['duration'] }}</span>
            </button>
        @endforeach
    </div>
</div>
