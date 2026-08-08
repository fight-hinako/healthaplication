function initTaskCount() {
    const root = document.getElementById('task-countdown-minute-root');
    if (!root) {
        return;
    }

    const display = root.querySelector('#task-countdown-display');
    const startBtn = root.querySelector('#start-task-countdown-minute');
    const taskButtons = root.querySelectorAll('.task-item');

    if (!display || !startBtn) {
        return;
    }

    const tasks = JSON.parse(root.dataset.tasks ?? '[]');
    const checkedTaskIds = new Set();
    let remainingSeconds = 0;
    let activeTaskId = null;
    let intervalId = null;

    function formatTime(seconds) {
        const m = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
        const s = String(seconds % 60).padStart(2, '0');
        return `${m}:${s}`;
    }

    function getNextUncheckedTaskId() {
        for (const task of tasks) {
            if (!checkedTaskIds.has(task.id)) {
                return task.id;
            }
        }

        return null;
    }

    function getTaskButton(taskId) {
        return root.querySelector(`.task-item[data-task-id="${taskId}"]`);
    }

    function renderTasks() {
        taskButtons.forEach((button) => {
            const taskId = Number(button.dataset.taskId);
            const isChecked = checkedTaskIds.has(taskId);
            const isActive = activeTaskId === taskId;

            button.classList.toggle('is-checked', isChecked);
            button.classList.toggle('is-active', isActive);
            button.disabled = intervalId !== null && !isChecked && !isActive;

            const check = button.querySelector('.task-check');
            const name = button.querySelector('.task-name');
            const duration = button.querySelector('.task-duration');

            check.classList.toggle('border-[#22c55e]', isChecked);
            check.classList.toggle('bg-[#22c55e]', isChecked);
            check.classList.toggle('text-white', isChecked);
            check.classList.toggle('border-[#c8ccd2]', !isChecked);

            name.classList.toggle('line-through', isChecked);
            name.classList.toggle('text-[#8b919a]', isChecked);
            duration.classList.toggle('text-[#8b919a]', isChecked);
        });

        if (intervalId === null) {
            startBtn.disabled = getNextUncheckedTaskId() === null;
        }
    }

    function renderCountdown() {
        display.textContent = formatTime(remainingSeconds);
    }

    function toggleTask(taskId) {
        if (intervalId !== null && activeTaskId === taskId) {
            return;
        }

        if (checkedTaskIds.has(taskId)) {
            checkedTaskIds.delete(taskId);
        } else {
            checkedTaskIds.add(taskId);
        }

        renderTasks();
    }

    function finishCountdown() {
        clearInterval(intervalId);
        intervalId = null;

        if (activeTaskId !== null) {
            checkedTaskIds.add(activeTaskId);
        }

        activeTaskId = null;
        remainingSeconds = 0;
        startBtn.disabled = false;
        renderCountdown();
        renderTasks();

        const nextTaskId = getNextUncheckedTaskId();
        if (nextTaskId === null) {
            return;
        }

        startCountdownForTask(nextTaskId);
    }

    function startCountdownForTask(taskId) {
        const button = getTaskButton(taskId);
        if (!button) {
            return;
        }

        activeTaskId = taskId;
        remainingSeconds = Number(button.dataset.countdownSeconds);
        startBtn.disabled = true;
        renderTasks();
        renderCountdown();

        intervalId = setInterval(() => {
            remainingSeconds--;

            if (remainingSeconds <= 0) {
                remainingSeconds = 0;
                finishCountdown();
                return;
            }

            renderCountdown();
        }, 1000);
    }

    function startCountdown() {
        if (intervalId !== null) {
            return;
        }

        const nextTaskId = getNextUncheckedTaskId();
        if (nextTaskId === null) {
            return;
        }

        startCountdownForTask(nextTaskId);
    }

    taskButtons.forEach((button) => {
        button.addEventListener('click', () => {
            toggleTask(Number(button.dataset.taskId));
        });
    });

    startBtn.addEventListener('click', startCountdown);

    renderCountdown();
    renderTasks();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTaskCount);
} else {
    initTaskCount();
}
