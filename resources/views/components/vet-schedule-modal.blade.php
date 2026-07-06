<!-- Vet Schedule Modal: "Check Vet Availability" widget, driven by resources/js/vet-schedule.js -->
<div id="vetScheduleModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center px-3 sm:px-4 py-4 sm:py-8 bg-carob-900/50 backdrop-blur-md opacity-0 transition-opacity duration-300 ease-out">
    <div id="vetScheduleModalPanel"
        class="bg-white rounded-[2rem] sm:rounded-[2.5rem] shadow-2xl max-w-5xl w-full flex flex-col border-4 border-white ring-1 ring-gray-100 max-h-[92vh] opacity-0 scale-95 transition-all duration-300 ease-out">

        <!-- Sticky Header -->
        <div class="flex items-center gap-3 sm:gap-4 px-5 sm:px-8 pt-5 sm:pt-6 pb-4 border-b border-carob-100 flex-shrink-0">
            <div id="scheduleModalAvatar"
                class="w-11 h-11 sm:w-14 sm:h-14 rounded-full overflow-hidden bg-soft-linen-100 flex items-center justify-center flex-shrink-0 border-2 border-white shadow-md">
                <i data-lucide="user" class="w-5 h-5 sm:w-6 sm:h-6 text-carob-300"></i>
            </div>
            <div class="min-w-0 flex-1">
                <h3 id="scheduleModalVetName" class="text-base sm:text-lg font-bold text-carob-900 font-heading leading-tight truncate">Dokter</h3>
                <p class="text-carob-400 text-xs">Cek ketersediaan jadwal praktik</p>
            </div>
            <button type="button" id="closeVetScheduleModal" aria-label="Tutup"
                class="text-carob-300 hover:text-carob-600 hover:bg-soft-linen-50 rounded-full p-2 transition-colors flex-shrink-0">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Scrollable Body -->
        <div class="flex-1 overflow-y-auto px-5 sm:px-8 py-4 sm:py-5">
            <!-- Filter Form -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3">
                <div>
                    <label for="scheduleVisitTypeSearch" class="block text-[11px] font-bold text-carob-500 mb-1.5 uppercase tracking-wider">Visit
                        Type</label>
                    <div class="relative" id="scheduleVisitTypeField">
                        <i data-lucide="stethoscope"
                            class="w-4 h-4 text-carob-300 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none z-10"></i>
                        <input type="text" id="scheduleVisitTypeSearch" autocomplete="off" placeholder="Memuat..." disabled
                            class="w-full pl-10 pr-9 py-2.5 bg-soft-linen-50 border-2 border-transparent focus:border-forest-moss-green-400 rounded-2xl text-carob-800 text-sm font-medium focus:ring-0 focus:bg-white transition-all cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                        <input type="hidden" id="scheduleVisitType" value="">
                        <i data-lucide="chevron-down" id="scheduleVisitTypeChevron"
                            class="w-4 h-4 text-carob-300 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none transition-transform duration-200"></i>

                        <div id="scheduleVisitTypeDropdown"
                            class="schedule-popover hidden absolute z-30 left-0 right-0 mt-2 bg-white rounded-2xl shadow-xl border border-carob-100 max-h-60 overflow-y-auto py-1.5">
                        </div>
                    </div>
                </div>
                <div>
                    <label for="scheduleStartDateDisplay" class="block text-[11px] font-bold text-carob-500 mb-1.5 uppercase tracking-wider">Dari
                        Tanggal</label>
                    <div class="relative" id="scheduleStartDateField">
                        <i data-lucide="calendar"
                            class="w-4 h-4 text-carob-300 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none z-10"></i>
                        <input type="text" id="scheduleStartDateDisplay" readonly autocomplete="off" placeholder="Pilih tanggal"
                            class="w-full pl-10 pr-3 py-2.5 bg-soft-linen-50 border-2 border-transparent focus:border-forest-moss-green-400 rounded-2xl text-carob-800 text-sm font-medium cursor-pointer transition-all">
                        <input type="hidden" id="scheduleStartDate" value="">

                        <div id="scheduleStartDateCalendar"
                            class="schedule-popover hidden absolute z-30 left-0 mt-2 bg-white rounded-2xl shadow-xl border border-carob-100 p-3 w-64">
                        </div>
                    </div>
                </div>
                <div>
                    <label for="scheduleEndDateDisplay" class="block text-[11px] font-bold text-carob-500 mb-1.5 uppercase tracking-wider">Sampai
                        Tanggal</label>
                    <div class="relative" id="scheduleEndDateField">
                        <i data-lucide="calendar"
                            class="w-4 h-4 text-carob-300 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none z-10"></i>
                        <input type="text" id="scheduleEndDateDisplay" readonly autocomplete="off" placeholder="Pilih tanggal"
                            class="w-full pl-10 pr-3 py-2.5 bg-soft-linen-50 border-2 border-transparent focus:border-forest-moss-green-400 rounded-2xl text-carob-800 text-sm font-medium cursor-pointer transition-all">
                        <input type="hidden" id="scheduleEndDate" value="">

                        <div id="scheduleEndDateCalendar"
                            class="schedule-popover hidden absolute z-30 right-0 mt-2 bg-white rounded-2xl shadow-xl border border-carob-100 p-3 w-64">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2.5 sm:gap-3 mb-4">
                <button type="button" id="scheduleSearchBtn"
                    class="w-full sm:flex-1 bg-forest-moss-green-500 hover:bg-forest-moss-green-600 disabled:opacity-60 disabled:cursor-not-allowed text-white py-2.5 rounded-2xl font-bold text-sm shadow-lg shadow-forest-moss-green-200 hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                    <i data-lucide="calendar-search" class="w-4 h-4"></i>
                    <span>Lihat Jadwal</span>
                </button>
                <p class="text-[11px] text-carob-400 flex items-center gap-1.5 sm:flex-shrink-0 justify-center sm:justify-start">
                    <i data-lucide="info" class="w-3.5 h-3.5 flex-shrink-0"></i>
                    Waktu tampil dalam WIB (GMT+7)
                </p>
            </div>

            <!-- Result -->
            <div id="scheduleResult"></div>
        </div>

        <!-- Sticky Footer: real booking still happens on Digitail -->
        <div class="px-5 sm:px-8 py-4 border-t border-carob-100 flex-shrink-0">
            <a id="scheduleModalBookLink" href="https://vet.digitail.io/clinics/zow-vet-clinic" target="_blank" rel="noopener"
                class="w-full py-3 sm:py-3.5 px-6 bg-carob-900 hover:bg-forest-moss-green-700 text-white rounded-2xl font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm">
                <span>Book Appointment via Digitail</span>
                <i data-lucide="external-link" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</div>
