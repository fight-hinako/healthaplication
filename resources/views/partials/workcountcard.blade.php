<div
    id="timer-root"
    data-total-seconds="{{ $totalSeconds }}"
    data-remaining-seconds="{{ $remainingSeconds }}"
    class="border-2 rounded-md w-full flex flex-col min-h-0 bg-white"
>
    <div class="p-5 pb-3 shrink-0">
        <h2 class="text-base font-semibold text-[#1a1d23]">仕事(勉強)時間</h2>
    </div>

    <div class="flex flex-col items-center gap-3 px-5 pb-5">
        <div
            id="timer-display"
            class="w-50 h-50 shrink-0 rounded-full flex items-center justify-center"
            style="background: conic-gradient(#cffce1 0deg var(--cut-angle, 0deg), #e5e7eb var(--cut-angle, 0deg) 360deg);"
        >
            <span id="timer-text" class="w-40 h-40 text-2xl font-bold bg-white rounded-full flex items-center justify-center tabular-nums">{{ sprintf('%02d:%02d:%02d', intdiv($totalSeconds, 3600), intdiv($totalSeconds % 3600, 60), $totalSeconds % 60) }}</span>
        </div>
        <button type="button" id="start-work" class="w-full bg-green-500 opacity-75 hover:bg-green-600 opacity-75 transition-colors cursor-pointer text-white px-3 py-1 rounded-md">作業を始める</button>
        <button type="button" id="stop-work" disabled class="w-full bg-[#eceef1] hover:bg-[#d5d8dc] transition-colors cursor-pointer px-3 py-1 rounded-md disabled:cursor-not-allowed">作業を止める</button>
    </div>
</div>
