// Vet Schedule availability widget: powers the "Check Vet Availability" modal
// on the homepage booking section (searchable visit-type combobox, two
// calendar date pickers, and the schedule results grid).

const DAY_ABBR = ['MIN', 'SEN', 'SEL', 'RAB', 'KAM', 'JUM', 'SAB'];
const MONTH_ABBR = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'];
const MONTH_NAMES = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
const WEEKDAY_SHORT = ['M', 'S', 'S', 'R', 'K', 'J', 'S'];

// Inline SVGs matching the Lucide icons they replace, used anywhere a UI
// element re-renders on a hot path (every keystroke / every calendar nav
// click) so we don't have to call lucide.createIcons() there — that call
// rescans every [data-lucide] icon on the whole page, not just the new bit.
const ICON_CHECK = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 flex-shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>';
const ICON_CHEVRON_LEFT = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="15 18 9 12 15 6"></polyline></svg>';
const ICON_CHEVRON_RIGHT = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="9 18 15 12 9 6"></polyline></svg>';

function escapeHtml(value) {
    return String(value ?? '').replace(/[&<>"']/g, (char) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
    }[char]));
}

// Local-date-based YYYY-MM-DD, deliberately NOT toISOString() (which
// converts to UTC and shifts the calendar date for anyone east of GMT,
// including the site's own Asia/Jakarta audience during 00:00-06:59 WIB).
function formatDateInput(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

function isSameDay(a, b) {
    return a && b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate();
}

function formatSlotTime(iso) {
    return new Date(iso)
        .toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true, timeZone: 'Asia/Jakarta' })
        .replace(' ', '');
}

export function initVetScheduleWidget() {
    const modal = document.getElementById('vetScheduleModal');
    if (!modal) return; // Widget not present on this page.

    // wire:navigate re-runs this on every page load, including repeat visits
    // to "/" where morphdom leaves this modal's DOM untouched — without this
    // guard, the document-level click/keydown listeners below would rebind
    // and stack up on every navigation.
    if (modal.dataset.bound) return;
    modal.dataset.bound = '1';

    const panel = document.getElementById('vetScheduleModalPanel');
    const closeBtn = document.getElementById('closeVetScheduleModal');
    const avatarEl = document.getElementById('scheduleModalAvatar');
    const nameEl = document.getElementById('scheduleModalVetName');
    const visitTypeHidden = document.getElementById('scheduleVisitType');
    const startDateInput = document.getElementById('scheduleStartDate');
    const endDateInput = document.getElementById('scheduleEndDate');
    const searchBtn = document.getElementById('scheduleSearchBtn');
    const searchBtnLabel = searchBtn?.querySelector('span');
    const resultDiv = document.getElementById('scheduleResult');

    // Custom combobox (searchable "dropdown") elements
    const visitTypeSearchInput = document.getElementById('scheduleVisitTypeSearch');
    const visitTypeDropdown = document.getElementById('scheduleVisitTypeDropdown');
    const visitTypeChevron = document.getElementById('scheduleVisitTypeChevron');

    // Custom calendar date picker elements
    const startDateDisplay = document.getElementById('scheduleStartDateDisplay');
    const startDateCalendar = document.getElementById('scheduleStartDateCalendar');
    const endDateDisplay = document.getElementById('scheduleEndDateDisplay');
    const endDateCalendar = document.getElementById('scheduleEndDateCalendar');

    let currentVetId = null;
    let allVisitTypes = [];
    let selectedVisitType = null;

    function closeAllPopovers(except) {
        document.querySelectorAll('.schedule-popover').forEach((el) => {
            if (el !== except) el.classList.add('hidden');
        });

        if (except !== visitTypeDropdown) {
            visitTypeChevron?.classList.remove('rotate-180');
            // Revert any unconfirmed search text back to the actual selection
            if (visitTypeSearchInput && selectedVisitType) {
                visitTypeSearchInput.value = selectedVisitType.name;
            }
        }
    }

    // ---- Searchable Visit Type combobox ----
    function renderVisitTypeOptions(filterText) {
        const term = (filterText || '').toLowerCase();
        const filtered = allVisitTypes.filter((vt) => vt.name.toLowerCase().includes(term));

        if (filtered.length === 0) {
            visitTypeDropdown.innerHTML = '<div class="px-4 py-3 text-xs text-carob-400 text-center">Tidak ditemukan</div>';
            return;
        }

        visitTypeDropdown.innerHTML = filtered.map((vt) => {
            const isSelected = selectedVisitType?.id == vt.id;
            const name = escapeHtml(vt.name);

            return `
                <button type="button" data-id="${escapeHtml(vt.id)}" data-name="${name}"
                    class="w-full text-left px-4 py-2.5 text-sm font-medium transition-colors flex items-center justify-between gap-2 ${isSelected ? 'bg-forest-moss-green-50 text-forest-moss-green-700' : 'text-carob-700 hover:bg-soft-linen-50'}">
                    <span class="truncate">${name}</span>
                    ${isSelected ? ICON_CHECK : ''}
                </button>
            `;
        }).join('');

        visitTypeDropdown.querySelectorAll('[data-id]').forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                selectedVisitType = { id: btn.dataset.id, name: btn.dataset.name };
                visitTypeSearchInput.value = btn.dataset.name;
                visitTypeHidden.value = btn.dataset.id;
                closeAllPopovers();
            });
        });
    }

    function openVisitTypeDropdown() {
        closeAllPopovers(visitTypeDropdown);
        const term = visitTypeSearchInput.value === (selectedVisitType?.name || '') ? '' : visitTypeSearchInput.value;
        renderVisitTypeOptions(term);
        visitTypeDropdown.classList.remove('hidden');
        visitTypeChevron?.classList.add('rotate-180');
    }

    visitTypeSearchInput?.addEventListener('click', (e) => {
        e.stopPropagation();
        openVisitTypeDropdown();
    });
    visitTypeSearchInput?.addEventListener('input', () => {
        renderVisitTypeOptions(visitTypeSearchInput.value);
        visitTypeDropdown.classList.remove('hidden');
        visitTypeChevron?.classList.add('rotate-180');
    });
    visitTypeSearchInput?.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAllPopovers();
            visitTypeSearchInput.blur();
        }
    });

    // ---- Custom calendar date picker ----
    function createDatePicker({ displayEl, hiddenEl, calendarEl, getMinDate, onChange }) {
        let viewDate = new Date();
        let selectedDate = null;

        function formatDisplay(date) {
            return `${date.getDate()} ${MONTH_ABBR[date.getMonth()]} ${date.getFullYear()}`;
        }

        function render() {
            const year = viewDate.getFullYear();
            const month = viewDate.getMonth();
            const firstDay = new Date(year, month, 1);
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const startOffset = firstDay.getDay();
            const today = new Date();
            const minDate = getMinDate ? getMinDate() : null;

            let html = `
                <div class="flex items-center justify-between mb-2 px-0.5">
                    <button type="button" data-action="prev" class="p-1.5 rounded-lg hover:bg-soft-linen-50 text-carob-400 hover:text-carob-700 transition-colors">
                        ${ICON_CHEVRON_LEFT}
                    </button>
                    <span class="text-xs font-bold text-carob-800">${MONTH_NAMES[month]} ${year}</span>
                    <button type="button" data-action="next" class="p-1.5 rounded-lg hover:bg-soft-linen-50 text-carob-400 hover:text-carob-700 transition-colors">
                        ${ICON_CHEVRON_RIGHT}
                    </button>
                </div>
                <div class="grid grid-cols-7 gap-0.5 mb-1">
                    ${WEEKDAY_SHORT.map((d) => `<span class="text-[10px] font-bold text-carob-300 text-center py-1">${d}</span>`).join('')}
                </div>
                <div class="grid grid-cols-7 gap-0.5">
            `;

            for (let i = 0; i < startOffset; i++) {
                html += '<span></span>';
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const cellDate = new Date(year, month, day);
                const isToday = isSameDay(cellDate, today);
                const isSelected = isSameDay(cellDate, selectedDate);
                const isDisabled = minDate && cellDate < minDate;

                let cls = 'text-xs font-medium rounded-lg py-1.5 transition-colors ';
                if (isDisabled) {
                    cls += 'text-carob-200 cursor-not-allowed';
                } else if (isSelected) {
                    cls += 'bg-forest-moss-green-500 text-white font-bold cursor-pointer';
                } else if (isToday) {
                    cls += 'text-forest-moss-green-700 ring-1 ring-forest-moss-green-300 cursor-pointer hover:bg-forest-moss-green-50';
                } else {
                    cls += 'text-carob-700 hover:bg-forest-moss-green-50 cursor-pointer';
                }

                html += `<button type="button" data-day="${day}" ${isDisabled ? 'disabled' : ''} class="${cls}">${day}</button>`;
            }

            html += '</div>';
            calendarEl.innerHTML = html;

            calendarEl.querySelector('[data-action="prev"]')?.addEventListener('click', (e) => {
                e.stopPropagation();
                viewDate = new Date(year, month - 1, 1);
                render();
            });
            calendarEl.querySelector('[data-action="next"]')?.addEventListener('click', (e) => {
                e.stopPropagation();
                viewDate = new Date(year, month + 1, 1);
                render();
            });
            calendarEl.querySelectorAll('[data-day]').forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const day = parseInt(btn.dataset.day, 10);
                    const newDate = new Date(year, month, day);
                    selectedDate = newDate;
                    displayEl.value = formatDisplay(newDate);
                    hiddenEl.value = formatDateInput(newDate);
                    closeAllPopovers();
                    if (onChange) onChange(newDate);
                });
            });
        }

        displayEl.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = !calendarEl.classList.contains('hidden');
            closeAllPopovers(calendarEl);
            if (!isOpen) {
                render();
                calendarEl.classList.remove('hidden');
            } else {
                calendarEl.classList.add('hidden');
            }
        });

        return {
            setDate(date) {
                selectedDate = date;
                viewDate = new Date(date.getFullYear(), date.getMonth(), 1);
                displayEl.value = formatDisplay(date);
                hiddenEl.value = formatDateInput(date);
            },
            getDate() {
                return selectedDate;
            },
        };
    }

    const startPicker = createDatePicker({
        displayEl: startDateDisplay,
        hiddenEl: startDateInput,
        calendarEl: startDateCalendar,
        getMinDate: () => {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return today;
        },
        onChange: (newStartDate) => {
            const currentEnd = endPicker.getDate();
            if (!currentEnd || currentEnd < newStartDate) {
                const newEnd = new Date(newStartDate);
                newEnd.setDate(newEnd.getDate() + 6);
                endPicker.setDate(newEnd);
            }
        },
    });

    const endPicker = createDatePicker({
        displayEl: endDateDisplay,
        hiddenEl: endDateInput,
        calendarEl: endDateCalendar,
        getMinDate: () => startPicker.getDate() || new Date(),
    });

    document.addEventListener('click', () => closeAllPopovers());

    function setSearchLoading(isLoading) {
        searchBtn.disabled = isLoading;
        if (searchBtnLabel) {
            searchBtnLabel.textContent = isLoading ? 'Mencari jadwal...' : 'Lihat Jadwal';
        }
    }

    function renderSkeleton() {
        let html = '<div class="flex gap-2 sm:gap-2.5 overflow-x-auto pb-2 snap-x snap-mandatory">';
        for (let i = 0; i < 7; i++) {
            html += `
                <div class="flex-1 min-w-[100px] snap-start rounded-2xl border border-carob-100 overflow-hidden animate-pulse">
                    <div class="h-11 bg-soft-linen-100"></div>
                    <div class="h-5 bg-soft-linen-50"></div>
                    <div class="p-1.5 grid grid-cols-2 gap-1">
                        <div class="h-7 bg-soft-linen-50 rounded-lg"></div>
                        <div class="h-7 bg-soft-linen-50 rounded-lg"></div>
                        <div class="h-7 bg-soft-linen-50 rounded-lg"></div>
                        <div class="h-7 bg-soft-linen-50 rounded-lg"></div>
                    </div>
                </div>
            `;
        }
        html += '</div>';
        resultDiv.innerHTML = html;
    }

    function renderPrompt() {
        resultDiv.innerHTML = `
            <div class="flex flex-col items-center justify-center text-center py-10 px-6 rounded-2xl bg-soft-linen-50/60 border border-dashed border-carob-200">
                <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3">
                    <i data-lucide="calendar-days" class="w-6 h-6 text-forest-moss-green-500"></i>
                </div>
                <p class="text-carob-500 text-sm font-medium max-w-xs">
                    Pilih visit type dan rentang tanggal, lalu klik <span class="font-bold text-carob-700">"Lihat Jadwal"</span> untuk melihat ketersediaan dokter.
                </p>
            </div>
        `;
        window.lucide?.createIcons();
    }

    function renderError(message) {
        resultDiv.innerHTML = `
            <div class="flex items-center gap-3 py-4 px-5 rounded-2xl bg-red-50 border border-red-100">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 flex-shrink-0"></i>
                <span class="text-red-600 text-sm font-medium">${escapeHtml(message)}</span>
            </div>
        `;
        window.lucide?.createIcons();
    }

    function renderSchedule(days) {
        if (!days || days.length === 0) {
            renderError('Tidak ada data jadwal untuk rentang tanggal ini.');
            return;
        }

        const todayStr = formatDateInput(new Date());
        let html = '<div class="flex gap-2 sm:gap-2.5 overflow-x-auto pb-2 snap-x snap-mandatory">';

        days.forEach((day) => {
            const d = new Date(day.date + 'T00:00:00');
            const dow = DAY_ABBR[d.getDay()];
            const label = `${MONTH_ABBR[d.getMonth()]} ${d.getDate()}`;
            const slots = day.slots || [];
            const isEmpty = !day.is_open || slots.length === 0;
            const isToday = day.date === todayStr;

            const cardBorder = isToday
                ? 'border-forest-moss-green-400 ring-2 ring-forest-moss-green-100'
                : (isEmpty ? 'border-carob-100' : 'border-forest-moss-green-100');

            html += `<div class="flex-1 min-w-[100px] snap-start flex flex-col rounded-2xl border ${cardBorder} ${isEmpty ? 'bg-soft-linen-50/50' : 'bg-white'} overflow-hidden shadow-sm hover:shadow-md transition-shadow">`;
            html += `<div class="text-center py-2 border-b ${isEmpty ? 'border-carob-100' : 'border-forest-moss-green-100'} relative">
                        ${isToday ? '<span class="absolute top-1 right-1.5 w-1.5 h-1.5 rounded-full bg-forest-moss-green-500"></span>' : ''}
                        <div class="text-[10px] font-bold ${isEmpty ? 'text-carob-300' : 'text-carob-500'} tracking-wide">${dow}</div>
                        <div class="text-xs sm:text-sm font-bold ${isEmpty ? 'text-carob-300' : 'text-carob-900'}">${label}</div>
                      </div>`;

            if (isEmpty) {
                html += `<div class="flex-1 flex flex-col items-center justify-center py-6 gap-1.5 min-h-[9rem]">
                            <i data-lucide="calendar-x" class="w-4 h-4 text-carob-200"></i>
                            <span class="text-[11px] text-carob-300 font-medium">No slots</span>
                          </div>`;
            } else {
                html += `<div class="text-center text-[9px] sm:text-[10px] font-bold text-forest-moss-green-600 py-1 bg-forest-moss-green-50 uppercase tracking-wide">${slots.length} slots</div>`;
                html += '<div class="grid grid-cols-2 gap-1 p-1.5 max-h-[220px] overflow-y-auto">';
                slots.forEach((slot) => {
                    html += `<div class="text-center text-[10px] sm:text-[11px] font-semibold text-forest-moss-green-700 bg-forest-moss-green-50/70 rounded-md py-1.5 hover:bg-forest-moss-green-100 transition-colors">${escapeHtml(formatSlotTime(slot.start_time))}</div>`;
                });
                html += '</div>';
            }

            html += '</div>';
        });

        html += '</div>';
        resultDiv.innerHTML = html;
        window.lucide?.createIcons();
    }

    async function loadVisitTypes() {
        visitTypeSearchInput.disabled = true;
        visitTypeSearchInput.placeholder = 'Memuat...';

        try {
            const resp = await fetch('/api/digitail/public/visit-types?per_page=100');
            const json = await resp.json();
            allVisitTypes = (json?.data?.data) || [];

            if (allVisitTypes.length === 0) {
                visitTypeSearchInput.placeholder = 'Tidak ada visit type';
                return;
            }

            selectedVisitType = { id: allVisitTypes[0].id, name: allVisitTypes[0].name };
            visitTypeSearchInput.value = selectedVisitType.name;
            visitTypeHidden.value = selectedVisitType.id;
            visitTypeSearchInput.placeholder = 'Cari visit type...';
        } catch (error) {
            console.error('Failed to load visit types:', error);
            visitTypeSearchInput.placeholder = 'Gagal memuat visit type';
        } finally {
            visitTypeSearchInput.disabled = false;
        }
    }

    async function fetchVetSchedule() {
        const visitTypeId = visitTypeHidden.value;
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        if (!currentVetId || !visitTypeId || !startDate || !endDate) {
            renderError('Lengkapi visit type dan tanggal terlebih dahulu.');
            return;
        }

        setSearchLoading(true);
        renderSkeleton();

        try {
            const params = new URLSearchParams({
                vet_id: currentVetId,
                start_date: startDate,
                end_date: endDate,
                visit_type_id: visitTypeId,
            });

            const resp = await fetch(`/api/digitail/public/vet-schedule?${params.toString()}`);
            const json = await resp.json();

            if (!json.success) {
                renderError(json.message || 'Gagal memuat jadwal.');
                return;
            }

            renderSchedule(json.data?.data || []);
        } catch (error) {
            console.error('Failed to fetch vet schedule:', error);
            renderError('Terjadi kesalahan jaringan. Silakan coba lagi.');
        } finally {
            setSearchLoading(false);
        }
    }

    function openModal(trigger) {
        const data = trigger.dataset;
        currentVetId = data.vetId;

        nameEl.textContent = data.vetName || 'Dokter';

        avatarEl.innerHTML = data.vetAvatar
            ? `<img src="${escapeHtml(data.vetAvatar)}" alt="${escapeHtml(data.vetName || '')}" class="w-full h-full object-cover">`
            : '<i data-lucide="user" class="w-7 h-7 text-carob-300"></i>';

        const today = new Date();
        const endDate = new Date(today);
        endDate.setDate(endDate.getDate() + 6);
        startPicker.setDate(today);
        endPicker.setDate(endDate);
        closeAllPopovers();

        renderPrompt();

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        window.lucide?.createIcons();

        // Animate in on the next frame so the transition from the initial
        // opacity-0/scale-95 state actually plays instead of snapping.
        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            panel.classList.remove('opacity-0', 'scale-95');
        });

        if (allVisitTypes.length === 0) {
            loadVisitTypes();
        }
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        panel.classList.add('opacity-0', 'scale-95');
        document.body.style.overflow = '';

        window.setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.querySelectorAll('.vet-schedule-trigger').forEach((trigger) => {
        trigger.addEventListener('click', () => openModal(trigger));
    });

    closeBtn?.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });

    searchBtn?.addEventListener('click', fetchVetSchedule);
}
