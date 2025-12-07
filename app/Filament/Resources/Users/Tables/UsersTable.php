<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    ->color(fn(\App\Models\User $record): string => $record->otpVerifications()->whereNotNull('verified_at')->exists() ? 'success' : 'danger')
                    ->getStateUsing(fn(\App\Models\User $record): string => $record->otpVerifications()->whereNotNull('verified_at')->exists() ? 'Verified' : 'Not Verified'),
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
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
