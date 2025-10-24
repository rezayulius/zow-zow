<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholders/article-placeholder.jpg'))
                    ->size(50),

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
                    })
                    ->description(fn ($record): string => Str::limit($record->excerpt, 100)),

                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'danger' => 'draft',
                        'success' => 'published',
                        'warning' => 'archived',
                    ])
                    ->icons([
                        'heroicon-o-pencil' => 'draft',
                        'heroicon-o-eye' => 'published',
                        'heroicon-o-archive-box' => 'archived',
                    ]),

                ToggleColumn::make('is_featured')
                    ->label('Unggulan')
                    ->sortable(),

                TextColumn::make('views')
                    ->label('Views')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => number_format($state)),

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
                    ->native(false),

                TernaryFilter::make('is_featured')
                    ->label('Artikel Unggulan')
                    ->placeholder('Semua artikel')
                    ->trueLabel('Hanya unggulan')
                    ->falseLabel('Bukan unggulan')
                    ->native(false),

                SelectFilter::make('author')
                    ->label('Penulis')
                    ->options(function () {
                        return \App\Models\Article::distinct()
                            ->whereNotNull('author')
                            ->pluck('author', 'author')
                            ->toArray();
                    })
                    ->searchable()
                    ->native(false),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn ($record): string => route('filament.admin.resources.articles.edit', $record)),
                Action::make('publish')
                    ->label('Publikasikan')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'published',
                            'published_at' => now(),
                        ]);
                    })
                    ->requiresConfirmation()
                    ->visible(fn ($record): bool => $record->status !== 'published'),
                Action::make('feature')
                    ->label(fn ($record): string => $record->is_featured ? 'Hapus Unggulan' : 'Jadikan Unggulan')
                    ->icon('heroicon-o-star')
                    ->color(fn ($record): string => $record->is_featured ? 'gray' : 'warning')
                    ->action(function ($record) {
                        $record->update(['is_featured' => !$record->is_featured]);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('publish')
                        ->label('Publikasikan')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update([
                                    'status' => 'published',
                                    'published_at' => now(),
                                ]);
                            });
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Publikasikan Artikel')
                        ->modalDescription('Apakah Anda yakin ingin mempublikasikan artikel yang dipilih?'),
                    
                    BulkAction::make('archive')
                        ->label('Arsipkan')
                        ->icon('heroicon-o-archive-box')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['status' => 'archived']);
                            });
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Arsipkan Artikel')
                        ->modalDescription('Apakah Anda yakin ingin mengarsipkan artikel yang dipilih?'),
                    
                    BulkAction::make('feature')
                        ->label('Jadikan Unggulan')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['is_featured' => true]);
                            });
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Jadikan Artikel Unggulan')
                        ->modalDescription('Apakah Anda yakin ingin menjadikan artikel yang dipilih sebagai unggulan?'),
                    
                    BulkAction::make('unfeature')
                        ->label('Hapus dari Unggulan')
                        ->icon('heroicon-o-star')
                        ->color('gray')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['is_featured' => false]);
                            });
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Hapus dari Artikel Unggulan')
                        ->modalDescription('Apakah Anda yakin ingin menghapus artikel yang dipilih dari unggulan?'),
                    
                    DeleteBulkAction::make()
                        ->label('Hapus'),
                ]),
            ])
            ->defaultSort('published_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
