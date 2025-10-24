<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->disk('public')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(url('/images/placeholders/default-placeholder.jpg')),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Teknologi' => 'info',
                        'Bisnis' => 'success',
                        'Ekonomi' => 'warning',
                        'Politik' => 'danger',
                        'Olahraga' => 'primary',
                        'Hiburan' => 'secondary',
                        'Kesehatan' => 'success',
                        'Pendidikan' => 'info',
                        'Lingkungan' => 'success',
                        'Internasional' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                        'danger' => 'archived',
                    ])
                    ->icons([
                        'heroicon-o-pencil' => 'draft',
                        'heroicon-o-eye' => 'published',
                        'heroicon-o-archive-box' => 'archived',
                    ]),

                BooleanColumn::make('is_featured')
                    ->label('Unggulan')
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                BooleanColumn::make('is_breaking')
                    ->label('Breaking')
                    ->trueIcon('heroicon-o-bolt')
                    ->falseIcon('heroicon-o-bolt')
                    ->trueColor('danger')
                    ->falseColor('gray'),

                TextColumn::make('views')
                    ->label('Views')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn (int $state): string => number_format($state)),

                TextColumn::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Dipublikasi',
                        'archived' => 'Diarsipkan',
                    ])
                    ->multiple(),

                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Teknologi' => 'Teknologi',
                        'Bisnis' => 'Bisnis',
                        'Ekonomi' => 'Ekonomi',
                        'Politik' => 'Politik',
                        'Olahraga' => 'Olahraga',
                        'Hiburan' => 'Hiburan',
                        'Kesehatan' => 'Kesehatan',
                        'Pendidikan' => 'Pendidikan',
                        'Lingkungan' => 'Lingkungan',
                        'Internasional' => 'Internasional',
                    ])
                    ->multiple(),

                Filter::make('is_featured')
                    ->label('Berita Unggulan')
                    ->query(fn (Builder $query): Builder => $query->where('is_featured', true)),

                Filter::make('is_breaking')
                    ->label('Breaking News')
                    ->query(fn (Builder $query): Builder => $query->where('is_breaking', true)),

                SelectFilter::make('author')
                    ->label('Penulis')
                    ->options(function () {
                        return \App\Models\News::distinct()
                            ->whereNotNull('author')
                            ->pluck('author', 'author')
                            ->toArray();
                    })
                    ->searchable(),
            ])
            ->actions([
                ViewAction::make()
                    ->label('Lihat'),
                EditAction::make()
                    ->label('Edit'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus'),
                ]),
            ])
            ->defaultSort('published_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
