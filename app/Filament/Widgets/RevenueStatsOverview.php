<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Number;

class RevenueStatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected ?string $heading = 'Ringkasan Pendapatan';

    protected ?string $description = 'Total revenue, piutang belum terbayar, rata-rata transaksi, dan jumlah transaksi.';

    protected function getStats(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getSales(1, 250, $this->pageFilters['start_date'] ?? null, $this->pageFilters['end_date'] ?? null);
        $sales = collect($response['data'] ?? []);

        if ($sales->isEmpty()) {
            return [Stat::make('No Data', '0')];
        }

        $totalRevenue = $sales->sum(fn ($s) => (float) $s['total']);
        $outstanding = $sales->sum(fn ($s) => (float) $s['amount_due']);
        $avgTransaction = $sales->count() > 0 ? $totalRevenue / $sales->count() : 0;

        return [
            Stat::make('Total Revenue', 'Rp ' . Number::format($totalRevenue, locale: 'id'))
                ->description('Sesuai rentang tanggal terpilih')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Outstanding (Piutang)', 'Rp ' . Number::format($outstanding, locale: 'id'))
                ->description('Belum dibayar penuh')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color($outstanding > 0 ? 'danger' : 'success'),

            Stat::make('Avg Transaction', 'Rp ' . Number::format($avgTransaction, locale: 'id'))
                ->description('Rata-rata per transaksi')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('primary'),

            Stat::make('Total Transactions', $sales->count())
                ->description('Dalam rentang tanggal terpilih')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('info'),
        ];
    }
}
