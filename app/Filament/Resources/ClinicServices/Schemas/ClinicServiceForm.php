<?php

namespace App\Filament\Resources\ClinicServices\Schemas;

use App\Models\ServiceCategory;
use App\Services\DigitailService;
use App\Services\ImageOptimizer;
use App\Support\ReservedSlugs;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class ClinicServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar')
                    ->schema([
                        Select::make('service_category_id')
                            ->label('Kategori')
                            ->required()
                            ->options(fn () => ServiceCategory::active()->ordered()->get()
                                ->mapWithKeys(fn (ServiceCategory $category) => [$category->id => $category->name]))
                            ->searchable(),

                        TextInput::make('name')
                            ->label('Nama Layanan')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('excerpt')
                            ->label('Ringkasan Singkat')
                            ->rows(2)
                            ->helperText('Ditampilkan di mega-menu dan card grid kategori')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Konten Detail')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),
                    ]),

                Section::make('Lokasi & Jam Buka')
                    ->schema([
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->helperText('Kosongkan untuk memakai alamat klinik default')
                            ->columnSpanFull(),

                        KeyValue::make('operating_hours')
                            ->label('Jam Buka')
                            ->keyLabel('Hari')
                            ->valueLabel('Jam')
                            ->helperText('Kosongkan untuk memakai jam operasional klinik default')
                            ->columnSpanFull(),
                    ]),

                Section::make('Call To Action')
                    ->schema([
                        TextInput::make('whatsapp_message')
                            ->label('Teks Prefilled WhatsApp')
                            ->maxLength(500)
                            ->helperText('Contoh: Halo, saya ingin tanya soal layanan Vaksinasi'),

                        TextInput::make('booking_cta_url')
                            ->label('URL Booking (opsional)')
                            ->url()
                            ->helperText('Kosongkan untuk mengarah ke section Booking di homepage'),
                    ])
                    ->columns(2),

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
                                    ->directory('clinic-services')
                                    ->visibility('public')
                                    ->saveUploadedFileUsing(fn ($component, $file) => ImageOptimizer::store($component, $file))
                                    ->required(),

                                Select::make('type')
                                    ->label('Tipe')
                                    ->options([
                                        'service' => 'Foto Layanan',
                                        'clinic' => 'Foto Klinik',
                                    ])
                                    ->default('service')
                                    ->required(),

                                TextInput::make('alt_text')
                                    ->label('Alt Text'),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Foto')
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

                Section::make('Dokter yang Menangani')
                    ->schema([
                        CheckboxList::make('vet_ids')
                            ->label('Pilih Dokter')
                            ->options(fn () => collect(app(DigitailService::class)->getVets())
                                ->mapWithKeys(fn ($vet) => [
                                    (string) ($vet['id'] ?? '') => $vet['name_with_title']
                                        ?? $vet['full_name']
                                        ?? ('Dokter #' . ($vet['id'] ?? '?')),
                                ])
                                ->filter(fn ($label, $id) => $id !== '')
                                ->toArray())
                            ->columns(2)
                            ->helperText('Data dokter diambil dari cache Digitail (refresh tiap 60 menit).'),
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
                            ->helperText('Dipakai di URL, mis. /health/vaccination. Jangan diubah setelah dipublikasikan.'),

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
