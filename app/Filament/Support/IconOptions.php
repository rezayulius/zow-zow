<?php

namespace App\Filament\Support;

class IconOptions
{
    /**
     * Shared emoji-labeled icon choices for service-like Filament resources
     * (Service, ServiceCategory, ClinicService), so the option list only
     * needs to be maintained in one place.
     */
    public static function forServices(): array
    {
        return [
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
        ];
    }
}
