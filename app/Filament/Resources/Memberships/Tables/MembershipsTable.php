<?php

namespace App\Filament\Resources\Memberships\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MembershipsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(url('/images/placeholders/membership-placeholder.png'))
                    ->toggleable(),

                TextColumn::make('title')
                    ->label('Judul Membership')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                BadgeColumn::make('type')
                    ->label('Tipe')
                    ->colors([
                        'secondary' => 'basic',
                        'primary' => 'premium',
                        'warning' => 'vip',
                        'success' => 'platinum',
                        'danger' => 'diamond',
                    ]),

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
                    ->color('info'),

                TextColumn::make('benefits')
                    ->label('Manfaat')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return implode(', ', array_slice($state, 0, 2)) . 
                                   (count($state) > 2 ? ' (+' . (count($state) - 2) . ' lainnya)' : '');
                        }
                        return $state;
                    })
                    ->tooltip(function ($record) {
                        if (is_array($record->benefits)) {
                            return implode("\n• ", [''] + $record->benefits);
                        }
                        return $record->benefits;
                    })
                    ->limit(30),

                ColorColumn::make('badge_color')
                    ->label('Warna Badge')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_featured')
                    ->label('Unggulan')
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

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipe Membership')
                    ->options([
                        'basic' => 'Basic',
                        'premium' => 'Premium',
                        'vip' => 'VIP',
                        'platinum' => 'Platinum',
                        'diamond' => 'Diamond',
                    ]),

                SelectFilter::make('duration')
                    ->label('Durasi')
                    ->options([
                        'per bulan' => 'Per Bulan',
                        'per 3 bulan' => 'Per 3 Bulan',
                        'per 6 bulan' => 'Per 6 Bulan',
                        'per tahun' => 'Per Tahun',
                        'seumur hidup' => 'Seumur Hidup',
                    ]),

                TernaryFilter::make('is_featured')
                    ->label('Membership Unggulan'),

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
