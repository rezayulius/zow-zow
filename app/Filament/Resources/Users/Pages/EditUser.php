<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->before(function (DeleteAction $action) {
                    if ($this->wouldRemoveLastAdmin($this->record, null)) {
                        Notification::make()
                            ->title('Cannot delete the last admin')
                            ->body('At least one admin account must remain so the panel stays accessible.')
                            ->danger()
                            ->send();

                        $action->halt();
                    }
                }),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->wouldRemoveLastAdmin($this->record, $data['role'] ?? null)) {
            Notification::make()
                ->title('Cannot change this role')
                ->body('This is the last admin account; demoting it would lock everyone out of the panel.')
                ->danger()
                ->send();

            $this->halt();
        }

        return $data;
    }

    private function wouldRemoveLastAdmin(User $record, ?string $newRole): bool
    {
        if ($record->role !== 'admin') {
            return false;
        }

        if ($newRole === 'admin') {
            return false;
        }

        return User::where('role', 'admin')->count() <= 1;
    }
}
