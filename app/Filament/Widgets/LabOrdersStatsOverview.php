<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\App;

class LabOrdersStatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 4;

    protected ?string $heading = 'Ringkasan Lab Order';

    protected ?string $description = 'Total order laboratorium, pending, selesai, dan partner lab utama.';

    protected function getStats(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getLabOrders();
        $orders = collect($response['data'] ?? []);

        // This endpoint has no date filter, so the dashboard's date range is
        // applied here client-side against created_at.
        $startDate = $this->pageFilters['start_date'] ?? null;
        $endDate = $this->pageFilters['end_date'] ?? null;

        if ($startDate && $endDate) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            $orders = $orders->filter(
                fn ($o) => Carbon::parse($o['created_at'])->between($start, $end)
            );
        }

        if ($orders->isEmpty()) {
            return [Stat::make('No Data', '0')];
        }

        $pending = $orders->where('status', 'pending')->count();
        $completed = $orders->where('status', 'completed')->count();
        $topLab = $orders->countBy('lab.name')->sortDesc()->keys()->first();

        return [
            Stat::make('Total Lab Orders', $orders->count())
                ->descriptionIcon('heroicon-m-beaker')
                ->color('primary'),

            Stat::make('Pending', $pending)
                ->description('Belum ada hasil')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pending > 0 ? 'warning' : 'success'),

            Stat::make('Completed', $completed)
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Top Lab Partner', $topLab ?? '-')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info'),
        ];
    }
}
