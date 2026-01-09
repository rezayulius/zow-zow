<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\App;

class AppointmentsClinicChart extends ChartWidget
{
    protected ?string $heading = 'Appointments by Clinic';
    
    protected static ?int $sort = 3;
    
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
            ->groupBy(fn($a) => $a['clinic']['name'] ?? 'Unknown Clinic')
            ->map(fn($group) => $group->count())
            ->sortDesc();

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $grouped->values()->toArray(),
                    'backgroundColor' => '#10b981', // emerald
                ],
            ],
            'labels' => $grouped->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
