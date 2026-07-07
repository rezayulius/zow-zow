<?php

namespace App\Filament\Resources\ClinicFacilities\Pages;

use App\Filament\Resources\ClinicFacilities\ClinicFacilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditClinicFacility extends EditRecord
{
    use Translatable;

    protected static string $resource = ClinicFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            DeleteAction::make(),
        ];
    }
}
