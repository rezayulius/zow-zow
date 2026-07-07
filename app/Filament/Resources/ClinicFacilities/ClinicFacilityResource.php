<?php

namespace App\Filament\Resources\ClinicFacilities;

use App\Filament\Resources\ClinicFacilities\Pages\CreateClinicFacility;
use App\Filament\Resources\ClinicFacilities\Pages\EditClinicFacility;
use App\Filament\Resources\ClinicFacilities\Pages\ListClinicFacilities;
use App\Filament\Resources\ClinicFacilities\Schemas\ClinicFacilityForm;
use App\Filament\Resources\ClinicFacilities\Tables\ClinicFacilitiesTable;
use App\Models\ClinicFacility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class ClinicFacilityResource extends Resource
{
    use Translatable;

    protected static ?string $model = ClinicFacility::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static UnitEnum|string|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Fasilitas Klinik';

    public static function form(Schema $schema): Schema
    {
        return ClinicFacilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClinicFacilitiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClinicFacilities::route('/'),
            'create' => CreateClinicFacility::route('/create'),
            'edit' => EditClinicFacility::route('/{record}/edit'),
        ];
    }
}
