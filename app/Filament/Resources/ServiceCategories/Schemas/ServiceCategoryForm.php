<?php

namespace App\Filament\Resources\ServiceCategories\Schemas;

use App\Filament\Support\IconOptions;
use App\Services\ImageOptimizer;
use App\Support\ReservedSlugs;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class ServiceCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kategori')
                    ->description('Kategori layanan yang tampil di mega-menu Services, mis. Health, Wellness')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->rule(Rule::notIn(ReservedSlugs::LIST))
                            ->helperText('Dipakai di URL, mis. "health" -> /health. Tidak bisa diubah sembarangan setelah dipublikasikan karena mempengaruhi link yang sudah dibagikan.'),

                        Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Media & Icon')
                    ->schema([
                        Select::make('icon')
                            ->label('Icon')
                            ->options(IconOptions::forServices())
                            ->searchable(),

                        FileUpload::make('image')
                            ->label('Gambar Kategori')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('service-categories')
                            ->visibility('public')
                            ->saveUploadedFileUsing(fn ($component, $file) => ImageOptimizer::store($component, $file)),
                    ])
                    ->columns(2),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(255),

                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(2),
                    ])
                    ->columns(2),

                Section::make('Pengaturan Tampilan')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
}
