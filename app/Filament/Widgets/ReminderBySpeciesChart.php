<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\App;

class ReminderBySpeciesChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Reminder Volume by Species';

    protected ?string $description = 'Total reminder vaksin/perawatan berdasarkan spesies hewan.';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getReminderProtocolUsages(1, 250, $this->pageFilters['start_date'] ?? null, $this->pageFilters['end_date'] ?? null);
        $reminders = collect($response['data'] ?? []);

        if ($reminders->isEmpty()) {
            return ['datasets' => [], 'labels' => []];
        }

        $species = $service->getSpecies();

        $grouped = $reminders
            ->groupBy(fn ($r) => $species[$r['pet']['species_id'] ?? null] ?? 'Unknown')
            ->map(fn ($group) => $group->count())
            ->sortDesc();

        return [
            'datasets' => [
                [
                    'label' => 'Reminders',
                    'data' => $grouped->values()->toArray(),
                    'backgroundColor' => [
                        '#f59e0b', '#3b82f6', '#22c55e', '#ec4899', '#a855f7', '#14b8a6',
                    ],
                ],
            ],
            'labels' => $grouped->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
