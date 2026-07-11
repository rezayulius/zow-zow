@extends('layouts.executive')

@section('title', 'Dashboard')

@push('styles')
<style>
    .exec-tab { color: rgba(253, 252, 245, 0.5); border-bottom: 2px solid transparent; }
    .exec-tab.is-active { color: #e9d98a; border-bottom-color: #CCBD5F; }
    .exec-tab:hover { color: #fdfcf5; }
    .exec-tab svg { opacity: 0.85; }
</style>
@endpush

@php
    $icon = [
        'finansial' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'operasional' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />',
        'klinis' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 20.25a48.25 48.25 0 01-8.135-.687c-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />',
        'crm' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />',
    ];
@endphp

@section('content')
<div class="min-h-screen">
    {{-- Header --}}
    <header class="bg-deep-cocoa-brown-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-old-mustard-yellow-400 to-old-mustard-yellow-600 text-deep-cocoa-brown-900 flex items-center justify-center text-sm font-bold shrink-0 shadow-md shadow-black/30">
                    ZV
                </div>
                <div class="min-w-0">
                    <p class="text-base font-semibold text-white tracking-tight truncate">Executive Dashboard</p>
                    <p class="text-xs text-old-mustard-yellow-500/90 truncate">ZOW Vetique Kemang</p>
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <a href="{{ route('home') }}" target="_blank" rel="noopener"
                    class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-old-mustard-yellow-400 hover:text-old-mustard-yellow-300 border border-old-mustard-yellow-700/40 hover:border-old-mustard-yellow-600 rounded-lg px-3 py-2 transition-colors">
                    Lihat Website
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
                <a href="{{ route('home') }}" target="_blank" rel="noopener"
                    class="sm:hidden inline-flex items-center justify-center w-9 h-9 text-old-mustard-yellow-400 border border-old-mustard-yellow-700/40 rounded-lg">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
                <form method="POST" action="{{ route('executive.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-carob-300 hover:text-white transition-colors px-2">
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        {{-- Tabs --}}
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 flex gap-1 sm:gap-2 overflow-x-auto">
            @foreach (['finansial' => 'Finansial', 'operasional' => 'Operasional', 'klinis' => 'Klinis', 'crm' => 'CRM'] as $key => $tabLabel)
                <button type="button" data-tab-target="{{ $key }}" class="exec-tab whitespace-nowrap text-sm font-medium py-3 px-3 flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">{!! $icon[$key] !!}</svg>
                    {{ $tabLabel }}
                </button>
            @endforeach
        </nav>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-6 space-y-6">
        {{-- Date filter --}}
        <form method="GET" action="{{ route('executive.dashboard') }}" class="bg-carob-50 rounded-2xl border border-carob-900/[0.06] p-4 flex flex-wrap items-end gap-3 shadow-[0_1px_2px_rgba(41,31,20,0.04)]">
            <div>
                <label class="block text-xs font-medium text-carob-600 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}"
                    class="rounded-lg border border-carob-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-old-mustard-yellow-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-carob-600 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}"
                    class="rounded-lg border border-carob-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-old-mustard-yellow-500">
            </div>
            <button type="submit" class="rounded-lg bg-deep-cocoa-brown-900 hover:bg-deep-cocoa-brown-800 text-old-mustard-yellow-400 text-sm font-semibold px-4 py-2 transition-colors">
                Terapkan
            </button>
            <a href="{{ route('executive.dashboard') }}" class="rounded-lg border border-carob-200 text-carob-600 hover:bg-white text-sm font-medium px-4 py-2 transition-colors">
                Reset
            </a>
        </form>

        {{-- Finansial --}}
        <div data-tab-panel="finansial" class="space-y-4 sm:space-y-5">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <x-executive.stat-card label="Total Revenue" value="Rp {{ number_format($financial['total'], 0, ',', '.') }}" hint="Periode terpilih" />
                <x-executive.stat-card label="Outstanding (Piutang)" value="Rp {{ number_format($financial['outstanding'], 0, ',', '.') }}" :hint="$financial['outstanding'] > 0 ? 'Belum dibayar penuh' : 'Semua lunas'" :accent="$financial['outstanding'] > 0 ? 'critical' : 'good'" />
                <x-executive.stat-card label="Rata-rata Transaksi" value="Rp {{ number_format($financial['avg'], 0, ',', '.') }}" />
                <x-executive.stat-card label="Jumlah Transaksi" value="{{ $financial['count'] }}" />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4">
                <x-executive.chart-card title="Revenue Trend" description="Tren pendapatan harian" type="line" :labels="$revenueTrend['labels']" :data="$revenueTrend['data']" label="Revenue" />
                <x-executive.chart-card title="Status Pembayaran" description="Lunas / sebagian / belum dibayar" type="bar" :labels="$paymentStatus['labels']" :data="$paymentStatus['data']" :colors="$paymentStatus['colors']" height="180" />
                <x-executive.chart-card title="Top Layanan/Produk" description="10 kontribusi pendapatan terbesar" type="bar" :labels="$topServices['labels']" :data="$topServices['data']" label="Revenue" height="320" />
                <x-executive.chart-card title="Revenue per Dokter" type="bar" :labels="$revenueByVet['labels']" :data="$revenueByVet['data']" label="Revenue" height="320" />
            </div>
        </div>

        {{-- Operasional --}}
        <div data-tab-panel="operasional" class="hidden space-y-4 sm:space-y-5">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <x-executive.stat-card label="Total Appointment" :value="$appointmentsSummary['total']" />
                <x-executive.stat-card label="Rata-rata / Hari" :value="$appointmentsSummary['avgPerDay']" />
                <x-executive.stat-card label="Tingkat Vaksinasi" value="{{ $appointmentsSummary['vaccinationRate'] }}%" hint="{{ $appointmentsSummary['vaccinations'] }} vaksinasi" />
                <x-executive.stat-card label="Lab Order Pending" :value="$labOrdersSummary['pending']" :accent="$labOrdersSummary['pending'] > 0 ? 'warning' : 'good'" />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4">
                <x-executive.chart-card title="Appointment per Hari" type="line" :labels="$appointmentsPerDay['labels']" :data="$appointmentsPerDay['data']" label="Appointment" />
                <x-executive.chart-card title="Appointment by Status" type="bar" :labels="$appointmentsStatus['labels']" :data="$appointmentsStatus['data']" :colors="$appointmentsStatus['colors']" />
            </div>

            <div class="bg-carob-50 rounded-2xl border border-carob-900/[0.06] p-4 sm:p-5 shadow-[0_1px_2px_rgba(41,31,20,0.04)]">
                <h3 class="text-sm font-semibold text-carob-900 tracking-tight mb-3">5 Appointment Terbaru</h3>
                @if (empty($latestAppointments))
                    <p class="text-sm text-carob-400">Tidak ada data pada rentang tanggal ini.</p>
                @else
                    <div class="overflow-x-auto -mx-4 sm:mx-0">
                        <table class="w-full text-sm min-w-[560px]">
                            <thead>
                                <tr class="text-left text-xs text-carob-500 border-b border-carob-200">
                                    <th class="pb-2 px-4 sm:px-0 font-medium">Tanggal</th>
                                    <th class="pb-2 px-2 font-medium">Pet</th>
                                    <th class="pb-2 px-2 font-medium">Layanan</th>
                                    <th class="pb-2 px-2 font-medium">Dokter</th>
                                    <th class="pb-2 px-4 sm:px-0 font-medium">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestAppointments as $appt)
                                    <tr class="border-b border-carob-100 last:border-0">
                                        <td class="py-2.5 px-4 sm:px-0 text-carob-700 whitespace-nowrap" style="font-variant-numeric: tabular-nums;">{{ $appt['date'] }}</td>
                                        <td class="py-2.5 px-2 text-carob-700">{{ $appt['pet'] }}</td>
                                        <td class="py-2.5 px-2 text-carob-700">{{ $appt['service'] }}</td>
                                        <td class="py-2.5 px-2 text-carob-700">{{ $appt['vet'] }}</td>
                                        <td class="py-2.5 px-4 sm:px-0">
                                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-carob-700">
                                                <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $appt['statusColor'] }}"></span>
                                                {{ $appt['status'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Klinis --}}
        <div data-tab-panel="klinis" class="hidden space-y-4 sm:space-y-5">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <x-executive.stat-card label="Total Pasien" :value="$petsSummary['total']" />
                <x-executive.stat-card label="Spesies Terbanyak" :value="$petsSummary['topSpecies']" />
                <x-executive.stat-card label="Total Lab Order" :value="$labOrdersSummary['total']" />
                <x-executive.stat-card label="Top Lab Partner" :value="$labOrdersSummary['topLab']" />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4">
                <x-executive.chart-card title="Distribusi Spesies" type="bar" :labels="$petsSpecies['labels']" :data="$petsSpecies['data']" />
                <div class="bg-carob-50 rounded-2xl border border-carob-900/[0.06] p-4 sm:p-5 shadow-[0_1px_2px_rgba(41,31,20,0.04)]">
                    <h3 class="text-sm font-semibold text-carob-900 tracking-tight">Ringkasan Lab Order</h3>
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <x-executive.stat-card label="Pending" :value="$labOrdersSummary['pending']" :accent="$labOrdersSummary['pending'] > 0 ? 'warning' : 'good'" />
                        <x-executive.stat-card label="Completed" :value="$labOrdersSummary['completed']" accent="good" />
                    </div>
                </div>
            </div>
        </div>

        {{-- CRM --}}
        <div data-tab-panel="crm" class="hidden space-y-4 sm:space-y-5">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <x-executive.stat-card label="Pet Parent Baru" :value="$petParentsGrowth['total']" hint="Periode terpilih" />
                <x-executive.stat-card label="Reminder Overdue" :value="$reminderCompliance['overdue']" :accent="$reminderCompliance['overdue'] > 0 ? 'critical' : 'good'" />
                <x-executive.stat-card label="Reminder Pending" :value="$reminderCompliance['pending']" accent="warning" />
                <x-executive.stat-card label="Compliance Rate" value="{{ $reminderCompliance['complianceRate'] }}%" hint="{{ $reminderCompliance['administered'] }} sudah diberikan" accent="good" />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4">
                <x-executive.chart-card title="Pet Parent Baru" description="Per hari pada periode terpilih" type="line" :labels="$petParentsGrowth['labels']" :data="$petParentsGrowth['data']" label="Pet Parent" />
                <x-executive.chart-card title="Reminder by Species" type="bar" :labels="$reminderBySpecies['labels']" :data="$reminderBySpecies['data']" />
            </div>
        </div>

        <p class="text-xs text-carob-400 text-center pb-4">
            Data dari Digitail API &middot; {{ $startDate }} s/d {{ $endDate }}
        </p>
    </main>
</div>
@endsection
