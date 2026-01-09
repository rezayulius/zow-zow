<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class AppointmentsPerDayChart extends ChartWidget
{
    protected ?string $heading = 'Appointments per Day';
    
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = 1;
    
    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getAppointments(1, 100); 
        $appointments = collect($response['data'] ?? []);

        if ($appointments->isEmpty()) {
            return ['datasets' => [], 'labels' => []];
        }

        $grouped = $appointments
            ->groupBy(fn($a) => Carbon::parse($a['datetime_start_utc'])->format('Y-m-d'))
            ->map(fn($group) => $group->count())
            ->sortKeys();

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $grouped->values()->toArray(),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $grouped->keys()->map(fn($date) => Carbon::parse($date)->format('M d'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
