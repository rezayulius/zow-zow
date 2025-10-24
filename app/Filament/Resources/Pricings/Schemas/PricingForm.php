<?php

namespace App\Filament\Resources\Pricings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PricingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Paket')
                    ->description('Informasi dasar paket pricing')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Paket')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Basic Care, Premium Care'),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->placeholder('Deskripsi lengkap paket pricing'),

                        TextInput::make('price')
                            ->label('Harga')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('500000')
                            ->helperText('Masukkan harga dalam rupiah'),

                        Select::make('duration')
                            ->label('Durasi')
                            ->required()
                            ->options([
                                'per hari' => 'Per Hari',
                                'per minggu' => 'Per Minggu',
                                'per bulan' => 'Per Bulan',
                                'per tahun' => 'Per Tahun',
                                'sekali bayar' => 'Sekali Bayar',
                            ])
                            ->default('per bulan'),
                    ]),

                Section::make('Fitur & Layanan')
                    ->description('Daftar fitur yang termasuk dalam paket')
                    ->schema([
                        TagsInput::make('features')
                            ->label('Fitur')
                            ->required()
                            ->placeholder('Tambahkan fitur...')
                            ->helperText('Tekan Enter untuk menambah fitur baru')
                            ->suggestions([
                                'Konsultasi 2x',
                                'Konsultasi unlimited',
                                'Grooming 1x',
                                'Grooming 2x',
                                'Vitamin',
                                'Vaksinasi',
                                'Emergency call',
                                'Home visit',
                                'Perawatan gigi',
                                'Pemeriksaan rutin',
                            ]),
                    ]),

                Section::make('Tombol & Link')
                    ->description('Pengaturan tombol dan link paket')
                    ->schema([
                        TextInput::make('button_text')
                            ->label('Teks Tombol')
                            ->required()
                            ->maxLength(50)
                            ->default('Pilih Paket')
                            ->placeholder('Pilih Paket'),

                        TextInput::make('button_link')
                            ->label('Link Tombol')
                            ->required()
                            ->url()
                            ->default('#')
                            ->placeholder('https://example.com/order')
                            ->helperText('URL tujuan ketika tombol diklik'),
                    ]),

                Section::make('Pengaturan Tampilan')
                    ->description('Pengaturan status dan urutan tampil')
                    ->schema([
                        Toggle::make('is_popular')
                            ->label('Paket Populer')
                            ->helperText('Tandai sebagai paket yang paling populer')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->helperText('Paket akan ditampilkan di website')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->helperText('Urutan tampil paket (angka kecil tampil lebih dulu)'),
                    ]),
            ]);
    }
}
