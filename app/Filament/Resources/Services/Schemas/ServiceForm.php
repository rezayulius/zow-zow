<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Service')
                    ->description('Informasi dasar tentang layanan')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Service')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama service'),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->placeholder('Masukkan deskripsi service'),

                        TagsInput::make('features')
                            ->label('Fitur-fitur')
                            ->placeholder('Masukkan fitur dan tekan Enter')
                            ->helperText('Tambahkan fitur-fitur yang tersedia untuk service ini')
                            ->suggestions([
                                'Pemeriksaan kesehatan lengkap',
                                'Konsultasi dokter berpengalaman',
                                'Diagnosis akurat',
                                'Vaksin inti & booster',
                                'Sertifikat vaksinasi',
                                'Follow-up kesehatan',
                                'Perawatan profesional',
                                'Teknologi modern',
                                'Hasil terjamin'
                            ]),

                        Select::make('category')
                            ->label('Kategori')
                            ->required()
                            ->options([
                                'Wellness' => 'Wellness',
                                'Health' => 'Health',
                            ])
                            ->default('Wellness')
                            ->placeholder('Pilih kategori service'),

                        TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('0')
                            ->helperText('Kosongkan jika gratis'),
                    ])
                    ->columns(2),

                Section::make('Media & Icon')
                    ->description('Gambar dan icon untuk service')
                    ->schema([
                        Select::make('icon')
                            ->label('Icon')
                            ->options([
                                'stethoscope' => '🩺 Stethoscope (Pemeriksaan)',
                                'syringe' => '💉 Syringe (Vaksinasi)',
                                'heart' => '❤️ Heart (Kesehatan Umum)',
                                'shield' => '🛡️ Shield (Perlindungan)',
                                'scissors' => '✂️ Scissors (Grooming)',
                                'sparkles' => '✨ Sparkles (Spa/Wellness)',
                                'bed' => '🛏️ Bed (Hotel/Daycare)',
                                'coffee' => '☕ Coffee (Cafe)',
                                'wand' => '🪄 Wand (Magic/Premium)',
                                'trophy' => '🏆 Trophy (Premium Service)',
                                'star' => '⭐ Star (Rating/Quality)',
                                'zap' => '⚡ Zap (Quick Service)',
                                'clock' => '🕐 Clock (24/7 Service)',
                                'phone' => '📞 Phone (Konsultasi)',
                                'camera' => '📷 Camera (Dokumentasi)',
                                'pill' => '💊 Pill (Obat/Treatment)',
                                'bandage' => '🩹 Bandage (Perawatan)',
                                'thermometer' => '🌡️ Thermometer (Diagnosis)',
                                'microscope' => '🔬 Microscope (Lab Test)',
                                'bone' => '🦴 Bone (Ortopedi)',
                            ])
                            ->placeholder('Pilih icon untuk service')
                            ->helperText('Icon akan ditampilkan di card service')
                            ->searchable(),

                        FileUpload::make('image')
                            ->label('Gambar Service')
                            ->image()
                            ->disk('public')
                            ->directory('services')
                            ->visibility('public')
                            ->helperText('Upload gambar untuk service'),
                    ])
                    ->columns(2),

                Section::make('Pengaturan Tampilan')
                    ->description('Pengaturan status dan urutan tampil')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Service akan ditampilkan jika aktif'),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka kecil akan tampil lebih dulu'),
                    ])
                    ->columns(2),
            ]);
    }
}
