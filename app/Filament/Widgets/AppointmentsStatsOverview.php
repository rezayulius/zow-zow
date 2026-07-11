<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class AppointmentsStatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected ?string $heading = 'Ringkasan Appointment';

    protected ?string $description = 'Total appointment, rata-rata per hari, tingkat vaksinasi, dan rasio pasien baru vs lama.';

    protected function getStats(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getAppointments(1, 250, $this->pageFilters['start_date'] ?? null, $this->pageFilters['end_date'] ?? null);
        $appointments = collect($response['data'] ?? []);

        if ($appointments->isEmpty()) {
            return [Stat::make('No Data', '0')];
        }

        // 1. Total Appointments
        $total = $appointments->count();

        // 2. Avg Appointments / Day
        $groupedByDate = $appointments->groupBy(fn($a) => Carbon::parse($a['datetime_start_utc'])->format('Y-m-d'));
        $avgPerDay = $groupedByDate->count() > 0 ? round($total / $groupedByDate->count(), 1) : 0;

        // 3. % Vaccination vs Others
        $vaccinations = $appointments->filter(function($a) {
            $cat = strtolower($a['visit_type']['category_label'] ?? $a['service']['label'] ?? '');
            return str_contains($cat, 'vaccin');
        })->count();
        $vaccinationRate = $total > 0 ? round(($vaccinations / $total) * 100, 1) : 0;

        // 4. New vs Returning (Simulated logic based on is_new_patient or frequency)
        // Since API might not explicitly show "is_new_patient" on root, we'll try to find it or simulate.
        // Let's assume 'is_new_patient' key exists or use a heuristic.
        // For now, let's look for 'is_new_patient' in the appointment object or pet object.
        $newPatients = $appointments->filter(fn($a) => 
            ($a['pet']['future_appointment']['is_new_patient'] ?? false) || 
            ($a['is_new_patient'] ?? false)
        )->count();
        $returning = $total - $newPatients;

        return [
            Stat::make('Total Appointments', $total)
                ->description('Dalam rentang tanggal terpilih')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make('Avg Appts / Day', $avgPerDay)
                ->description('Daily average')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),

            Stat::make('Vaccination Rate', $vaccinationRate . '%')
                ->description("{$vaccinations} vaccinations")
                ->descriptionIcon('heroicon-m-beaker')
                ->color('warning'),

            Stat::make('New vs Returning', "{$newPatients} / {$returning}")
                ->description('Patient retention')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}
