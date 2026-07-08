@extends('layouts.app')

@section('title', 'Profile - ZowZowVetique')

@section('content')
    @include('partials.header')

    <!-- Profile Page -->
    <div class="min-h-screen bg-gradient-to-br from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50 pt-32 pb-16 px-4 relative overflow-hidden">
        
        <!-- Floating Background Elements -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-forest-moss-green-100 rounded-full blur-3xl opacity-40 animate-pulse pointer-events-none"></div>
        <div class="absolute bottom-40 right-10 w-72 h-72 bg-chai-100 rounded-full blur-3xl opacity-40 animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 right-1/4 w-40 h-40 bg-soft-blush-pink-100 rounded-full blur-3xl opacity-30 animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>

        <div class="max-w-5xl mx-auto relative z-10">
            <!-- Page Header -->
            <div class="text-center mb-10 animate-bounce-in">
                <div class="inline-flex items-center justify-center p-3 bg-white rounded-2xl shadow-sm mb-4 transform rotate-3 hover:rotate-0 transition-all duration-300">
                    <i data-lucide="circle-user-round" class="w-8 h-8 text-forest-moss-green-600"></i>
                </div>
                <h1 class="text-4xl font-bold text-carob-900 mb-2 font-heading">Profile Saya</h1>
                <p class="text-carob-600 font-medium">Kelola informasi akun dan data hewan peliharaan Anda 🐾</p>
            </div>

            @if($isRegistered)
                <!-- Registered User Profile -->
                <div class="space-y-8">
                    
                    <!-- Profile Header Card -->
                    <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-300 animate-bounce-in relative group">
                        <!-- Decorative Top Shape -->
                        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-r from-forest-moss-green-500 to-forest-moss-green-600 rounded-b-[50%] transform scale-x-150 -translate-y-16 group-hover:scale-x-125 transition-transform duration-700"></div>
                        
                        <div class="relative pt-12 px-8 pb-8">
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                                <!-- Profile Picture -->
                                <div class="relative">
                                    <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-xl p-1 relative z-10 group-hover:scale-105 transition-transform duration-300">
                                        @if($petParent['profile_picture'])
                                            <img src="{{ $petParent['profile_picture'] }}" alt="{{ $petParent['full_name'] }}" class="w-full h-full rounded-full object-cover border-4 border-forest-moss-green-50">
                                        @else
                                            <div class="w-full h-full rounded-full bg-soft-linen-100 flex items-center justify-center border-4 border-forest-moss-green-50">
                                                <span class="text-forest-moss-green-600 font-bold text-5xl font-heading">{{ strtoupper(substr($petParent['full_name'], 0, 1)) }}</span>
                                            </div>
                                        @endif
                                        <div class="absolute bottom-2 right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white" title="Active"></div>
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="flex-1 text-center md:text-left pt-4">
                                    <h2 class="text-3xl font-bold text-carob-900 mb-2 font-heading">{{ $petParent['full_name'] }}</h2>
                                    <div class="flex flex-col md:flex-row gap-4 items-center md:items-start text-carob-600 text-sm font-medium">
                                        <div class="flex items-center gap-2 bg-soft-linen-50 px-3 py-1.5 rounded-full">
                                            <i data-lucide="mail" class="w-4 h-4 text-forest-moss-green-500"></i>
                                            {{ $petParent['email'] }}
                                        </div>
                                        <div class="flex items-center gap-2 bg-soft-linen-50 px-3 py-1.5 rounded-full">
                                            <i data-lucide="phone" class="w-4 h-4 text-forest-moss-green-500"></i>
                                            {{ $petParent['phone'] ?? 'Tidak tersedia' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Client ID Badge -->
                                <div class="mt-4 md:mt-0 pt-4">
                                    <div class="bg-gradient-to-br from-forest-moss-green-50 to-forest-moss-green-100 rounded-2xl p-4 text-center border border-forest-moss-green-200 shadow-sm hover:shadow-md transition-shadow">
                                        <p class="text-xs font-bold text-forest-moss-green-600 uppercase tracking-wider mb-1">Client ID</p>
                                        <p class="text-2xl font-bold text-carob-900 font-heading">#{{ $petParent['current_client_id'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column: Personal & Address -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- Personal & Address Info Card -->
                            <div class="bg-white rounded-[2rem] shadow-xl p-8 animate-bounce-in" style="animation-delay: 0.1s;">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-10 h-10 bg-chai-100 rounded-xl flex items-center justify-center text-chai-600 transform -rotate-6">
                                        <i data-lucide="user-check" class="w-5 h-5"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-carob-900">Informasi Lengkap</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Personal -->
                                    <div class="space-y-4">
                                        <h4 class="text-sm font-bold text-carob-500 uppercase tracking-wider mb-2">Pribadi</h4>
                                        
                                        <div class="group">
                                            <label class="text-xs text-carob-500 font-medium ml-1">Nama Depan</label>
                                            <div class="bg-soft-linen-50 rounded-2xl p-3.5 border border-transparent group-hover:border-chai-200 transition-colors">
                                                <p class="text-carob-900 font-semibold">{{ $petParent['name'] }}</p>
                                            </div>
                                        </div>

                                        <div class="group">
                                            <label class="text-xs text-carob-500 font-medium ml-1">Nama Belakang</label>
                                            <div class="bg-soft-linen-50 rounded-2xl p-3.5 border border-transparent group-hover:border-chai-200 transition-colors">
                                                <p class="text-carob-900 font-semibold">{{ $petParent['last_name'] }}</p>
                                            </div>
                                        </div>

                                        @if($petParent['birthdate'])
                                            <div class="group">
                                                <label class="text-xs text-carob-500 font-medium ml-1">Tanggal Lahir</label>
                                                <div class="bg-soft-linen-50 rounded-2xl p-3.5 border border-transparent group-hover:border-chai-200 transition-colors flex items-center gap-2">
                                                    <i data-lucide="cake" class="w-4 h-4 text-chai-400"></i>
                                                    <p class="text-carob-900 font-semibold">{{ \Carbon\Carbon::parse($petParent['birthdate'])->format('d F Y') }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Address -->
                                    <div class="space-y-4">
                                        <h4 class="text-sm font-bold text-carob-500 uppercase tracking-wider mb-2">Alamat & Kontak</h4>

                                        <div class="group">
                                            <label class="text-xs text-carob-500 font-medium ml-1">Alamat Utama</label>
                                            <div class="bg-soft-linen-50 rounded-2xl p-3.5 border border-transparent group-hover:border-chai-200 transition-colors flex items-start gap-2">
                                                <i data-lucide="map-pin" class="w-4 h-4 text-chai-400 mt-0.5 flex-shrink-0"></i>
                                                <p class="text-carob-900 font-semibold">{{ $petParent['address'] ?? 'Tidak tersedia' }}</p>
                                            </div>
                                        </div>

                                        @if($petParent['city'])
                                            <div class="group">
                                                <label class="text-xs text-carob-500 font-medium ml-1">Kota</label>
                                                <div class="bg-soft-linen-50 rounded-2xl p-3.5 border border-transparent group-hover:border-chai-200 transition-colors">
                                                    <p class="text-carob-900 font-semibold">{{ $petParent['city'] }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($petParent['secondary_phone'])
                                            <div class="group">
                                                <label class="text-xs text-carob-500 font-medium ml-1">Telepon Sekunder</label>
                                                <div class="bg-soft-linen-50 rounded-2xl p-3.5 border border-transparent group-hover:border-chai-200 transition-colors">
                                                    <p class="text-carob-900 font-semibold">{{ $petParent['secondary_phone'] }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if($petParent['observations'])
                                    <div class="mt-6 pt-6 border-t border-dashed border-gray-100">
                                        <label class="text-xs text-carob-500 font-medium ml-1 mb-2 block">Catatan Tambahan</label>
                                        <div class="bg-yellow-50 rounded-2xl p-4 border border-yellow-100 text-carob-700 italic flex gap-3">
                                            <i data-lucide="sticky-note" class="w-5 h-5 text-yellow-500 flex-shrink-0"></i>
                                            <p>{{ $petParent['observations'] }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Column: Account Stats & Pets -->
                        <div class="space-y-8">
                            <!-- Account Stats -->
                            <div class="bg-white rounded-[2rem] shadow-xl p-6 animate-bounce-in" style="animation-delay: 0.2s;">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-10 h-10 bg-forest-moss-green-100 rounded-xl flex items-center justify-center text-forest-moss-green-600 transform rotate-6">
                                        <i data-lucide="activity" class="w-5 h-5"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-carob-900">Status Akun</h3>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-4 bg-soft-linen-50 rounded-2xl group hover:bg-soft-linen-100 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm text-carob-500 group-hover:text-forest-moss-green-500 transition-colors">
                                                <i data-lucide="calendar" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs text-carob-500 font-medium">Terdaftar Sejak</p>
                                                <p class="text-carob-900 font-bold">{{ \Carbon\Carbon::parse($petParent['created_at'])->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-soft-linen-50 rounded-2xl group hover:bg-soft-linen-100 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm text-carob-500 group-hover:text-chai-500 transition-colors">
                                                <i data-lucide="smartphone" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs text-carob-500 font-medium">Aplikasi Digitail</p>
                                                <p class="text-carob-900 font-bold">{{ $petParent['has_app'] ? 'Terpasang' : 'Belum Terpasang' }}</p>
                                            </div>
                                        </div>
                                        @if($petParent['has_app'])
                                            <i data-lucide="circle-check" class="w-5 h-5 text-green-500"></i>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center justify-between p-4 bg-soft-linen-50 rounded-2xl group hover:bg-soft-linen-100 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm text-carob-500 group-hover:text-forest-moss-green-500 transition-colors">
                                                <i data-lucide="hash" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs text-carob-500 font-medium">System ID</p>
                                                <p class="text-carob-900 font-bold">#{{ $petParent['id'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pets Section -->
                    <div class="animate-bounce-in" style="animation-delay: 0.3s;">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-soft-blush-pink-400 to-soft-blush-pink-600 rounded-2xl flex items-center justify-center text-white shadow-lg transform -rotate-3">
                                    <i data-lucide="paw-print" class="w-6 h-6 fill-current"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-carob-900">Hewan Peliharaan</h3>
                                    <p class="text-carob-500 font-medium">{{ count($pets) }} anabul kesayangan</p>
                                </div>
                            </div>
                        </div>

                        @if(count($pets) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($pets as $pet)
                                    @php
                                        $colorSchemes = [
                                            ['bg' => 'bg-forest-moss-green-50', 'border' => 'border-forest-moss-green-100', 'text' => 'text-forest-moss-green-600', 'icon_bg' => 'bg-forest-moss-green-100'],
                                            ['bg' => 'bg-chai-50', 'border' => 'border-chai-100', 'text' => 'text-chai-600', 'icon_bg' => 'bg-chai-100'],
                                            ['bg' => 'bg-soft-blush-pink-50', 'border' => 'border-soft-blush-pink-100', 'text' => 'text-soft-blush-pink-600', 'icon_bg' => 'bg-soft-blush-pink-100'],
                                            ['bg' => 'bg-pistache-50', 'border' => 'border-pistache-100', 'text' => 'text-pistache-600', 'icon_bg' => 'bg-pistache-100']
                                        ];
                                        $scheme = $colorSchemes[$loop->index % 4];
                                    @endphp

                                    <div class="bg-white rounded-[2rem] p-6 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 {{ $scheme['border'] }} group relative overflow-hidden">
                                        <!-- Decorative Blob -->
                                        <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full {{ $scheme['icon_bg'] }} opacity-50 blur-2xl group-hover:scale-150 transition-transform duration-500"></div>

                                        <div class="relative z-10 flex flex-col h-full">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="relative">
                                                    @if($pet['profile_picture'] && $pet['profile_picture'] !== 'https://vet.digitail.io/images/petpic.png')
                                                        <img src="{{ $pet['profile_picture'] }}" alt="{{ $pet['nickname'] }}" class="w-20 h-20 rounded-2xl object-cover shadow-md group-hover:scale-110 transition-transform duration-300">
                                                    @else
                                                        <div class="w-20 h-20 rounded-2xl {{ $scheme['icon_bg'] }} flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                                            <i data-lucide="paw-print" class="w-10 h-10 {{ $scheme['text'] }}"></i>
                                                        </div>
                                                    @endif
                                                    
                                                    @if($pet['gender'])
                                                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-white rounded-full shadow-sm flex items-center justify-center border {{ $scheme['border'] }}">
                                                            <i data-lucide="{{ $pet['gender'] === 'male' ? 'mars' : 'venus' }}" class="w-4 h-4 {{ $pet['gender'] === 'male' ? 'text-blue-500' : 'text-pink-500' }}"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="text-right">
                                                    <span class="inline-block px-3 py-1 rounded-full bg-white border {{ $scheme['border'] }} text-xs font-bold {{ $scheme['text'] }}">
                                                        #{{ $pet['patientNumber'] }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <h4 class="text-xl font-bold text-carob-900 font-heading group-hover:{{ $scheme['text'] }} transition-colors">{{ $pet['nickname'] }}</h4>
                                                <p class="text-sm text-carob-500 font-medium">
                                                    {{ $pet['breed'] ?? 'Unknown Breed' }} • {{ $pet['species'] ?? 'Pet' }}
                                                </p>
                                            </div>

                                            <div class="grid grid-cols-2 gap-2 mt-auto text-sm">
                                                @if($pet['age'])
                                                    <div class="flex items-center gap-2 text-carob-600 bg-gray-50 p-2 rounded-xl">
                                                        <i data-lucide="calendar" class="w-3.5 h-3.5 {{ $scheme['text'] }}"></i>
                                                        <span class="truncate">{{ $pet['age'] }}</span>
                                                    </div>
                                                @endif
                                                @if($pet['weight'])
                                                    <div class="flex items-center gap-2 text-carob-600 bg-gray-50 p-2 rounded-xl">
                                                        <i data-lucide="weight" class="w-3.5 h-3.5 {{ $scheme['text'] }}"></i>
                                                        <span>{{ $pet['weight'] }} kg</span>
                                                    </div>
                                                @endif
                                                @if($pet['color'])
                                                    <div class="flex items-center gap-2 text-carob-600 bg-gray-50 p-2 rounded-xl col-span-2">
                                                        <i data-lucide="palette" class="w-3.5 h-3.5 {{ $scheme['text'] }}"></i>
                                                        <span class="truncate">{{ $pet['color'] }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white rounded-[2rem] p-12 text-center shadow-xl border-2 border-dashed border-gray-200">
                                <div class="w-24 h-24 bg-soft-linen-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                                    <i data-lucide="dog" class="w-12 h-12 text-carob-500"></i>
                                </div>
                                <h4 class="text-xl font-bold text-carob-900 mb-2">Belum ada anabul terdaftar</h4>
                                <p class="text-carob-500 mb-6">Wah, kandangnya masih kosong nih! Yuk daftarkan anabul kesayanganmu di klinik.</p>
                                <a href="https://wa.me/{{ config('clinic.whatsapp_number') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 bg-forest-moss-green-600 text-white rounded-xl font-bold hover:bg-forest-moss-green-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <i data-lucide="circle-plus" class="w-5 h-5 mr-2"></i>
                                    Hubungi Admin Klinik
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <!-- Not Registered Message (Joyful Error State) -->
                <div class="bg-white rounded-[3rem] shadow-2xl p-12 text-center max-w-3xl mx-auto relative overflow-hidden animate-bounce-in">
                    <!-- Background Decorations -->
                    <div class="absolute top-0 left-0 w-full h-4 bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400"></div>
                    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-yellow-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

                    <div class="relative z-10">
                        <div class="w-32 h-32 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg animate-pulse">
                            <i data-lucide="search-x" class="w-16 h-16 text-yellow-600"></i>
                        </div>
                        
                        <h2 class="text-3xl font-bold text-carob-900 mb-4 font-heading">Oops! Akun Belum Terhubung</h2>
                        <p class="text-carob-600 mb-8 max-w-xl mx-auto text-lg leading-relaxed">
                            Sepertinya email <span class="font-bold text-forest-moss-green-600 bg-forest-moss-green-50 px-2 py-1 rounded-lg">{{ $user->email }}</span> belum terdaftar di sistem Digitail kami. Jangan khawatir, mari kita hubungkan! 🔗
                        </p>
                        
                        <div class="bg-soft-linen-50 rounded-[2rem] p-8 max-w-2xl mx-auto mb-8 border-2 border-dashed border-soft-linen-200">
                            <h3 class="font-bold text-carob-900 mb-6 flex items-center justify-center text-lg">
                                <i data-lucide="sparkles" class="w-5 h-5 mr-2 text-yellow-500 fill-current"></i>
                                Cara Mudah Bergabung
                            </h3>
                            <div class="grid gap-4 text-left">
                                <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                    <div class="w-8 h-8 bg-forest-moss-green-100 rounded-full flex items-center justify-center flex-shrink-0 text-forest-moss-green-600 font-bold">1</div>
                                    <div>
                                        <p class="font-bold text-carob-800">Hubungi Klinik</p>
                                        <p class="text-sm text-carob-500">Chat admin kami via WhatsApp atau telepon.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                    <div class="w-8 h-8 bg-forest-moss-green-100 rounded-full flex items-center justify-center flex-shrink-0 text-forest-moss-green-600 font-bold">2</div>
                                    <div>
                                        <p class="font-bold text-carob-800">Konfirmasi Email</p>
                                        <p class="text-sm text-carob-500">Sebutkan email Anda: <strong>{{ $user->email }}</strong></p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                    <div class="w-8 h-8 bg-forest-moss-green-100 rounded-full flex items-center justify-center flex-shrink-0 text-forest-moss-green-600 font-bold">3</div>
                                    <div>
                                        <p class="font-bold text-carob-800">Selesai!</p>
                                        <p class="text-sm text-carob-500">Refresh halaman ini dan profil Anda akan muncul.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="https://wa.me/{{ config('clinic.whatsapp_number') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-4 bg-green-500 text-white rounded-2xl hover:bg-green-600 transition-all duration-300 font-bold shadow-lg hover:shadow-green-200 hover:-translate-y-1 group">
                                <i data-lucide="message-circle" class="w-6 h-6 mr-2 group-hover:animate-bounce"></i>
                                Chat WhatsApp
                            </a>
                            <a href="tel:+6281219088899" class="inline-flex items-center justify-center px-8 py-4 bg-white text-carob-700 border-2 border-gray-100 rounded-2xl hover:bg-gray-50 transition-all duration-300 font-bold shadow-lg hover:shadow-xl hover:-translate-y-1">
                                <i data-lucide="phone" class="w-6 h-6 mr-2"></i>
                                Customer Care
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Back to Home Button -->
            <div class="text-center mt-12 mb-8">
                <a href="/" class="inline-flex items-center text-carob-500 hover:text-forest-moss-green-600 transition-all duration-300 font-medium group bg-white/50 px-6 py-3 rounded-full hover:bg-white hover:shadow-md">
                    <i data-lucide="arrow-left" class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection