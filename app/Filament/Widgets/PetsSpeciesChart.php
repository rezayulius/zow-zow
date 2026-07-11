<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\App;

class PetsSpeciesChart extends ChartWidget
{
    protected ?string $heading = 'Species Distribution';

    protected ?string $description = 'Jumlah pasien berdasarkan spesies (anjing, kucing, dll).';

    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = 1;

    protected ?string $maxHeight = '250px';

    protected function getData(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $data = $service->getPetsReportAggregated();

        if (!$data || !isset($data['data']['statistics']['species']['breakdown'])) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $speciesData = $data['data']['statistics']['species']['breakdown'];
        
        // Sort by amount descending
        $speciesData = collect($speciesData)->sortByDesc('amount')->values();
        
        $labels = $speciesData->pluck('label')->toArray();
        $values = $speciesData->pluck('amount')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Species',
                    'data' => $values,
                    'backgroundColor' => [
                        '#3b82f6', // blue-500
                        '#ef4444', // red-500
                        '#eab308', // yellow-500
                        '#22c55e', // green-500
                        '#a855f7', // purple-500
                        '#f97316', // orange-500
                        '#ec4899', // pink-500
                        '#6366f1', // indigo-500
                        '#14b8a6', // teal-500
                        '#84cc16', // lime-500
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
