<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class PetParentsGrowthChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'New Pet Parents per Month';

    protected ?string $description = 'Tren jumlah pet parent baru bergabung setiap bulan.';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 1;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getPetParents(1, 250);
        $petParents = collect($response['data'] ?? []);

        // This endpoint has no created_at filter (only updated_at), so the
        // date range from the dashboard filter is applied here client-side.
        $startDate = $this->pageFilters['start_date'] ?? null;
        $endDate = $this->pageFilters['end_date'] ?? null;

        if ($startDate && $endDate) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            $petParents = $petParents->filter(
                fn ($p) => Carbon::parse($p['created_at'])->between($start, $end)
            );
        }

        if ($petParents->isEmpty()) {
            return ['datasets' => [], 'labels' => []];
        }

        $grouped = $petParents
            ->groupBy(fn ($p) => Carbon::parse($p['created_at'])->format('Y-m'))
            ->map(fn ($group) => $group->count())
            ->sortKeys();

        return [
            'datasets' => [
                [
                    'label' => 'New Pet Parents',
                    'data' => $grouped->values()->toArray(),
                    'borderColor' => '#ec4899',
                    'backgroundColor' => 'rgba(236, 72, 153, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $grouped->keys()->map(fn ($month) => Carbon::createFromFormat('Y-m', $month)->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
