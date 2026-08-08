<div
    id="timer-root"
    data-total-seconds="{{ $totalSeconds }}"
    data-remaining-seconds="{{ $remainingSeconds }}"
    class="border-2 rounded-md w-full flex flex-col min-h-0"
>
    <div class="p-5 pb-3 shrink-0">
        <h2 class="text-base font-semibold text-[#1a1d23]">仕事(勉強)時間</h2>
    </div>

    <div class="flex flex-col items-center gap-3 px-5 pb-5">
        <div
            id="timer-display"
            class="w-50 h-50 shrink-0 rounded-full flex items-center justify-center"
            style="background: conic-gradient(#3b82f6 0deg var(--cut-angle, 0deg), #e5e7eb var(--cut-angle, 0deg) 360deg);"
        >
            <span id="timer-text" class="w-40 h-40 text-lg font-bold bg-white rounded-full flex items-center justify-center tabular-nums">{{ sprintf('%02d:%02d:%02d', intdiv($totalSeconds, 3600), intdiv($totalSeconds % 3600, 60), $totalSeconds % 60) }}</span>
        </div>
        <button type="button" id="start-work" class="w-full bg-blue-500 hover:bg-blue-600 transition-colors cursor-pointer text-white px-3 py-1 rounded-md">作業を始める</button>
        <button type="button" id="stop-work" disabled class="w-full bg-yellow-500 hover:bg-yellow-700 transition-colors cursor-pointer text-white px-3 py-1 rounded-md disabled:opacity-50 disabled:cursor-not-allowed">作業を止める</button>
    </div>
</div>
