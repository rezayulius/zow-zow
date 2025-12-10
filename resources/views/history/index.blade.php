@extends('layouts.app')

@section('title', 'Riwayat Medical Records - ZowZowVetique')

@section('content')
    @include('partials.header')

    <!-- History Page -->
    <div class="min-h-screen bg-gradient-to-br from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50 pt-32 pb-16 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Page Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-carob-900 mb-2">Riwayat Medical Records</h1>
                <p class="text-carob-600">Lihat semua riwayat kunjungan dan perawatan hewan peliharaan Anda</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-forest-moss-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-carob-600 font-medium">Total Hewan</p>
                            <p class="text-3xl font-bold text-carob-900">{{ count($pets) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-forest-moss-green-100 rounded-full flex items-center justify-center">
                            <i data-lucide="paw-print" class="w-6 h-6 text-forest-moss-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-chai-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-carob-600 font-medium">Total Records</p>
                            <p class="text-3xl font-bold text-carob-900">{{ count($records) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-chai-100 rounded-full flex items-center justify-center">
                            <i data-lucide="file-text" class="w-6 h-6 text-chai-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-forest-moss-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-carob-600 font-medium">Kunjungan Terakhir</p>
                            <p class="text-lg font-bold text-carob-900">
                                @if(count($records) > 0)
                                    {{ \Carbon\Carbon::parse($records[0]['date'])->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-forest-moss-green-100 rounded-full flex items-center justify-center">
                            <i data-lucide="calendar" class="w-6 h-6 text-forest-moss-green-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Records List -->
            @if(count($records) > 0)
                <div class="space-y-4">
                    @foreach($records as $record)
                        @php
                            $statusColors = [
                                '1' => ['bg' => 'yellow', 'text' => 'Open'],
                                '2' => ['bg' => 'green', 'text' => 'Closed'],
                                '3' => ['bg' => 'red', 'text' => 'Cancelled']
                            ];
                            $status = $statusColors[$record['status']] ?? ['bg' => 'gray', 'text' => 'Unknown'];
                        @endphp

                        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                            <div class="p-6">
                                <!-- Record Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-start space-x-4">
                                        <!-- Pet Avatar -->
                                        <div class="flex-shrink-0">
                                            @if($record['pet_info']['profile_picture'] && $record['pet_info']['profile_picture'] !== 'https://developer.digitail.io/images/petpic.png')
                                                <img src="{{ $record['pet_info']['profile_picture'] }}" alt="{{ $record['pet_info']['nickname'] }}" class="w-16 h-16 rounded-full object-cover border-2 border-forest-moss-green-200">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-forest-moss-green-400 to-forest-moss-green-600 rounded-full flex items-center justify-center border-2 border-forest-moss-green-200">
                                                    <i data-lucide="paw-print" class="text-white w-8 h-8"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Record Info -->
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3 mb-2">
                                                <h3 class="text-xl font-bold text-carob-900">{{ $record['pet_info']['nickname'] }}</h3>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $status['bg'] }}-100 text-{{ $status['bg'] }}-700">
                                                    {{ $status['text'] }}
                                                </span>
                                            </div>
                                            <div class="flex flex-wrap gap-3 text-sm text-carob-600">
                                                <div class="flex items-center">
                                                    <i data-lucide="hash" class="w-4 h-4 mr-1 text-forest-moss-green-600"></i>
                                                    <span>Record #{{ $record['number'] }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i data-lucide="calendar" class="w-4 h-4 mr-1 text-forest-moss-green-600"></i>
                                                    <span>{{ \Carbon\Carbon::parse($record['date'])->format('d F Y') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i data-lucide="user" class="w-4 h-4 mr-1 text-forest-moss-green-600"></i>
                                                    <span>Patient #{{ $record['pet_info']['patientNumber'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Badge (Mobile) -->
                                    <div class="md:hidden">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $status['bg'] }}-100 text-{{ $status['bg'] }}-700">
                                            {{ $status['text'] }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Record Details -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 pt-4 border-t border-soft-linen-200">
                                    @if($record['reason'])
                                        <div class="bg-soft-linen-50 rounded-lg p-4">
                                            <label class="text-xs text-carob-600 font-medium flex items-center mb-2">
                                                <i data-lucide="clipboard" class="w-4 h-4 mr-1"></i>
                                                Alasan Kunjungan
                                            </label>
                                            <p class="text-carob-900 font-semibold">{{ $record['reason'] }}</p>
                                        </div>
                                    @endif

                                    @if($record['presumptive_diagnosis'])
                                        <div class="bg-soft-linen-50 rounded-lg p-4">
                                            <label class="text-xs text-carob-600 font-medium flex items-center mb-2">
                                                <i data-lucide="stethoscope" class="w-4 h-4 mr-1"></i>
                                                Diagnosis Awal
                                            </label>
                                            <p class="text-carob-900 font-semibold">{{ $record['presumptive_diagnosis'] }}</p>
                                        </div>
                                    @endif

                                    @if($record['diagnosis'])
                                        <div class="bg-soft-linen-50 rounded-lg p-4">
                                            <label class="text-xs text-carob-600 font-medium flex items-center mb-2">
                                                <i data-lucide="activity" class="w-4 h-4 mr-1"></i>
                                                Diagnosis
                                            </label>
                                            <p class="text-carob-900 font-semibold">{{ $record['diagnosis'] }}</p>
                                        </div>
                                    @endif

                                    @if($record['treatment'])
                                        <div class="bg-soft-linen-50 rounded-lg p-4">
                                            <label class="text-xs text-carob-600 font-medium flex items-center mb-2">
                                                <i data-lucide="pill" class="w-4 h-4 mr-1"></i>
                                                Perawatan
                                            </label>
                                            <p class="text-carob-900 font-semibold">{{ $record['treatment'] }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Comments & Recommendations -->
                                @if($record['comments'] || $record['recommendations'])
                                    <div class="mt-4 pt-4 border-t border-soft-linen-200 space-y-3">
                                        @if($record['comments'])
                                            <div class="bg-gradient-to-r from-forest-moss-green-50 to-forest-moss-green-100 rounded-lg p-4">
                                                <label class="text-xs text-forest-moss-green-700 font-medium flex items-center mb-2">
                                                    <i data-lucide="message-square" class="w-4 h-4 mr-1"></i>
                                                    Catatan Dokter
                                                </label>
                                                <p class="text-carob-900">{{ $record['comments'] }}</p>
                                            </div>
                                        @endif

                                        @if($record['recommendations'])
                                            <div class="bg-gradient-to-r from-chai-50 to-chai-100 rounded-lg p-4">
                                                <label class="text-xs text-chai-700 font-medium flex items-center mb-2">
                                                    <i data-lucide="lightbulb" class="w-4 h-4 mr-1"></i>
                                                    Rekomendasi
                                                </label>
                                                <p class="text-carob-900">{{ $record['recommendations'] }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <!-- Record Timestamps -->
                                <div class="mt-4 pt-4 border-t border-soft-linen-200">
                                    <div class="flex flex-wrap gap-4 text-xs text-carob-500">
                                        @if($record['opened_at'])
                                            <div class="flex items-center">
                                                <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                                <span>Dibuka: {{ \Carbon\Carbon::parse($record['opened_at'])->format('d M Y H:i') }}</span>
                                            </div>
                                        @endif
                                        @if($record['closed_at'])
                                            <div class="flex items-center">
                                                <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                                <span>Ditutup: {{ \Carbon\Carbon::parse($record['closed_at'])->format('d M Y H:i') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-soft-linen-200 to-soft-linen-300 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="file-text" class="w-12 h-12 text-carob-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-carob-900 mb-4">Belum Ada Riwayat Medical Records</h2>
                    <p class="text-carob-600 mb-6 max-w-2xl mx-auto">
                        Belum ada catatan kunjungan untuk hewan peliharaan Anda. Riwayat akan muncul setelah Anda melakukan kunjungan ke klinik.
                    </p>
                    <a href="/#booking" class="inline-flex items-center px-6 py-3 bg-forest-moss-green-500 text-white rounded-lg hover:bg-forest-moss-green-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                        <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                        Buat Appointment
                    </a>
                </div>
            @endif

            <!-- Back to Profile Button -->
            <div class="text-center mt-8">
                <a href="{{ route('profile') }}" class="inline-flex items-center text-carob-600 hover:text-forest-moss-green-600 transition-all duration-200 font-medium">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali ke Profile
                </a>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
