import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

// One brand accent for every single-series chart (magnitude/trend). Status
// charts (payment status, appointment status) carry their own per-bar colors
// from the server instead — see ExecutiveController::statusColor().
const ACCENT = '#955c26';
const GRID = 'rgba(41,31,20,0.08)';
const TICK = '#9e8b6e';

Chart.defaults.font.family = "'Plus Jakarta Sans', system-ui, -apple-system, sans-serif";
Chart.defaults.color = '#52483d';

function buildConfig(config) {
    const color = config.color ?? ACCENT;
    const isHorizontalBar = config.type === 'bar';

    if (config.type === 'line') {
        return {
            type: 'line',
            data: {
                labels: config.labels,
                datasets: [{
                    label: config.label || '',
                    data: config.data,
                    borderColor: color,
                    backgroundColor: color + '1a',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 0,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: color,
                    pointHoverBorderColor: '#fbf8f4',
                    pointHoverBorderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: GRID, drawTicks: false }, border: { display: false }, ticks: { color: TICK, padding: 8 } },
                    x: { grid: { display: false }, border: { color: GRID }, ticks: { color: TICK, padding: 8 } },
                },
            },
        };
    }

    // Bar — always horizontal: category labels (species, vets, product names)
    // read cleanly at any viewport width without rotating or truncating.
    const barColors = config.colors ?? config.data.map(() => color);

    return {
        type: 'bar',
        data: {
            labels: config.labels,
            datasets: [{
                label: config.label || '',
                data: config.data,
                backgroundColor: barColors,
                borderRadius: { topRight: 4, bottomRight: 4, topLeft: 0, bottomLeft: 0 },
                borderSkipped: false,
                maxBarThickness: 22,
                categoryPercentage: 0.7,
            }],
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, grid: { color: GRID, drawTicks: false }, border: { display: false }, ticks: { color: TICK, padding: 8 } },
                y: { grid: { display: false }, border: { color: GRID }, ticks: { color: '#3d332a', padding: 10, font: { weight: '500' } } },
            },
        },
    };
}

function initCharts(scope = document) {
    scope.querySelectorAll('canvas[data-chart]').forEach((canvas) => {
        if (canvas.dataset.chartInitialized || canvas.closest('[data-tab-panel].hidden')) {
            return;
        }

        const config = JSON.parse(canvas.dataset.chart);
        new Chart(canvas, buildConfig(config));
        canvas.dataset.chartInitialized = '1';
    });
}

function initTabs() {
    const buttons = document.querySelectorAll('[data-tab-target]');
    const panels = document.querySelectorAll('[data-tab-panel]');

    if (!buttons.length) {
        return;
    }

    function activate(name) {
        panels.forEach((panel) => {
            panel.classList.toggle('hidden', panel.dataset.tabPanel !== name);
        });

        buttons.forEach((btn) => {
            btn.classList.toggle('is-active', btn.dataset.tabTarget === name);
        });

        // Charts inside a panel that was still `hidden` at DOMContentLoaded
        // render at zero size, so each panel's charts are only initialized
        // the first time it becomes visible.
        initCharts(document.querySelector(`[data-tab-panel="${name}"]`) ?? document);
    }

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            activate(btn.dataset.tabTarget);
            history.replaceState(null, '', '#' + btn.dataset.tabTarget);
        });
    });

    const requested = window.location.hash.replace('#', '');
    const initial = [...buttons].some((b) => b.dataset.tabTarget === requested) ? requested : buttons[0].dataset.tabTarget;
    activate(initial);
}

document.addEventListener('DOMContentLoaded', () => {
    initTabs();
});
