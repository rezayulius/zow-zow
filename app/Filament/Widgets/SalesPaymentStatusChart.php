<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\App;

class SalesPaymentStatusChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Payment Status';

    protected ?string $description = 'Proporsi transaksi berdasarkan status pembayaran (lunas, sebagian, belum dibayar).';

    protected static ?int $sort = 5;

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

        $grouped = $sales->groupBy(function ($s) {
            $due = (float) $s['amount_due'];
            $paid = (float) $s['amount_paid'];

            if ($due <= 0 && $paid > 0) {
                return 'Lunas';
            }

            return $paid > 0 ? 'Sebagian' : 'Belum Dibayar';
        })->map(fn ($group) => $group->count());

        return [
            'datasets' => [
                [
                    'label' => 'Transaksi',
                    'data' => $grouped->values()->toArray(),
                    'backgroundColor' => [
                        '#22c55e', '#f59e0b', '#ef4444',
                    ],
                ],
            ],
            'labels' => $grouped->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
