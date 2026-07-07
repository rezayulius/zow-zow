<?php

namespace App\Filament\Resources\ClinicServices\Pages;

use App\Filament\Resources\ClinicServices\ClinicServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditClinicService extends EditRecord
{
    use Translatable;

    protected static string $resource = ClinicServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            DeleteAction::make(),
        ];
    }

    // "vet_ids" (CheckboxList) has no matching column, so it isn't filled from
    // the record automatically — seed it once from the clinic_service_vets
    // pivot when the form is first loaded. (Using the field's afterStateHydrated
    // callback instead would re-run on every schema state resolution — including
    // after the user unchecks everything — and stomp the in-progress edit back
    // to the record's saved value before it's persisted.)
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['vet_ids'] = $this->record->vets()->pluck('digitail_vet_id')->toArray();

        return $data;
    }

    // See CreateClinicService::afterCreate() for why "vet_ids" needs manual
    // pivot syncing instead of a ->relationship() field.
    protected function afterSave(): void
    {
        $vetIds = $this->form->getState()['vet_ids'] ?? [];

        $this->record->vets()->delete();

        foreach (array_values($vetIds) as $index => $vetId) {
            $this->record->vets()->create([
                'digitail_vet_id' => $vetId,
                'sort_order' => $index,
            ]);
        }
    }
}
