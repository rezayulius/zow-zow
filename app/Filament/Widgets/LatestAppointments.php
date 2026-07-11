<?php

namespace App\Filament\Widgets;

use App\Services\DigitailService;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\App;
use App\Models\User;

class LatestAppointments extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Latest Appointments';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->description('Daftar appointment terbaru beserta status dan dokter penanggung jawab.')
            ->query(
                User::query()->whereRaw('1 = 0')
            )
            ->columns([
                Tables\Columns\TextColumn::make('datetime_start_utc')
                    ->label('Date')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('pet.nickname')
                    ->label('Pet')
                    ->searchable(),

                Tables\Columns\TextColumn::make('service.label')
                    ->label('Service')
                    ->badge(),

                Tables\Columns\TextColumn::make('vet.full_name')
                    ->label('Vet')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('clinic.name')
                    ->label('Clinic'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'tentative', 'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
            ])
            ->defaultSort('datetime_start_utc', 'desc')
            ->striped()
            ->paginated(false);
    }

    public function getTableRecords(): \Illuminate\Support\Collection
    {
        /** @var DigitailService $service */
        $service = App::make(DigitailService::class);
        $response = $service->getAppointments(1, 5, $this->pageFilters['start_date'] ?? null, $this->pageFilters['end_date'] ?? null);
        $records = $response['data'] ?? [];

        // Transform data to match user's expected column fields
        $records = array_map(function ($record) {
            // Ensure vet.full_name exists for the column mapping
            if (isset($record['vet'])) {
                $firstName = $record['vet']['first_name'] ?? '';
                $lastName = $record['vet']['last_name'] ?? '';
                $record['vet']['full_name'] = trim("$firstName $lastName");
            } else {
                $record['vet'] = ['full_name' => null];
            }
            
            // Ensure ID exists for Filament table keys
            if (!isset($record['id'])) {
                // Generate a stable ID based on content to satisfy Livewire
                $record['id'] = 'appt_' . md5(json_encode($record));
            }

            // Filament v5 identifies array-backed table rows via '__key'
            // (Filament\Support\ArrayRecord::getKeyName()), not 'id'.
            $record['__key'] = $record['id'];

            return $record;
        }, $records);

        return collect($records);
    }
}

