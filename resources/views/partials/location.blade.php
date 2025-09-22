{{-- Location Section --}}
<section id="lokasi" class="relative py-20 overflow-hidden">
    {{-- Background with gradient and blur effects --}}
    <div class="absolute inset-0 bg-gradient-to-br from-matcha-50 via-chai-50 to-matcha-100"></div>
    <div class="absolute top-10 left-10 w-72 h-72 bg-chai-200/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-matcha-200/20 rounded-full blur-3xl"></div>
    <div class="absolute inset-0 backdrop-blur-sm"></div>

    <div class="relative max-w-7xl mx-auto px-6 z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-chai-400 to-chai-500 rounded-full mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-carob-800 mb-4">
                {{ __('messages.location_title') }}
            </h2>
            <p class="text-xl text-carob-600 max-w-2xl mx-auto">
                {{ __('messages.location_subtitle') }}
            </p>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid lg:grid-cols-3 gap-8 mb-16">
            {{-- Map Section --}}
            <div class="lg:col-span-2">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
                    <div class="aspect-video bg-gray-100 relative">
                        {{-- Placeholder for interactive map --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-green-100 to-yellow-100">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-red-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-600 font-medium">Pet Wellness Kemang</p>
                                <p class="text-sm text-gray-500">Jl. Kemang Raya No. 123</p>
                            </div>
                        </div>
                        {{-- Interactive elements overlay --}}
                        <div class="absolute top-4 left-4">
                            <button class="bg-white/90 backdrop-blur-sm px-3 py-2 rounded-lg shadow-md text-sm font-medium text-gray-700 hover:bg-white transition-colors">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                Petunjuk Arah
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Information --}}
            <div class="space-y-6">
                {{-- Contact Card --}}
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 border border-white/20">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-matcha-400 to-matcha-500 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-carob-800">{{ __('messages.information') }}</h3>
                    </div>

                    <div class="space-y-4">
                        {{-- Address --}}
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-matcha-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <svg class="w-4 h-4 text-matcha-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-carob-800">{{ __('messages.address') }}</p>
                                <p class="text-carob-600 text-sm">Jl. Kemang Raya No. 123, Kemang, Jakarta Selatan 12560</p>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-matcha-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <svg class="w-4 h-4 text-matcha-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-carob-800">{{ __('messages.phone') }}</p>
                                <p class="text-carob-600 text-sm">+62 21 7719 8888</p>
                            </div>
                        </div>

                        {{-- Hours --}}
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-matcha-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <svg class="w-4 h-4 text-matcha-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-carob-800">{{ __('messages.opening_hours') }}</p>
                                <p class="text-carob-600 text-sm">{{ __('messages.monday_friday') }}: 08:00 - 20:00</p>
                                <p class="text-carob-600 text-sm">{{ __('messages.saturday_sunday') }}: 09:00 - 18:00</p>
                            </div>
                        </div>
                    </div>

                    {{-- Call Button --}}
                    <button class="w-full mt-6 bg-gradient-to-r from-matcha-500 to-matcha-600 text-white py-3 rounded-xl font-semibold hover:from-matcha-600 hover:to-matcha-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        {{ __('messages.call') }}
                    </button>
                </div>
            </div>
        </div>

        {{-- Facilities and Nearby Locations --}}
        <div class="grid lg:grid-cols-2 gap-8">
            {{-- Facilities --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-matcha-400 to-matcha-500 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-carob-800">Fasilitas</h3>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center p-3 bg-chai-50 rounded-xl">
                        <div class="w-8 h-8 bg-chai-200 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-chai-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-carob-700">Parkir Gratis Tersedia</span>
                    </div>

                    <div class="flex items-center p-3 bg-chai-50 rounded-xl">
                        <div class="w-8 h-8 bg-chai-200 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-chai-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-carob-700">Fasilitas Ber-AC</span>
                    </div>

                    <div class="flex items-center p-3 bg-chai-50 rounded-xl">
                        <div class="w-8 h-8 bg-chai-200 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-chai-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-carob-700">WiFi Tersedia</span>
                    </div>

                    <div class="flex items-center p-3 bg-chai-50 rounded-xl">
                        <div class="w-8 h-8 bg-chai-200 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-chai-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v0a2 2 0 002-2h6.5l1 1H21l-1-1v0a2 2 0 00-2-2H5a2 2 0 00-2 2v0z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-carob-700">Kafe Ramah Hewan</span>
                    </div>

                    <div class="flex items-center p-3 bg-matcha-50 rounded-xl col-span-2">
                        <div class="w-8 h-8 bg-matcha-200 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-matcha-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-carob-700">Layanan Darurat</span>
                            <p class="text-xs text-carob-500">Staf Profesional</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Nearby Locations --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-matcha-400 to-matcha-500 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-carob-800">Tempat Terdekat</h3>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center p-4 bg-matcha-50 rounded-xl">
                        <div class="w-10 h-10 bg-matcha-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-sm font-bold text-matcha-600">5</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-carob-800">Kemang Village Mall</p>
                            <p class="text-sm text-carob-500">(5 menit jalan kaki)</p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-matcha-50 rounded-xl">
                        <div class="w-10 h-10 bg-matcha-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-sm font-bold text-matcha-600">3</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-carob-800">Kemang Icon</p>
                            <p class="text-sm text-carob-500">(3 menit jalan kaki)</p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-matcha-50 rounded-xl">
                        <div class="w-10 h-10 bg-matcha-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-sm font-bold text-matcha-600">10</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-carob-800">Taman Botani Bangka</p>
                            <p class="text-sm text-carob-500">(10 menit berkendara)</p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-matcha-50 rounded-xl">
                        <div class="w-10 h-10 bg-matcha-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-sm font-bold text-matcha-600">8</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-carob-800">Pasar Cipete</p>
                            <p class="text-sm text-carob-500">(8 menit berkendara)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="mt-16 text-center">
            <div class="bg-gradient-to-r from-chai-500 to-matcha-500 rounded-3xl p-8 text-white">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Kunjungi Kami Hari Ini</h3>
                <p class="text-lg mb-6 opacity-90">Rasakan layanan perawatan hewan terbaik di area Kemang dengan staf profesional dan fasilitas modern</p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-white text-chai-600 px-8 py-3 rounded-xl font-semibold hover:bg-almond-50 transition-colors shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        Navigasi
                    </button>
                    <button class="bg-white/20 backdrop-blur-sm text-white px-8 py-3 rounded-xl font-semibold hover:bg-white/30 transition-colors border border-white/30">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Layanan Kami
                    </button>
                </div>
            </div>
        </div>

        {{-- Operating Hours Notice --}}
        <div class="mt-8 flex items-center justify-center">
            <div class="bg-matcha-100 border border-matcha-200 rounded-xl px-6 py-3 flex items-center">
                <svg class="w-5 h-5 text-matcha-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-matcha-800 font-medium">Kami buka setiap hari dengan jam operasional fleksibel sesuai jadwal Anda</span>
            </div>
        </div>
    </div>
</section>