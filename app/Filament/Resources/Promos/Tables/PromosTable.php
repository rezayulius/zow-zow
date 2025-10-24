<?php

namespace App\Filament\Resources\Promos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PromosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->circular()
                    ->size(50),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('promo_code')
                    ->label('Kode Promo')
                    ->searchable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('discount_type')
                    ->label('Tipe Diskon')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'percentage' => 'success',
                        'fixed' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'percentage' => 'Persentase',
                        'fixed' => 'Nominal',
                    }),

                TextColumn::make('discount_value')
                    ->label('Nilai Diskon')
                    ->formatStateUsing(function ($record) {
                        if ($record->discount_type === 'percentage') {
                            return $record->discount_value . '%';
                        }
                        return 'Rp ' . number_format($record->discount_value, 0, ',', '.');
                    }),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('Berakhir')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),

                ToggleColumn::make('is_featured')
                    ->label('Unggulan'),

                TextColumn::make('used_count')
                    ->label('Digunakan')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
