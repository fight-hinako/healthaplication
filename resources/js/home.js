import { initDailyReport } from './dailyreport.js';
import { initWorkCount } from './workcount.js';
import { initTaskCount } from './taskcount.js';


function initHome() {
    initDailyReport();
    initWorkCount();
    initTaskCount();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHome);
} else {
    initHome();
}
