<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\App;

class PetsReportOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    
    // In Filament v3, pollingInterval is not static on the widget class itself in the same way
    // or it might be conflicting with parent definition.
    // We can override getPollingInterval() method instead if needed, 
    // or just use the property without static if the parent defines it non-statically.
    // Checking Filament docs, usually it is: protected static ?string $pollingInterval = '30s';
    // But error says parent is non-static. So we remove static.
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $data = $service->getPetsReportAggregated();

        if (!$data || !isset($data['data']['statistics'])) {
            return [
                Stat::make('Error', 'Failed to fetch data')
                    ->description('Could not retrieve data from Digitail')
                    ->color('danger'),
            ];
        }

        $stats = $data['data']['statistics'];
        
        // Helper to format chart data
        $getChartData = function($breakdown) {
            return collect($breakdown)->map(fn($item) => $item['amount'])->toArray();
        };

        // Species Stats
        $species = $stats['species']['breakdown'] ?? [];
        $totalPets = collect($species)->sum('amount');
        $speciesDesc = collect($species)->map(fn($s) => "{$s['label']}: {$s['amount']}")->implode(', ');

        // Breeds Stats (Top 3)
        $breeds = $stats['breeds']['breakdown'] ?? [];
        $topBreeds = collect($breeds)->sortByDesc('amount')->take(3);
        $breedsDesc = $topBreeds->map(fn($b) => "{$b['label']}: {$b['amount']}")->implode(', ');

        // Age Stats
        $age = $stats['age']['breakdown'] ?? [];
        $ageDesc = collect($age)->sortByDesc('amount')->first();
        $ageLabel = $ageDesc ? "Most: {$ageDesc['label']} ({$ageDesc['amount']})" : 'No Data';

        return [
            Stat::make('Total Pets', $totalPets)
                ->description($speciesDesc)
                ->descriptionIcon('heroicon-m-heart')
                ->chart($getChartData($species))
                ->color('primary'),

            Stat::make('Top Breeds', $topBreeds->first()['label'] ?? 'N/A')
                ->description($breedsDesc)
                ->descriptionIcon('heroicon-m-star')
                ->chart($getChartData($breeds))
                ->color('success'),

            Stat::make('Age Distribution', 'Demographics')
                ->description($ageLabel)
                ->descriptionIcon('heroicon-m-chart-bar')
                ->chart($getChartData($age))
                ->color('warning'),
        ];
    }
}
