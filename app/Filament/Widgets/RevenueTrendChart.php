<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class RevenueTrendChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Revenue Trend';

    protected ?string $description = 'Tren pendapatan harian dari transaksi penjualan.';

    protected static ?int $sort = 2;

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

        $grouped = $sales
            ->groupBy(fn ($s) => Carbon::parse($s['closed_at'] ?? $s['created_at'])->format('Y-m-d'))
            ->map(fn ($group) => $group->sum(fn ($s) => (float) $s['total']))
            ->sortKeys();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $grouped->values()->toArray(),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $grouped->keys()->map(fn ($date) => Carbon::parse($date)->format('M d'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
