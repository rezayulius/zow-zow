@extends('layouts.app')

@section('title', 'Riwayat Medical Records - ZowZowVetique')

@section('content')
    @include('partials.header')

    <!-- History Page -->
    <div class="min-h-screen bg-gradient-to-br from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50 pt-32 pb-16 px-4 relative overflow-hidden">
        
        <!-- Floating Background Elements -->
        <div class="absolute top-20 right-10 w-64 h-64 bg-forest-moss-green-100 rounded-full blur-3xl opacity-40 animate-pulse pointer-events-none"></div>
        <div class="absolute bottom-40 left-10 w-72 h-72 bg-chai-100 rounded-full blur-3xl opacity-40 animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 left-1/4 w-40 h-40 bg-soft-blush-pink-100 rounded-full blur-3xl opacity-30 animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <!-- Page Header -->
            <div class="text-center mb-12 animate-bounce-in">
                <div class="inline-flex items-center justify-center p-3 bg-white rounded-2xl shadow-sm mb-4 transform -rotate-3 hover:rotate-0 transition-all duration-300">
                    <i data-lucide="clipboard-list" class="w-8 h-8 text-forest-moss-green-600"></i>
                </div>
                <h1 class="text-4xl font-bold text-carob-900 mb-2 font-heading">Riwayat Medical Records</h1>
                <p class="text-carob-600 font-medium">Jejak kesehatan dan perawatan anabul kesayangan Anda 🩺</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 animate-bounce-in" style="animation-delay: 0.1s;">
                <div class="bg-white rounded-[2rem] shadow-lg p-6 border-2 border-forest-moss-green-100 hover:border-forest-moss-green-300 transition-all duration-300 hover:-translate-y-1 group relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-forest-moss-green-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm text-carob-500 font-bold uppercase tracking-wider">Total Hewan</p>
                            <p class="text-4xl font-bold text-carob-900 mt-1">{{ count($pets) }}</p>
                        </div>
                        <div class="w-14 h-14 bg-forest-moss-green-100 rounded-2xl flex items-center justify-center text-forest-moss-green-600 shadow-sm group-hover:rotate-12 transition-transform duration-300">
                            <i data-lucide="paw-print" class="w-7 h-7"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-lg p-6 border-2 border-chai-100 hover:border-chai-300 transition-all duration-300 hover:-translate-y-1 group relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-chai-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm text-carob-500 font-bold uppercase tracking-wider">Total Records</p>
                            <p class="text-4xl font-bold text-carob-900 mt-1">{{ count($records) }}</p>
                        </div>
                        <div class="w-14 h-14 bg-chai-100 rounded-2xl flex items-center justify-center text-chai-600 shadow-sm group-hover:-rotate-12 transition-transform duration-300">
                            <i data-lucide="file-text" class="w-7 h-7"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-lg p-6 border-2 border-soft-blush-pink-100 hover:border-soft-blush-pink-300 transition-all duration-300 hover:-translate-y-1 group relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-soft-blush-pink-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm text-carob-500 font-bold uppercase tracking-wider">Kunjungan Terakhir</p>
                            <p class="text-xl font-bold text-carob-900 mt-2">
                                @if(count($records) > 0)
                                    {{ \Carbon\Carbon::parse($records[0]['date'])->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-soft-blush-pink-100 rounded-2xl flex items-center justify-center text-soft-blush-pink-600 shadow-sm group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="calendar-check" class="w-7 h-7"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Records List -->
            @if(count($records) > 0)
                <div class="space-y-6">
                    @foreach($records as $record)
                        @php
                            $statusColors = [
                                '1' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'border' => 'border-yellow-200', 'icon' => 'clock', 'blob' => 'bg-yellow-200'],
                                '2' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'icon' => 'circle-check', 'blob' => 'bg-green-200'],
                                '3' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'icon' => 'x-circle', 'blob' => 'bg-red-200']
                            ];
                            $status = $statusColors[$record['status']] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'border' => 'border-gray-200', 'icon' => 'circle-help', 'blob' => 'bg-gray-200'];
                        @endphp

                        <div class="bg-white rounded-[2.5rem] shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group animate-bounce-in border-2 border-transparent hover:border-forest-moss-green-100 relative" style="animation-delay: {{ 0.2 + ($loop->index * 0.1) }}s;">
                            <!-- Decorative Blob -->
                            <div class="absolute -top-12 -right-12 w-40 h-40 rounded-full {{ $status['blob'] }} opacity-20 blur-3xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                            
                            <div class="p-8 relative z-10">
                                <!-- Record Header -->
                                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 gap-4">
                                    <div class="flex items-center space-x-5">
                                        <!-- Pet Avatar -->
                                        <div class="relative flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                                            @if($record['pet_info']['profile_picture'] && $record['pet_info']['profile_picture'] !== 'https://vet.digitail.io/images/petpic.png')
                                                <img src="{{ $record['pet_info']['profile_picture'] }}" alt="{{ $record['pet_info']['nickname'] }}" class="w-20 h-20 rounded-2xl object-cover shadow-md border-4 border-white">
                                            @else
                                                <div class="w-20 h-20 bg-gradient-to-br from-forest-moss-green-400 to-forest-moss-green-600 rounded-2xl flex items-center justify-center shadow-md border-4 border-white">
                                                    <i data-lucide="paw-print" class="text-white w-10 h-10"></i>
                                                </div>
                                            @endif
                                            <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100">
                                                <i data-lucide="{{ $record['pet_info']['species'] == 'Cat' ? 'cat' : 'dog' }}" class="w-4 h-4 text-carob-500"></i>
                                            </div>
                                        </div>

                                        <!-- Record Info -->
                                        <div>
                                            <div class="flex items-center gap-3 mb-1">
                                                <h3 class="text-2xl font-bold text-carob-900 font-heading">{{ $record['pet_info']['nickname'] }}</h3>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $status['bg'] }} {{ $status['text'] }} border {{ $status['border'] }}">
                                                    <i data-lucide="{{ $status['icon'] }}" class="w-3 h-3 mr-1.5"></i>
                                                    {{ $status['text'] == 'Open' ? 'Berjalan' : ($status['text'] == 'Closed' ? 'Selesai' : 'Dibatalkan') }}
                                                </span>
                                            </div>
                                            <div class="flex flex-wrap gap-4 text-sm text-carob-500 font-medium">
                                                <div class="flex items-center bg-soft-linen-50 px-3 py-1 rounded-lg">
                                                    <i data-lucide="hash" class="w-4 h-4 mr-2 text-chai-500"></i>
                                                    <span>Record #{{ $record['number'] }}</span>
                                                </div>
                                                <div class="flex items-center bg-soft-linen-50 px-3 py-1 rounded-lg">
                                                    <i data-lucide="calendar" class="w-4 h-4 mr-2 text-chai-500"></i>
                                                    <span>{{ \Carbon\Carbon::parse($record['date'])->format('d F Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Record Details Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 pt-6 border-t border-dashed border-gray-200">
                                    @if($record['reason'])
                                        <div class="bg-soft-linen-50 rounded-2xl p-5 hover:bg-soft-linen-100 transition-colors">
                                            <label class="text-xs text-carob-500 font-bold uppercase tracking-wider flex items-center mb-3">
                                                <div class="w-6 h-6 rounded-full bg-white flex items-center justify-center mr-2 shadow-sm">
                                                    <i data-lucide="clipboard" class="w-3 h-3 text-chai-500"></i>
                                                </div>
                                                Alasan Kunjungan
                                            </label>
                                            <p class="text-carob-900 font-semibold leading-relaxed">{{ $record['reason'] }}</p>
                                        </div>
                                    @endif

                                    @if($record['presumptive_diagnosis'])
                                        <div class="bg-forest-moss-green-50 rounded-2xl p-5 hover:bg-forest-moss-green-100 transition-colors">
                                            <label class="text-xs text-forest-moss-green-700 font-bold uppercase tracking-wider flex items-center mb-3">
                                                <div class="w-6 h-6 rounded-full bg-white flex items-center justify-center mr-2 shadow-sm">
                                                    <i data-lucide="stethoscope" class="w-3 h-3 text-forest-moss-green-600"></i>
                                                </div>
                                                Diagnosis Awal
                                            </label>
                                            <p class="text-carob-900 font-semibold leading-relaxed">{{ $record['presumptive_diagnosis'] }}</p>
                                        </div>
                                    @endif

                                    @if($record['diagnosis'])
                                        <div class="bg-forest-moss-green-50 rounded-2xl p-5 hover:bg-forest-moss-green-100 transition-colors">
                                            <label class="text-xs text-forest-moss-green-700 font-bold uppercase tracking-wider flex items-center mb-3">
                                                <div class="w-6 h-6 rounded-full bg-white flex items-center justify-center mr-2 shadow-sm">
                                                    <i data-lucide="activity" class="w-3 h-3 text-forest-moss-green-600"></i>
                                                </div>
                                                Diagnosis Akhir
                                            </label>
                                            <p class="text-carob-900 font-semibold leading-relaxed">{{ $record['diagnosis'] }}</p>
                                        </div>
                                    @endif

                                    @if($record['treatment'])
                                        <div class="bg-blue-50 rounded-2xl p-5 hover:bg-blue-100 transition-colors">
                                            <label class="text-xs text-blue-700 font-bold uppercase tracking-wider flex items-center mb-3">
                                                <div class="w-6 h-6 rounded-full bg-white flex items-center justify-center mr-2 shadow-sm">
                                                    <i data-lucide="pill" class="w-3 h-3 text-blue-600"></i>
                                                </div>
                                                Tindakan / Perawatan
                                            </label>
                                            <p class="text-carob-900 font-semibold leading-relaxed">{{ $record['treatment'] }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Comments & Recommendations -->
                                @if($record['comments'] || $record['recommendations'])
                                    <div class="mt-6 pt-6 border-t border-dashed border-gray-200 space-y-4">
                                        @if($record['comments'])
                                            <div class="bg-white border-2 border-gray-100 rounded-2xl p-5 shadow-sm">
                                                <label class="text-xs text-gray-500 font-bold uppercase tracking-wider flex items-center mb-2">
                                                    <i data-lucide="message-square" class="w-4 h-4 mr-2 text-gray-400"></i>
                                                    Catatan Dokter
                                                </label>
                                                <p class="text-carob-800 italic">"{{ $record['comments'] }}"</p>
                                            </div>
                                        @endif

                                        @if($record['recommendations'])
                                            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-5 border border-yellow-100">
                                                <label class="text-xs text-yellow-700 font-bold uppercase tracking-wider flex items-center mb-2">
                                                    <i data-lucide="lightbulb" class="w-4 h-4 mr-2 text-yellow-600"></i>
                                                    Rekomendasi
                                                </label>
                                                <p class="text-carob-900 font-medium">{{ $record['recommendations'] }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <!-- Record Timestamps -->
                                <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
                                    <div class="flex flex-wrap gap-4 text-xs text-carob-500 font-medium">
                                        @if($record['opened_at'])
                                            <div class="flex items-center bg-gray-50 px-3 py-1 rounded-full">
                                                <i data-lucide="clock" class="w-3 h-3 mr-1.5"></i>
                                                <span>Dibuka: {{ \Carbon\Carbon::parse($record['opened_at'])->format('d M Y H:i') }}</span>
                                            </div>
                                        @endif
                                        @if($record['closed_at'])
                                            <div class="flex items-center bg-green-50 text-green-600 px-3 py-1 rounded-full">
                                                <i data-lucide="circle-check-big" class="w-3 h-3 mr-1.5"></i>
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
                <!-- Empty State (Joyful) -->
                <div class="bg-white rounded-[3rem] shadow-2xl p-12 text-center max-w-2xl mx-auto animate-bounce-in relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-forest-moss-green-400 to-chai-400"></div>
                    <div class="w-32 h-32 bg-soft-linen-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner animate-pulse">
                        <i data-lucide="file-heart" class="w-16 h-16 text-carob-500"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-carob-900 mb-4 font-heading">Belum Ada Riwayat Medis</h2>
                    <p class="text-carob-600 mb-8 leading-relaxed">
                        Saat ini belum ada catatan kunjungan untuk anabul kesayangan Anda. <br>
                        Riwayat kesehatan akan otomatis muncul di sini setelah kunjungan ke klinik.
                    </p>
                    <a href="/#booking" class="inline-flex items-center px-8 py-4 bg-forest-moss-green-600 text-white rounded-2xl font-bold hover:bg-forest-moss-green-700 transition-all shadow-lg hover:shadow-forest-moss-green-200 hover:-translate-y-1 group">
                        <i data-lucide="calendar-plus" class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform"></i>
                        Buat Appointment Sekarang
                    </a>
                </div>
            @endif

            <!-- Back to Profile Button -->
            <div class="text-center mt-12 mb-8">
                <a href="{{ route('profile') }}" class="inline-flex items-center text-carob-500 hover:text-forest-moss-green-600 transition-all duration-300 font-medium group bg-white/50 px-6 py-3 rounded-full hover:bg-white hover:shadow-md">
                    <i data-lucide="arrow-left" class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Profile
                </a>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection