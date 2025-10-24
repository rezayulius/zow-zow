<?php

namespace App\Filament\Resources\Pricings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PricingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Paket')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

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

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),

                BadgeColumn::make('duration')
                    ->label('Durasi')
                    ->color('primary'),

                TextColumn::make('features')
                    ->label('Fitur')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return implode(', ', array_slice($state, 0, 2)) . 
                                   (count($state) > 2 ? ' (+' . (count($state) - 2) . ' lainnya)' : '');
                        }
                        return $state;
                    })
                    ->tooltip(function ($record) {
                        if (is_array($record->features)) {
                            return implode("\n• ", [''] + $record->features);
                        }
                        return $record->features;
                    })
                    ->limit(30),

                IconColumn::make('is_popular')
                    ->label('Populer')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger'),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('button_text')
                    ->label('Teks Tombol')
                    ->badge()
                    ->color('info')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('duration')
                    ->label('Durasi')
                    ->options([
                        'per hari' => 'Per Hari',
                        'per minggu' => 'Per Minggu',
                        'per bulan' => 'Per Bulan',
                        'per tahun' => 'Per Tahun',
                        'sekali bayar' => 'Sekali Bayar',
                    ]),

                TernaryFilter::make('is_popular')
                    ->label('Paket Populer'),

                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
    }
}
