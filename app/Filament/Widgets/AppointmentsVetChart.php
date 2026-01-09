<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\App;

class AppointmentsVetChart extends ChartWidget
{
    protected ?string $heading = 'Appointments by Vet';
    
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
            ->groupBy(fn($a) => ($a['vet']['first_name'] ?? '') . ' ' . ($a['vet']['last_name'] ?? ''))
            ->map(fn($group) => $group->count())
            ->sortDesc()
            ->take(10); // Top 10 vets

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $grouped->values()->toArray(),
                    'backgroundColor' => '#8b5cf6', // purple
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
