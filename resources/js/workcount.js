import { addWorkSeconds, updateDailyChart } from './dailyreport.js';

export function initWorkCount() {
    const root = document.getElementById('timer-root');
    if (!root) {
        return;
    }
    // データの定義
    const totalSeconds = Number(root.dataset.totalSeconds);
    let remainingSeconds = Number(root.dataset.remainingSeconds);
    let intervalId = null;
    // ページ内容の定義
    const timerDisplay = root.querySelector('#timer-display');
    const timerText = root.querySelector('#timer-text');
    const startBtn = root.querySelector('#start-work');
    const stopBtn = root.querySelector('#stop-work');
    // ページが動くための条件を定義
    if (!timerDisplay || !timerText || !startBtn || !stopBtn) {
        return;
    }
    // 制限時間を定義
    function recordWorkSession() {
        const elapsed = totalSeconds - remainingSeconds;
        if (elapsed > 0) {
            addWorkSeconds(elapsed, 'work');
            updateDailyChart();
        }
    }
    //時間を定義 
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
   // 時間の計測を始める
    function startCountdown() {
        if (intervalId !== null) {
            return;
        }

        startBtn.disabled = true;
        stopBtn.disabled = false;

        intervalId = setInterval(() => {
            remainingSeconds--;
            //計測始まってからの定義 、終了した後の処理を定義
            if (remainingSeconds <= 0) {
                remainingSeconds = 0;
                recordWorkSession();
                render();
                clearInterval(intervalId);
                intervalId = null;
                startBtn.disabled = false;
                stopBtn.disabled = true;
                window.location.href = '/tasklist';
                alert('時間が終了しました。タスクリストにリダイレクトします。');
                return;
            }

            render();
        }, 1000);
    }
    // 終了後、時間の計測を停止する
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
   // ページ内容と紐づけ、各ボタンをクリックした時の処理を定義する
    startBtn.addEventListener('click', startCountdown);
    stopBtn.addEventListener('click', stopCountdown);

    startBtn.disabled = false;
    stopBtn.disabled = true;

    render();
}
