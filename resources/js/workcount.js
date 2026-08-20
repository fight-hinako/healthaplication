import { addWorkSeconds, updateDailyChart } from './dailyreport.js';

export function initWorkCount() {
    const root = document.getElementById('timer-root');
    if (!root) {
        return;
    }
    // 定義
    const totalSeconds = Number(root.dataset.totalSeconds);
    let remainingSeconds = Number(root.dataset.remainingSeconds);
    let intervalId = null;
    const timerDisplay = root.querySelector('#timer-display');
    const timerText = root.querySelector('#timer-text');
    const startBtn = root.querySelector('#start-work');
    const stopBtn = root.querySelector('#stop-work');
    const soundToggleBtn = root.querySelector('#timer-sound-toggle');
    const soundToggleBtnOff = root.querySelector('#timer-sound-toggle-off');

    // ページが動くための条件を定義
    if (!timerDisplay || !timerText || !startBtn || !stopBtn) {
        return;
    }
    function playTimerEndSound() {
        if (root.dataset.soundEnabled !== '1') {
            return;
        }
        const sound = new Audio('/sound/timersound.wav');
        sound.loop = true;
        sound.play();
    }
    async function persistSoundEnabled(enabled) {
        const token = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
        try {
            const response = await fetch('/home/sound-enabled', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({ sound_enabled: enabled }),
            });
            if (!response.ok) {
                throw new Error('保存に失敗しました');
            }
        } catch (error) {
            console.error(error);
        }
    }
    function toggleSound(currentEnabled) {
        if (currentEnabled === '1') {
            root.dataset.soundEnabled = '0';
            soundToggleBtn.classList.add('hidden');
            soundToggleBtnOff.classList.remove('hidden');
            persistSoundEnabled(false);
        } else {
            root.dataset.soundEnabled = '1';
            soundToggleBtnOff.classList.add('hidden');
            soundToggleBtn.classList.remove('hidden');
            persistSoundEnabled(true);

        }
    }
    function recordWorkSession() {
        const elapsed = totalSeconds - remainingSeconds;
        if (elapsed > 0) {
            addWorkSeconds(elapsed, 'work');
            updateDailyChart();
        }
    }
    function formatTime(seconds) {
        const h = String(Math.floor(seconds / 3600)).padStart(2, '0');
        const m = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
        const s = String(seconds % 60).padStart(2, '0');
        return `${h}:${m}:${s}`;
    }
    // 時間の表示
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
                recordWorkSession();
                render();
                clearInterval(intervalId);
                intervalId = null;
                startBtn.disabled = false;
                stopBtn.disabled = true;
                playTimerEndSound();
                alert('時間が終了しました。タスクリストにリダイレクトします。');
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
        recordWorkSession();
        render();
    }

    startBtn.addEventListener('click', startCountdown);
    stopBtn.addEventListener('click', stopCountdown);
   if (soundToggleBtn && soundToggleBtnOff) {
        soundToggleBtn.addEventListener('click', () => {
            toggleSound(soundToggleBtn.dataset.soundEnabled);
        });
        soundToggleBtnOff.addEventListener('click', () => {
            toggleSound(soundToggleBtnOff.dataset.soundEnabled);
        });
    }
    startBtn.disabled = false;
    stopBtn.disabled = true;
    render();
}