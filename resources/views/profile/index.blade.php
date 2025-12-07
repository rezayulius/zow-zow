@extends('layouts.app')

@section('title', 'Profile - ZowZowVetique')

@section('content')
    @include('partials.header')

    <!-- Profile Page -->
    <div class="min-h-screen bg-gradient-to-br from-almond-50 via-vanilla-50 to-matcha-50 pt-32 pb-16 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Page Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-carob-900 mb-2">Profile Saya</h1>
                <p class="text-carob-600">Kelola informasi akun dan data hewan peliharaan Anda</p>
            </div>

            @if($isRegistered)
                <!-- Registered User Profile -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Profile Header -->
                    <div class="bg-gradient-to-r from-matcha-500 to-matcha-600 p-8 text-white">
                        <div class="flex items-center space-x-6">
                            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                                @if($petParent['profile_picture'])
                                    <img src="{{ $petParent['profile_picture'] }}" alt="{{ $petParent['full_name'] }}" class="w-24 h-24 rounded-full object-cover">
                                @else
                                    <span class="text-matcha-600 font-bold text-4xl">{{ strtoupper(substr($petParent['full_name'], 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h2 class="text-3xl font-bold mb-1">{{ $petParent['full_name'] }}</h2>
                                <p class="text-matcha-100 flex items-center">
                                    <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                                    {{ $petParent['email'] }}
                                </p>
                                <p class="text-matcha-100 flex items-center mt-1">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2"></i>
                                    {{ $petParent['phone'] ?? 'Tidak tersedia' }}
                                </p>
                            </div>
                            <div class="text-right">
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                                    <p class="text-xs text-matcha-100">Client ID</p>
                                    <p class="text-xl font-bold">#{{ $petParent['current_client_id'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div class="space-y-4">
                                <h3 class="text-xl font-bold text-carob-900 mb-4 flex items-center">
                                    <i data-lucide="user" class="w-5 h-5 mr-2 text-matcha-600"></i>
                                    Informasi Pribadi
                                </h3>
                                
                                <div class="bg-almond-50 rounded-lg p-4">
                                    <label class="text-xs text-carob-600 font-medium">Nama Depan</label>
                                    <p class="text-carob-900 font-semibold">{{ $petParent['name'] }}</p>
                                </div>

                                <div class="bg-almond-50 rounded-lg p-4">
                                    <label class="text-xs text-carob-600 font-medium">Nama Belakang</label>
                                    <p class="text-carob-900 font-semibold">{{ $petParent['last_name'] }}</p>
                                </div>

                                @if($petParent['birthdate'])
                                    <div class="bg-almond-50 rounded-lg p-4">
                                        <label class="text-xs text-carob-600 font-medium">Tanggal Lahir</label>
                                        <p class="text-carob-900 font-semibold">{{ \Carbon\Carbon::parse($petParent['birthdate'])->format('d F Y') }}</p>
                                    </div>
                                @endif

                                @if($petParent['secondary_phone'])
                                    <div class="bg-almond-50 rounded-lg p-4">
                                        <label class="text-xs text-carob-600 font-medium">Telepon Sekunder</label>
                                        <p class="text-carob-900 font-semibold">{{ $petParent['secondary_phone'] }}</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Address Information -->
                            <div class="space-y-4">
                                <h3 class="text-xl font-bold text-carob-900 mb-4 flex items-center">
                                    <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-matcha-600"></i>
                                    Informasi Alamat
                                </h3>

                                <div class="bg-almond-50 rounded-lg p-4">
                                    <label class="text-xs text-carob-600 font-medium">Alamat Utama</label>
                                    <p class="text-carob-900 font-semibold">{{ $petParent['address'] ?? 'Tidak tersedia' }}</p>
                                </div>

                                @if($petParent['address_2'])
                                    <div class="bg-almond-50 rounded-lg p-4">
                                        <label class="text-xs text-carob-600 font-medium">Alamat Tambahan</label>
                                        <p class="text-carob-900 font-semibold">{{ $petParent['address_2'] }}</p>
                                    </div>
                                @endif

                                @if($petParent['city'])
                                    <div class="bg-almond-50 rounded-lg p-4">
                                        <label class="text-xs text-carob-600 font-medium">Kota</label>
                                        <p class="text-carob-900 font-semibold">{{ $petParent['city'] }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Additional Information -->
                        @if($petParent['observations'])
                            <div class="mt-6">
                                <h3 class="text-xl font-bold text-carob-900 mb-4 flex items-center">
                                    <i data-lucide="file-text" class="w-5 h-5 mr-2 text-matcha-600"></i>
                                    Catatan
                                </h3>
                                <div class="bg-almond-50 rounded-lg p-4">
                                    <p class="text-carob-900">{{ $petParent['observations'] }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Account Info -->
                        <div class="mt-6 pt-6 border-t border-almond-200">
                            <h3 class="text-xl font-bold text-carob-900 mb-4 flex items-center">
                                <i data-lucide="info" class="w-5 h-5 mr-2 text-matcha-600"></i>
                                Informasi Akun
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gradient-to-br from-matcha-50 to-matcha-100 rounded-lg p-4 text-center">
                                    <i data-lucide="calendar" class="w-8 h-8 mx-auto mb-2 text-matcha-600"></i>
                                    <p class="text-xs text-carob-600 font-medium">Terdaftar Sejak</p>
                                    <p class="text-carob-900 font-bold">{{ \Carbon\Carbon::parse($petParent['created_at'])->format('d M Y') }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-chai-50 to-chai-100 rounded-lg p-4 text-center">
                                    <i data-lucide="smartphone" class="w-8 h-8 mx-auto mb-2 text-chai-600"></i>
                                    <p class="text-xs text-carob-600 font-medium">Status Aplikasi</p>
                                    <p class="text-carob-900 font-bold">{{ $petParent['has_app'] ? 'Terpasang' : 'Belum Terpasang' }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-pistache-50 to-pistache-100 rounded-lg p-4 text-center">
                                    <i data-lucide="hash" class="w-8 h-8 mx-auto mb-2 text-pistache-600"></i>
                                    <p class="text-xs text-carob-600 font-medium">Pet Parent ID</p>
                                    <p class="text-carob-900 font-bold">#{{ $petParent['id'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Not Registered Message -->
                <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="alert-circle" class="w-12 h-12 text-white"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-carob-900 mb-4">Akun Belum Terdaftar di Digitail</h2>
                    <p class="text-carob-600 mb-6 max-w-2xl mx-auto">
                        Email <strong>{{ $user->email }}</strong> belum terdaftar sebagai Pet Parent di sistem Digitail. 
                        Silakan hubungi klinik kami untuk mendaftarkan akun Anda dan mulai mengelola data hewan peliharaan Anda.
                    </p>
                    
                    <div class="bg-almond-50 rounded-xl p-6 max-w-2xl mx-auto mb-6">
                        <h3 class="font-bold text-carob-900 mb-3 flex items-center justify-center">
                            <i data-lucide="info" class="w-5 h-5 mr-2 text-matcha-600"></i>
                            Cara Mendaftar
                        </h3>
                        <ul class="text-left space-y-2 text-carob-700">
                            <li class="flex items-start">
                                <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-matcha-600 flex-shrink-0 mt-0.5"></i>
                                <span>Hubungi klinik ZowZowVetique melalui WhatsApp atau telepon</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-matcha-600 flex-shrink-0 mt-0.5"></i>
                                <span>Berikan informasi email Anda: <strong>{{ $user->email }}</strong></span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-matcha-600 flex-shrink-0 mt-0.5"></i>
                                <span>Tim kami akan mendaftarkan Anda sebagai Pet Parent</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-matcha-600 flex-shrink-0 mt-0.5"></i>
                                <span>Refresh halaman ini untuk melihat profil Anda</span>
                            </li>
                        </ul>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="https://wa.me/6281219088899" target="_blank" class="inline-flex items-center justify-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                            <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                            Hubungi via WhatsApp
                        </a>
                        <a href="tel:+6281219088899" class="inline-flex items-center justify-center px-6 py-3 bg-chai-500 text-white rounded-lg hover:bg-chai-600 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                            <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
                            Telepon Kami
                        </a>
                    </div>
                </div>
            @endif

            <!-- Back to Home Button -->
            <div class="text-center mt-8">
                <a href="/" class="inline-flex items-center text-carob-600 hover:text-matcha-600 transition-all duration-200 font-medium">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection
