<?php

namespace App\Filament\Resources\ClinicServices;

use App\Filament\Resources\ClinicServices\Pages\CreateClinicService;
use App\Filament\Resources\ClinicServices\Pages\EditClinicService;
use App\Filament\Resources\ClinicServices\Pages\ListClinicServices;
use App\Filament\Resources\ClinicServices\Schemas\ClinicServiceForm;
use App\Filament\Resources\ClinicServices\Tables\ClinicServicesTable;
use App\Models\ClinicService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class ClinicServiceResource extends Resource
{
    use Translatable;

    protected static ?string $model = ClinicService::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static UnitEnum|string|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return ClinicServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClinicServicesTable::configure($table);
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
            'index' => ListClinicServices::route('/'),
            'create' => CreateClinicService::route('/create'),
            'edit' => EditClinicService::route('/{record}/edit'),
        ];
    }
}
