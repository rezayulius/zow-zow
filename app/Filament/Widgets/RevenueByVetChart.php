<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\App;

class RevenueByVetChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Revenue by Vet';

    protected ?string $description = 'Kontribusi pendapatan per dokter.';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getSales(1, 250, $this->pageFilters['start_date'] ?? null, $this->pageFilters['end_date'] ?? null);
        $sales = collect($response['data'] ?? []);

        if ($sales->isEmpty()) {
            return ['datasets' => [], 'labels' => []];
        }

        $vets = collect($service->getVets())->keyBy('id');

        $grouped = $sales
            ->groupBy('vet_id')
            ->map(fn ($group) => $group->sum(fn ($s) => (float) $s['total']))
            ->sortDesc()
            ->take(10);

        $labels = $grouped->keys()->map(fn ($vetId) => $vets->get($vetId)['full_name'] ?? "Vet #{$vetId}");

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $grouped->values()->toArray(),
                    'backgroundColor' => '#8b5cf6',
                ],
            ],
            'labels' => $labels->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
