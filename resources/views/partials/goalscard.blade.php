@php
    $dailyTasks = $dailyTasks ?? auth()->user()->daily_tasks ?? 0;
    $completedTasks = $completedTasks ?? auth()->user()->completed_tasks ?? 0;
@endphp
<div
    id="goals-card-root"
    data-daily-tasks="{{ $dailyTasks }}"
    data-completed-tasks="{{ $completedTasks }}"
    class="border-gray-300 border-2 rounded-md w-full flex flex-col min-h-0 bg-white"
>
    <div class="p-5 pb-3 shrink-0">
        <h2 class="text-base font-semibold text-[#1a1d23]">今日の成果</h2>
    </div>
    <div class="flex flex-col items-start gap-3 px-5 pb-5">
        <p class="text-2xl font-bold tabular-nums">
            今日のストレッチ回数:
            <span id="goals-completed-display">{{ $completedTasks }}/{{ $dailyTasks }}</span>
        </p>

        <p class="text-2xl font-bold tabular-nums">
            総作業時間:
            <span id="goals-total-time-display">0分</span>
        </p>
    </div>
</div>
