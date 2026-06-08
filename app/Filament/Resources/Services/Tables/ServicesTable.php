<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(url('/images/placeholders/default-placeholder.jpg')),

                TextColumn::make('title')
                    ->label('Nama Service')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->formatStateUsing(function ($record) {
                        // Show Digitail name if available, otherwise show title
                        return $record->name ?? $record->title;
                    }),

                BadgeColumn::make('digitail_id')
                    ->label('Source')
                    ->formatStateUsing(function ($state) {
                        return $state ? 'Digitail' : 'Local';
                    })
                    ->colors([
                        'success' => fn ($state): bool => (bool) $state,
                        'gray' => fn ($state): bool => !$state,
                    ])
                    ->sortable(),

                BadgeColumn::make('category')
                    ->label('Kategori')
                    ->colors([
                        'success' => 'Wellness',
                        'primary' => 'Health',
                    ])
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('features')
                    ->label('Fitur')
                    ->formatStateUsing(function ($state) {
                        if (empty($state)) {
                            return '-';
                        }
                        return is_array($state) ? implode(', ', $state) : $state;
                    })
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (empty($state)) {
                            return null;
                        }
                        $formatted = is_array($state) ? implode(', ', $state) : $state;
                        if (strlen($formatted) <= 30) {
                            return null;
                        }
                        return $formatted;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('icon')
                    ->label('Icon')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->placeholder('Gratis'),

                TextColumn::make('unit_price')
                    ->label('Unit Price')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('-'),

                TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('-'),

                BadgeColumn::make('status')
                    ->label('Digitail Status')
                    ->colors([
                        'success' => 'enabled',
                        'danger' => 'disabled',
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Wellness' => 'Wellness',
                        'Health' => 'Health',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->placeholder('Semua Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),

                TernaryFilter::make('digitail_id')
                    ->label('Sumber Data')
                    ->placeholder('Semua Sumber')
                    ->trueLabel('Digitail')
                    ->falseLabel('Lokal')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('digitail_id'),
                        false: fn ($query) => $query->whereNull('digitail_id'),
                    ),

                SelectFilter::make('status')
                    ->label('Status Digitail')
                    ->options([
                        'enabled' => 'Enabled',
                        'disabled' => 'Disabled',
                    ])
                    ->query(function ($query, $data) {
                        if ($data['value']) {
                            return $query->where('status', $data['value']);
                        }
                        return $query;
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('activate')
                        ->label('Aktifkan yang dipilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => true])),
                    BulkAction::make('deactivate')
                        ->label('Nonaktifkan yang dipilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
    }
}
