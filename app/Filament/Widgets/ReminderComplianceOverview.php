<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class ReminderComplianceOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 2;

    protected ?string $heading = 'Kepatuhan Reminder';

    protected ?string $description = 'Reminder vaksin/perawatan yang overdue, pending, dan sudah diberikan (compliance rate).';

    protected function getStats(): array
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getReminderProtocolUsages(1, 250, $this->pageFilters['start_date'] ?? null, $this->pageFilters['end_date'] ?? null);
        $reminders = collect($response['data'] ?? []);

        if ($reminders->isEmpty()) {
            return [Stat::make('No Data', '0')];
        }

        $today = Carbon::today();

        // The API has no reliable "overdue" filter (its `active` filter still
        // returns already-administered records) — pending vs overdue has to be
        // derived here from administration_date being null.
        $pending = $reminders->whereNull('administration_date');
        $overdue = $pending->filter(fn ($r) => Carbon::parse($r['due_date'])->lt($today));
        $administered = $reminders->whereNotNull('administration_date')->count();
        $complianceRate = $reminders->count() > 0 ? round(($administered / $reminders->count()) * 100, 1) : 0;

        return [
            Stat::make('Total Reminders', $reminders->count())
                ->descriptionIcon('heroicon-m-bell-alert')
                ->color('primary'),

            Stat::make('Overdue (Belum Diberikan)', $overdue->count())
                ->description('Due date lewat, belum administrasi')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($overdue->count() > 0 ? 'danger' : 'success'),

            Stat::make('Pending (Belum Jatuh Tempo)', $pending->count() - $overdue->count())
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Compliance Rate', $complianceRate . '%')
                ->description($administered . ' sudah diberikan')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
