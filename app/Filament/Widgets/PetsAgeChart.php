<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\App;

class PetsAgeChart extends ChartWidget
{
    protected ?string $heading = 'Age Distribution';

    protected ?string $description = 'Jumlah pasien berdasarkan kelompok umur.';

    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = 1;
    
    protected ?string $maxHeight = '250px';

    protected function getData(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $data = $service->getPetsReportAggregated();

        if (!$data || !isset($data['data']['statistics']['age']['breakdown'])) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $ageData = $data['data']['statistics']['age']['breakdown'];
        
        // Ensure consistent ordering if needed, or trust API
        // Typically age ranges might be "0-1", "1-3", etc. 
        // We might want to keep original order if it's already logical, or sort by label logic.
        // For now, let's use the API order.
        $ageData = collect($ageData);
        
        $labels = $ageData->pluck('label')->toArray();
        $values = $ageData->pluck('amount')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Pets by Age',
                    'data' => $values,
                    'fill' => true,
                    'borderColor' => '#8b5cf6', // purple-500
                    'backgroundColor' => 'rgba(139, 92, 246, 0.1)', // purple-500 with opacity
                    'tension' => 0.4, // Smooth curve
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
