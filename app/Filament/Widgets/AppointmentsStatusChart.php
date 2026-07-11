<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\App;

class AppointmentsStatusChart extends ChartWidget
{
    protected ?string $heading = 'Appointments by Visit Type';

    protected ?string $description = 'Jumlah appointment per jenis kunjungan (visit type).';

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

        $categoryCounts = $appointments
            ->groupBy(fn($item) => $item['visit_type']['category_label'] ?? $item['service']['label'] ?? 'General')
            ->map(fn ($group) => $group->count());

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $categoryCounts->values()->toArray(),
                    'backgroundColor' => [
                        '#3b82f6', '#a855f7', '#ec4899', '#14b8a6', '#f59e0b', '#ef4444',
                    ],
                ],
            ],
            'labels' => $categoryCounts->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
