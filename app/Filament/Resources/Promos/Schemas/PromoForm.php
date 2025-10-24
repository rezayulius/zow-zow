<?php

namespace App\Filament\Resources\Promos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PromoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Promo')
                    ->description('Informasi dasar promo')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Promo')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash'])
                            ->helperText('URL-friendly version dari judul'),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->columnSpanFull()
                            ->rows(4)
                            ->helperText('Deskripsi lengkap promo'),
                    ]),

                Section::make('Detail Diskon')
                    ->description('Pengaturan diskon dan kode promo')
                    ->schema([
                        TextInput::make('promo_code')
                            ->label('Kode Promo')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Kode unik untuk promo (opsional)'),

                        Select::make('discount_type')
                            ->label('Tipe Diskon')
                            ->required()
                            ->options([
                                'percentage' => 'Persentase (%)',
                                'fixed' => 'Nominal Tetap (Rp)',
                            ])
                            ->default('percentage')
                            ->live(),

                        TextInput::make('discount_value')
                            ->label('Nilai Diskon')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->suffix(fn ($get) => $get('discount_type') === 'percentage' ? '%' : 'Rp')
                            ->helperText('Nilai diskon sesuai tipe yang dipilih'),

                        TextInput::make('min_purchase')
                            ->label('Minimal Pembelian')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->helperText('Minimal pembelian untuk menggunakan promo (opsional)'),
                    ]),

                Section::make('Media')
                    ->description('Gambar promo')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Gambar Promo')
                            ->image()
                            ->disk('public')
                            ->directory('promos')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Gambar utama promo (opsional)'),
                    ]),

                Section::make('Syarat & Ketentuan')
                    ->description('Syarat dan ketentuan promo')
                    ->schema([
                        TagsInput::make('terms_conditions')
                            ->label('Syarat & Ketentuan')
                            ->columnSpanFull()
                            ->placeholder('Tambahkan syarat & ketentuan...')
                            ->helperText('Tekan Enter untuk menambah syarat & ketentuan baru')
                            ->suggestions([
                                'Berlaku untuk pelanggan baru',
                                'Tidak dapat digabung dengan promo lain',
                                'Berlaku untuk minimal pembelian tertentu',
                                'Promo terbatas untuk 100 pengguna pertama',
                                'Berlaku hingga tanggal yang ditentukan',
                                'Tidak berlaku untuk produk sale',
                            ]),
                    ]),

                Section::make('Periode & Pengaturan')
                    ->description('Waktu berlaku dan pengaturan promo')
                    ->schema([
                        DateTimePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->default(now()),

                        DateTimePicker::make('end_date')
                            ->label('Tanggal Berakhir')
                            ->required()
                            ->after('start_date'),

                        TextInput::make('usage_limit')
                            ->label('Batas Penggunaan')
                            ->numeric()
                            ->minValue(1)
                            ->helperText('Maksimal berapa kali promo bisa digunakan (opsional)'),

                        TextInput::make('used_count')
                            ->label('Sudah Digunakan')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->helperText('Jumlah penggunaan saat ini'),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampil di frontend (semakin kecil semakin atas)'),
                    ]),

                Section::make('Status')
                    ->description('Status publikasi promo')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Promo aktif dan bisa digunakan'),

                        Toggle::make('is_featured')
                            ->label('Unggulan')
                            ->default(false)
                            ->helperText('Tampilkan sebagai promo unggulan'),
                    ]),
            ]);
    }
}
