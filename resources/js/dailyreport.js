let chartRoot = null;
let chartCanvas = null;
let chartCtx = null;

// flowchart.barがないためJSで定義
// グラフのデータを保存するためのキーを定義
function getStorageKey() {
    if (!chartRoot) {
        return 'daily-chart-data';
    }

    const userId = chartRoot.dataset.userId ?? 'guest';
    return `daily-chart-data-${userId}`;
}

function getTodayKey() {
    return new Date().toISOString().slice(0, 10);
}

function getChartData() {
    if (!chartRoot) {
        return {};
    }

    try {
        const stored = localStorage.getItem(getStorageKey());
        if (stored) {
            return JSON.parse(stored);
        }
    } catch {
        // fall through to server-provided initial data
    }

    try {
        return JSON.parse(chartRoot.dataset.chartData ?? '{}');
    } catch {
        return {};
    }
}
// グラフのデータを保存する
function saveChartData(data) {
    localStorage.setItem(getStorageKey(), JSON.stringify(data));
}

export function getElapsedDays() {
    if (!chartRoot) {
        return 1;
    }

    const createdAt = Number(chartRoot.dataset.createdAt);
    const elapsedDays = Math.floor((Date.now() / 1000 - createdAt) / 86400);

    return Math.max(elapsedDays + 1, 1);
}

// 日付の合計を定義
function getDayKeys() {
    if (!chartRoot) {
        return [getTodayKey()];
    }

    const createdAt = Number(chartRoot.dataset.createdAt) * 1000;
    const start = new Date(createdAt);
    start.setHours(0, 0, 0, 0);

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const days = [];
    const cursor = new Date(start);

    while (cursor <= today) {
        days.push(cursor.toISOString().slice(0, 10));
        cursor.setDate(cursor.getDate() + 1);
    }

    return days.length > 0 ? days : [getTodayKey()];
}

// 時間の合計を定義
function getDayTotalSeconds(entry) {
    if (!entry) {
        return 0;
    }

    if (typeof entry === 'number') {
        return entry;
    }

    return (entry.work ?? 0) + (entry.stretch ?? 0);
}

// 時間の表示を定義
function formatDuration(seconds) {
    const h = Math.floor(seconds / 3600);
    const m = Math.floor((seconds % 3600) / 60);

    if (h > 0) {
        return `${h}時間${m}分`;
    }

    return `${m}分`;
}

// グラフの描画を行う
function drawChart() {
    if (!chartCanvas || !chartCtx || !chartRoot) {
        return;
    }

    const data = getChartData();
    const days = getDayKeys();
    const values = days.map((day) => getDayTotalSeconds(data[day]));
    const maxVal = Math.max(...values, 60);

    const dpr = window.devicePixelRatio || 1;
    const rect = chartCanvas.getBoundingClientRect();
    chartCanvas.width = Math.max(rect.width, 1) * dpr;
    chartCanvas.height = Math.max(rect.height, 1) * dpr;
    chartCtx.setTransform(dpr, 0, 0, dpr, 0, 0);

    const width = rect.width;
    const height = rect.height;
    const padding = { top: 16, right: 12, bottom: 28, left: 36 };
    const chartWidth = width - padding.left - padding.right;
    const chartHeight = height - padding.top - padding.bottom;

    chartCtx.clearRect(0, 0, width, height);
    chartCtx.fillStyle = '#f9fafb';
    chartCtx.fillRect(padding.left, padding.top, chartWidth, chartHeight);

    const slotWidth = chartWidth / days.length;
    const barWidth = Math.max(slotWidth * 0.6, 4);

    values.forEach((value, index) => {
        const barHeight = (value / maxVal) * chartHeight;
        const x = padding.left + index * slotWidth + (slotWidth - barWidth) / 2;
        const y = padding.top + chartHeight - barHeight;

        chartCtx.fillStyle = '#22c55e';
        chartCtx.globalAlpha = value > 0 ? 0.85 : 0.2;
        chartCtx.fillRect(x, y, barWidth, Math.max(barHeight, value > 0 ? 2 : 0));
        chartCtx.globalAlpha = 1;

        chartCtx.fillStyle = '#6b7280';
        chartCtx.font = '10px sans-serif';
        chartCtx.textAlign = 'center';
        chartCtx.fillText(String(index + 1), x + barWidth / 2, height - 8);
    });

    chartCtx.strokeStyle = '#d1d5db';
    chartCtx.beginPath();
    chartCtx.moveTo(padding.left, padding.top);
    chartCtx.lineTo(padding.left, padding.top + chartHeight);
    chartCtx.lineTo(padding.left + chartWidth, padding.top + chartHeight);
    chartCtx.stroke();

    chartCtx.fillStyle = '#6b7280';
    chartCtx.font = '10px sans-serif';
    chartCtx.textAlign = 'right';
    chartCtx.fillText(formatDuration(maxVal), padding.left - 4, padding.top + 10);

    const summary = chartRoot.querySelector('#daily-chart-summary');
    if (summary) {
        const todayTotal = getDayTotalSeconds(data[getTodayKey()]);
        summary.textContent = `今日の作業時間: ${formatDuration(todayTotal)}`;
    }
}

// 作業時間の計測を始める
export function addWorkSeconds(seconds, type = 'work') {
    if (!chartRoot || seconds <= 0) {
        return;
    }

    const data = getChartData();
    const today = getTodayKey();

    if (!data[today] || typeof data[today] === 'number') {
        const previous = typeof data[today] === 'number' ? data[today] : 0;
        data[today] = { work: previous, stretch: 0 };
    }

    data[today][type] = (data[today][type] ?? 0) + seconds;
    saveChartData(data);
    updateDailyChart();
}

// グラフと紐づけを行う
export function updateDailyChart() {
    drawChart();
}

// グラフの初期化を紐づけする
export function initDailyReport() {
    chartRoot = document.getElementById('daily-chart-root');
    if (!chartRoot) {
        return;
    }

    chartCanvas = chartRoot.querySelector('#daily-chart-canvas');
    if (!chartCanvas) {
        return;
    }

    chartCtx = chartCanvas.getContext('2d');
    updateDailyChart();

    if (typeof ResizeObserver !== 'undefined') {
        const observer = new ResizeObserver(() => updateDailyChart());
        observer.observe(chartCanvas);
    } else {
        window.addEventListener('resize', updateDailyChart);
    }
}
