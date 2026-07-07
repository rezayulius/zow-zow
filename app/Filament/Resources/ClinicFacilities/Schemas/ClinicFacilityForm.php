<?php

namespace App\Filament\Resources\ClinicFacilities\Schemas;

use App\Services\ImageOptimizer;
use App\Support\ReservedSlugs;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class ClinicFacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Fasilitas')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('excerpt')
                            ->label('Ringkasan Singkat')
                            ->rows(2)
                            ->helperText('Ditampilkan di card grid halaman Fasilitas')
                            ->columnSpanFull(),
                    ]),

                Section::make('Konten Detail')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),
                    ]),

                Section::make('Foto')
                    ->schema([
                        Repeater::make('images')
                            ->relationship('images')
                            ->label('Galeri Foto')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Gambar')
                                    ->image()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                                    ->disk('public')
                                    ->directory('clinic-facilities')
                                    ->visibility('public')
                                    ->saveUploadedFileUsing(fn ($component, $file) => ImageOptimizer::store($component, $file))
                                    ->required(),

                                TextInput::make('alt_text')
                                    ->label('Alt Text'),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Foto')
                            ->collapsible(),
                    ]),

                Section::make('Peralatan')
                    ->schema([
                        Repeater::make('equipment')
                            ->relationship('equipment')
                            ->label('Daftar Peralatan')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Alat')
                                    ->required(),

                                Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->rows(2),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Peralatan')
                            ->collapsible(),
                    ]),

                Section::make('FAQ')
                    ->schema([
                        Repeater::make('faqs')
                            ->relationship('faqs')
                            ->label('Pertanyaan yang Sering Diajukan')
                            ->schema([
                                TextInput::make('question')
                                    ->label('Pertanyaan')
                                    ->required()
                                    ->columnSpanFull(),

                                Textarea::make('answer')
                                    ->label('Jawaban')
                                    ->required()
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(0)
                            ->addActionLabel('Tambah FAQ')
                            ->collapsible(),
                    ]),

                Section::make('Slug & SEO')
                    ->schema([
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->rule(Rule::notIn(ReservedSlugs::LIST))
                            ->helperText('Dipakai di URL, mis. /facility/ruang-operasi. Jangan diubah setelah dipublikasikan.'),

                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(255),

                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Pengaturan')
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
