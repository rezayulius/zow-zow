<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditArticle extends EditRecord
{
    use Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Action::make('publish')
                ->label('Publikasikan')
                ->icon('heroicon-o-eye')
                ->color('success')
                ->action(function () {
                    $this->record->update([
                        'status' => 'published',
                        'published_at' => now(),
                    ]);
                    
                    Notification::make()
                        ->success()
                        ->title('Artikel dipublikasikan')
                        ->body('Artikel telah berhasil dipublikasikan.')
                        ->send();
                })
                ->requiresConfirmation()
                ->visible(fn (): bool => $this->record->status !== 'published'),
            
            Action::make('feature')
                ->label(fn (): string => $this->record->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan')
                ->icon('heroicon-o-star')
                ->color(fn (): string => $this->record->is_featured ? 'gray' : 'warning')
                ->action(function () {
                    $this->record->update(['is_featured' => !$this->record->is_featured]);
                    
                    $message = $this->record->is_featured ? 'dijadikan unggulan' : 'dihapus dari unggulan';
                    
                    Notification::make()
                        ->success()
                        ->title('Status unggulan diperbarui')
                        ->body("Artikel telah {$message}.")
                        ->send();
                }),
            
            DeleteAction::make(),
        ];
    }
    
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Artikel berhasil diperbarui')
            ->body('Perubahan artikel telah berhasil disimpan.');
    }
}
