<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\App;

class TopServicesChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Top Services/Products by Revenue';

    protected ?string $description = '10 layanan/produk dengan kontribusi pendapatan terbesar.';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getSales(1, 250, $this->pageFilters['start_date'] ?? null, $this->pageFilters['end_date'] ?? null);
        $sales = collect($response['data'] ?? []);

        $treatments = $sales->flatMap(fn ($s) => $s['treatments'] ?? []);

        if ($treatments->isEmpty()) {
            return ['datasets' => [], 'labels' => []];
        }

        $grouped = $treatments
            ->groupBy(fn ($t) => $t['product_name'] ?? $t['label'] ?? 'Unknown')
            ->map(fn ($group) => $group->sum(fn ($t) => (float) ($t['total_price'] ?? 0)))
            ->sortDesc()
            ->take(10);

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $grouped->values()->toArray(),
                    'backgroundColor' => '#3b82f6',
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
