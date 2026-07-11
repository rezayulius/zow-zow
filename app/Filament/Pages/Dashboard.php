<?php

namespace App\Filament\Pages;

use App\Filament\Widgets;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    // ZOW: kept in English on purpose, not run through the id/ lang file
    // ("Dasbor") that the rest of the admin panel uses.
    public static function getNavigationLabel(): string
    {
        return 'Dashboard';
    }

    public function getTitle(): string
    {
        return 'Dashboard';
    }

    /**
     * @return array{start_date: string, end_date: string}
     */
    protected function getDefaultFilters(): array
    {
        return [
            'start_date' => now()->startOfMonth()->toDateString(),
            'end_date' => now()->toDateString(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('resetFilters')
                ->label('Reset Filter')
                ->icon(Heroicon::ArrowPath)
                ->color('gray')
                ->action(function () {
                    $this->filters = $this->getDefaultFilters();
                    $this->getFiltersForm()->fill($this->filters);
                }),
        ];
    }

    public function filtersForm(Schema $schema): Schema
    {
        $defaults = $this->getDefaultFilters();

        return $schema
            ->columns(2)
            ->components([
                DatePicker::make('start_date')
                    ->label('Dari Tanggal')
                    ->native(false)
                    ->live()
                    ->default($defaults['start_date']),
                DatePicker::make('end_date')
                    ->label('Sampai Tanggal')
                    ->native(false)
                    ->live()
                    ->default($defaults['end_date']),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFiltersFormContentComponent(),
                View::make('filament.dashboard.loading-indicator'),
                Tabs::make('Dashboard')
                    ->contained(false)
                    ->tabs([
                        Tab::make('Operasional')
                            ->icon(Heroicon::CalendarDays)
                            ->schema([
                                Grid::make(2)->schema(
                                    $this->getWidgetsSchemaComponents([
                                        Widgets\AppointmentsStatsOverview::class,
                                        Widgets\AppointmentsStatusBreakdownChart::class,
                                        Widgets\AppointmentsClinicChart::class,
                                        Widgets\AppointmentsVetChart::class,
                                        Widgets\AppointmentsPerDayChart::class,
                                        Widgets\LatestAppointments::class,
                                    ])
                                ),
                            ]),
                        Tab::make('Klinis')
                            ->icon(Heroicon::Beaker)
                            ->schema([
                                Grid::make(2)->schema(
                                    $this->getWidgetsSchemaComponents([
                                        Widgets\PetsReportOverview::class,
                                        Widgets\LabOrdersStatsOverview::class,
                                        Widgets\PetsSpeciesChart::class,
                                        Widgets\PetsAgeChart::class,
                                    ])
                                ),
                            ]),
                        Tab::make('CRM')
                            ->icon(Heroicon::Users)
                            ->schema([
                                Grid::make(2)->schema(
                                    $this->getWidgetsSchemaComponents([
                                        Widgets\ReminderComplianceOverview::class,
                                        Widgets\ReminderBySpeciesChart::class,
                                    ])
                                ),
                            ]),
                    ]),
            ]);
    }
}
