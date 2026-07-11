<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('role')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'executive' => 'warning',
                        'user' => 'info',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->label('Verified')
                    ->badge()
                    ->color(fn($record) => $record->email_verified_at ? 'success' : 'warning')
                    ->getStateUsing(fn($record) => $record->email_verified_at ? 'Yes' : 'No')
                    ->sortable(),
                TextColumn::make('otp_status')
                    ->label('OTP Status')
                    ->badge()
                    ->getStateUsing(fn(\App\Models\User $record): string => $record->otpVerifications()->whereNotNull('verified_at')->exists() ? 'Verified' : 'Not Verified')
                    ->color(fn(string $state): string => $state === 'Verified' ? 'success' : 'danger'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function (DeleteBulkAction $action, Collection $records) {
                            $adminsBeingDeleted = $records->where('role', 'admin')->count();
                            $totalAdmins = User::where('role', 'admin')->count();

                            if ($adminsBeingDeleted > 0 && $adminsBeingDeleted >= $totalAdmins) {
                                Notification::make()
                                    ->title('Cannot delete all admin accounts')
                                    ->body('At least one admin account must remain so the panel stays accessible.')
                                    ->danger()
                                    ->send();

                                $action->halt();
                            }
                        }),
                ]),
            ]);
    }
}
