<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class AppointmentsStatusBreakdownChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Appointments by Status';

    protected ?string $description = 'Jumlah appointment berdasarkan status aktual (confirmed, cancelled, completed, dll).';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 1;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getAppointments(1, 250, $this->pageFilters['start_date'] ?? null, $this->pageFilters['end_date'] ?? null);
        $appointments = collect($response['data'] ?? []);

        if ($appointments->isEmpty()) {
            return ['datasets' => [], 'labels' => []];
        }

        $grouped = $appointments
            ->groupBy(fn ($a) => $a['status'] ?? 'unknown')
            ->map(fn ($group) => $group->count())
            ->sortDesc();

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $grouped->values()->toArray(),
                    'backgroundColor' => [
                        '#22c55e', '#3b82f6', '#f59e0b', '#ef4444', '#a855f7', '#14b8a6',
                    ],
                ],
            ],
            'labels' => $grouped->keys()->map(fn ($status) => Str::headline($status))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
