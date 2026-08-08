function initWorkCount() {
    const root = document.getElementById('timer-root');
    if (!root) {
        return;
    }

    const totalSeconds = Number(root.dataset.totalSeconds);
    let remainingSeconds = Number(root.dataset.remainingSeconds);
    let intervalId = null;

    const timerDisplay = root.querySelector('#timer-display');
    const timerText = root.querySelector('#timer-text');
    const startBtn = root.querySelector('#start-work');
    const stopBtn = root.querySelector('#stop-work');

    if (!timerDisplay || !timerText || !startBtn || !stopBtn) {
        return;
    }

    function formatTime(seconds) {
        const h = String(Math.floor(seconds / 3600)).padStart(2, '0');
        const m = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
        const s = String(seconds % 60).padStart(2, '0');
        return `${h}:${m}:${s}`;
    }

    function render() {
        timerText.textContent = formatTime(remainingSeconds);

        const elapsed = totalSeconds - remainingSeconds;
        const angle = totalSeconds > 0 ? (elapsed / totalSeconds) * 360 : 0;
        timerDisplay.style.setProperty('--cut-angle', `${angle}deg`);
    }

    function startCountdown() {
        if (intervalId !== null) {
            return;
        }

        startBtn.disabled = true;
        stopBtn.disabled = false;

        intervalId = setInterval(() => {
            remainingSeconds--;

            if (remainingSeconds <= 0) {
                remainingSeconds = 0;
                render();
                clearInterval(intervalId);
                intervalId = null;
                startBtn.disabled = false;
                stopBtn.disabled = true;
                window.location.href = '/tasklist';
                return;
            }

            render();
        }, 1000);
    }

    function stopCountdown() {
        if (intervalId === null) {
            return;
        }

        clearInterval(intervalId);
        intervalId = null;
        startBtn.disabled = false;
        stopBtn.disabled = true;
    }

    startBtn.addEventListener('click', startCountdown);
    stopBtn.addEventListener('click', stopCountdown);

    startBtn.disabled = false;
    stopBtn.disabled = true;

    render();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initWorkCount);
} else {
    initWorkCount();
}
