<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholders/avatar.png'))
                    ->size(40),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('company')
                    ->label('Perusahaan')
                    ->searchable()
                    ->limit(25)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 25) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('content')
                    ->label('Testimonial')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn (string $state): string => str_repeat('★', (int) $state) . str_repeat('☆', 5 - (int) $state))
                    ->sortable(),

                TextColumn::make('pet_name')
                    ->label('Nama Hewan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('pet_type')
                    ->label('Jenis Hewan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'anjing' => 'success',
                        'kucing' => 'warning',
                        'burung' => 'info',
                        'hamster' => 'gray',
                        'kelinci' => 'primary',
                        'ikan' => 'blue',
                        'reptil' => 'green',
                        default => 'secondary',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

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
                SelectFilter::make('rating')
                    ->label('Rating')
                    ->options([
                        1 => '1 Bintang',
                        2 => '2 Bintang',
                        3 => '3 Bintang',
                        4 => '4 Bintang',
                        5 => '5 Bintang',
                    ]),

                SelectFilter::make('pet_type')
                    ->label('Jenis Hewan')
                    ->options([
                        'anjing' => 'Anjing',
                        'kucing' => 'Kucing',
                        'burung' => 'Burung',
                        'hamster' => 'Hamster',
                        'kelinci' => 'Kelinci',
                        'ikan' => 'Ikan',
                        'reptil' => 'Reptil',
                        'lainnya' => 'Lainnya',
                    ]),

                TernaryFilter::make('is_featured')
                    ->label('Testimonial Unggulan'),

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
