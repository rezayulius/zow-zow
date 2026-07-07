<?php

namespace App\Filament\Resources\ClinicFacilities\Pages;

use App\Filament\Resources\ClinicFacilities\ClinicFacilityResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateClinicFacility extends CreateRecord
{
    use Translatable;

    protected static string $resource = ClinicFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
