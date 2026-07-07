<?php

namespace App\Filament\Resources\ClinicServices\Pages;

use App\Filament\Resources\ClinicServices\ClinicServiceResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateClinicService extends CreateRecord
{
    use Translatable;

    protected static string $resource = ClinicServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    // "vet_ids" (CheckboxList) has no matching column — Digitail vets aren't a
    // local Eloquent relation, just a cached API array — so it can't be saved
    // via a normal ->relationship() field. Sync the clinic_service_vets pivot
    // manually once the record exists.
    protected function afterCreate(): void
    {
        $vetIds = $this->form->getState()['vet_ids'] ?? [];

        foreach (array_values($vetIds) as $index => $vetId) {
            $this->record->vets()->create([
                'digitail_vet_id' => $vetId,
                'sort_order' => $index,
            ]);
        }
    }
}
