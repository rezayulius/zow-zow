<?php

namespace App\Filament\Resources\ClinicFacilities\Pages;

use App\Filament\Resources\ClinicFacilities\ClinicFacilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListClinicFacilities extends ListRecords
{
    use Translatable;

    protected static string $resource = ClinicFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
