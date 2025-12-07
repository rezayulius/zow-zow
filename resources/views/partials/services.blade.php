<!-- Health Section -->
<section id="health" class="py-16 md:py-24 lg:py-32 bg-gradient-to-br from-matcha-50 via-white to-chai-50">
    <div class="max-w-7xl mx-auto px-3 sm:px-6">
        <div class="relative text-center mb-10">
            <div
                class="absolute -top-6 -left-6 w-32 h-32 rounded-full bg-[radial-gradient(ellipse_at_center,rgba(56,178,88,0.25),transparent_60%)] blur-md -z-10">
            </div>
            <div
                class="absolute -bottom-6 -right-8 w-40 h-40 rounded-full bg-[radial-gradient(ellipse_at_center,rgba(217,119,6,0.18),transparent_60%)] blur-md -z-10">
            </div>

            <div
                class="inline-flex items-center bg-matcha-600 text-white px-6 py-2 rounded-full text-sm font-medium mb-5 shadow-sm">
                <i data-lucide="stethoscope" class="text-lg mr-2 w-5 h-5"></i>
                Comprehensive Veterinary Care
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold text-carob-900 mb-3 font-heading leading-tight tracking-tight">
                {{ __('messages.health') }}
            </h2>
            <p class="text-base sm:text-lg text-carob-600 max-w-2xl mx-auto leading-relaxed mb-6">
                Pemeriksaan berkala, vaksinasi, diagnosa laboratorium, dan telehealth untuk kesehatan optimal.
            </p>

            <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-8">
                <span
                    class="inline-flex items-center bg-matcha-50 text-matcha-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-matcha-200">
                    <i data-lucide="zap" class="w-4 h-4 mr-2"></i> Same-day care
                </span>
                <span
                    class="inline-flex items-center bg-chai-50 text-chai-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-chai-200">
                    <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i> Certified vets
                </span>
                <span
                    class="inline-flex items-center bg-pistache-50 text-pistache-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-pistache-200">
                    <i data-lucide="flask-conical" class="w-4 h-4 mr-2"></i> Modern lab
                </span>
            </div>
        </div>

        <!-- Health Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($healthServices as $index => $service)
                @php
                    $colors = ['matcha', 'chai', 'pistache'];
                    $color = $colors[$index % 3];
                    $badges = ['POPULAR', 'ESSENTIAL', 'PREMIUM'];
                    $badge = $badges[$index % 3];

                    // Default image berdasarkan kategori Health
                    $defaultImages = [
                        'https://images.unsplash.com/photo-1576201836106-db1758fd1c97?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Konsultasi
                        'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', // Vaksinasi
                        'https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'  // Medical
                    ];
                    $defaultImage = $defaultImages[$index % 3];

                    // Features dari database atau fallback ke default
                    $features = $service->features ?? [];

                    // Fallback jika features kosong
                    if (empty($features)) {
                        if (str_contains(strtolower($service->title), 'konsultasi')) {
                            $features = ['Pemeriksaan kesehatan lengkap', 'Konsultasi dokter berpengalaman', 'Diagnosis akurat'];
                        } elseif (str_contains(strtolower($service->title), 'vaksin')) {
                            $features = ['Vaksin inti & booster', 'Sertifikat vaksinasi', 'Follow-up kesehatan'];
                        } else {
                            $features = ['Perawatan profesional', 'Teknologi modern', 'Hasil terjamin'];
                        }
                    }
                @endphp
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group flex flex-col h-full {{ $index > 0 ? 'border border-' . $color . '-100' : '' }}">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $service->image ? asset('storage/' . $service->image) : $defaultImage }}"
                            alt="{{ $service->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-{{ $color }}-400/{{ $index === 0 ? '80' : '70' }} to-{{ $color }}-600/{{ $index === 0 ? '80' : '70' }}">
                        </div>
                        <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-white text-xs font-medium">{{ $badge }}</span>
                        </div>
                        <div class="absolute bottom-4 right-4 bg-white/20 backdrop-blur-sm rounded-full p-2">
                            <i data-lucide="{{ $service->icon ?: 'heart' }}" class="text-white text-sm w-4 h-4"></i>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-carob-900 mb-1">{{ $service->title }}</h3>
                        <p class="text-chai-700 font-semibold text-sm mb-2">Rp
                            {{ number_format($service->price, 0, ',', '.') }}
                        </p>
                        <p class="text-carob-600 text-sm mb-4 leading-relaxed">
                            {{ $service->description }}
                        </p>
                        <ul class="space-y-2 mb-6 flex-grow">
                            @foreach($features as $feature)
                                <li class="flex items-center text-sm text-carob-600">
                                    <span
                                        class="w-4 h-4 bg-{{ $color }}-500 rounded-full mr-3 flex items-center justify-center">
                                        <i data-lucide="check" class="text-white text-xs w-3 h-3"></i>
                                    </span>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="#booking"
                            class="w-full bg-{{ $color }}-500 text-white py-3 rounded-xl hover:bg-{{ $color }}-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 font-semibold mt-auto shadow-lg text-center block scroll-smooth">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            @empty
                <!-- Fallback content if no health services -->
                <div class="col-span-full text-center py-8">
                    <p class="text-carob-600">Belum ada layanan kesehatan tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Wellness Section -->
<section id="wellness" class="py-16 md:py-24 lg:py-32 bg-gradient-to-br from-almond-50 via-vanilla-50 to-chai-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="relative text-center mb-10">
            <div
                class="absolute -top-8 -right-10 w-36 h-36 rounded-full bg-[radial-gradient(ellipse_at_center,rgba(234,179,8,0.18),transparent_60%)] blur-md -z-10">
            </div>
            <div
                class="absolute -bottom-6 -left-8 w-44 h-44 rounded-full bg-[radial-gradient(ellipse_at_center,rgba(244,114,182,0.12),transparent_60%)] blur-md -z-10">
            </div>

            <div
                class="inline-flex items-center bg-chai-600 text-white px-6 py-2 rounded-full text-sm font-medium mb-5 shadow-sm">
                <i data-lucide="sparkles" class="text-lg mr-2 w-5 h-5"></i>
                Premium Wellness & Lifestyle
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold text-carob-900 mb-3 font-heading leading-tight tracking-tight">
                {{ __('messages.wellness') }}
            </h2>
            <p class="text-base sm:text-lg text-carob-600 max-w-2xl mx-auto leading-relaxed mb-6">
                Grooming premium, hotel/daycare nyaman, dan cafe ramah hewan untuk kebahagiaan maksimal.
            </p>

            <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-8">
                <span
                    class="inline-flex items-center bg-vanilla-50 text-chai-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-chai-200">
                    <i data-lucide="wand" class="w-4 h-4 mr-2"></i> Grooming premium
                </span>
                <span
                    class="inline-flex items-center bg-almond-50 text-carob-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-carob-200">
                    <i data-lucide="bed" class="w-4 h-4 mr-2"></i> Hotel & daycare
                </span>
                <span
                    class="inline-flex items-center bg-chai-50 text-chai-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-chai-200">
                    <i data-lucide="coffee" class="w-4 h-4 mr-2"></i> Cafe & social
                </span>
            </div>
        </div>

        <!-- Wellness Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
            @forelse($wellnessServices as $index => $service)
                @php
                    $colors = ['chai', 'carob', 'pistache'];
                    $color = $colors[$index % 3];
                    $badges = ['TRENDING', 'PREMIUM', 'RELAXING'];
                    $badge = $badges[$index % 3];

                    // Default image berdasarkan kategori Wellness
                    $defaultImages = [
                        'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', // Grooming
                        'https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', // Hotel
                        'https://images.unsplash.com/photo-1574144611937-0df059b5ef3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'  // Cafe
                    ];
                    $defaultImage = $defaultImages[$index % 3];

                    // Features dari database atau fallback ke default
                    $features = $service->features ?? [];

                    // Fallback jika features kosong
                    if (empty($features)) {
                        if (str_contains(strtolower($service->title), 'grooming') || str_contains(strtolower($service->title), 'salon')) {
                            $features = ['Grooming lengkap', 'Potong kuku profesional', 'Mandi aromaterapi'];
                        } elseif (str_contains(strtolower($service->title), 'hotel') || str_contains(strtolower($service->title), 'daycare')) {
                            $features = ['Pengawasan 24/7', 'Kamar ber-AC', 'Layanan makan premium'];
                        } elseif (str_contains(strtolower($service->title), 'cafe') || str_contains(strtolower($service->title), 'kafe')) {
                            $features = ['Menu spesial hewan', 'Tempat bermain luas', 'WiFi gratis'];
                        } else {
                            $features = ['Layanan berkualitas', 'Fasilitas modern', 'Pengalaman terbaik'];
                        }
                    }
                @endphp
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $service->image ? asset('storage/' . $service->image) : $defaultImage }}"
                            alt="{{ $service->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-{{ $color }}-400/80 to-{{ $color }}-600/80">
                        </div>
                        <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-white text-xs font-medium">{{ $badge }}</span>
                        </div>
                        <div class="absolute bottom-4 right-4 bg-white/20 backdrop-blur-sm rounded-full p-2">
                            <i data-lucide="{{ $service->icon ?: 'sparkles' }}" class="text-white text-sm w-4 h-4"></i>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-carob-900 mb-1">{{ $service->title }}</h3>
                        <p class="text-chai-700 font-semibold text-sm mb-2">Rp
                            {{ number_format($service->price, 0, ',', '.') }}
                        </p>
                        <p class="text-carob-600 text-sm mb-4 leading-relaxed">
                            {{ $service->description }}
                        </p>
                        <ul class="space-y-2 mb-6 flex-grow">
                            @foreach($features as $feature)
                                <li class="flex items-center text-sm text-carob-600">
                                    <span
                                        class="w-4 h-4 bg-{{ $color }}-500 rounded-full mr-3 flex items-center justify-center">
                                        <i data-lucide="check" class="text-white text-xs w-3 h-3"></i>
                                    </span>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="#booking"
                            class="w-full bg-{{ $color }}-500 text-white py-3 rounded-xl hover:bg-{{ $color }}-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 font-semibold mt-auto shadow-lg text-center block scroll-smooth">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            @empty
                <!-- Fallback content if no wellness services -->
                <div class="col-span-full text-center py-8">
                    <p class="text-carob-600">Belum ada layanan wellness tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Layanan Kami Section -->
<section id="layanan" class="py-16 md:py-24 lg:py-32 bg-gradient-to-br from-almond-50 via-vanilla-50 to-chai-50">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Premium Services Badge -->
        <div class="text-center mb-8 hidden">
            <div
                class="inline-flex items-center bg-chai-500 text-white px-6 py-2 rounded-full text-sm font-medium mb-6">
                <i data-lucide="trophy" class="text-lg mr-2 w-5 h-5"></i>
                Premium Services
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold text-carob-900 mb-6 font-heading leading-tight tracking-tight">
                Layanan Kami
            </h2>
            <p class="text-lg text-carob-600 max-w-2xl mx-auto leading-relaxed mb-12">
                Kami menyediakan perawatan dan layanan komprehensif untuk hewan kesayangan Anda,
                memastikan kesehatan, kebahagiaan, dan kesejahteraan mereka.
            </p>
        </div>

        <!-- Service Highlights Cards -->
        <div class="grid md:grid-cols-3 gap-8 mb-4 hidden">
            <!-- Quick Service Card -->
            <div
                class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group border border-chai-100">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-chai-400 to-chai-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="zap" class="text-white text-2xl w-8 h-8"></i>
                </div>
                <h3
                    class="text-lg font-semibold text-carob-900 mb-2 group-hover:text-chai-600 transition-colors duration-300">
                    Quick Service</h3>
                <p class="text-carob-600 text-sm">Same day appointments</p>
                <div
                    class="mt-4 h-1 bg-gradient-to-r from-chai-400 to-chai-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>

            <!-- Guaranteed Safety Card -->
            <div
                class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group border border-matcha-100">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-matcha-400 to-matcha-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="shield-check" class="text-white text-2xl w-8 h-8"></i>
                </div>
                <h3
                    class="text-lg font-semibold text-carob-900 mb-2 group-hover:text-matcha-600 transition-colors duration-300">
                    Guaranteed Safety</h3>
                <p class="text-carob-600 text-sm">Certified professionals</p>
                <div
                    class="mt-4 h-1 bg-gradient-to-r from-matcha-400 to-matcha-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>

            <!-- Award Winning Card -->
            <div
                class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group border border-carob-100">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-carob-400 to-carob-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="trophy" class="text-white text-2xl w-8 h-8"></i>
                </div>
                <h3
                    class="text-lg font-semibold text-carob-900 mb-2 group-hover:text-carob-600 transition-colors duration-300">
                    Award Winning</h3>
                <p class="text-carob-600 text-sm">Best pet care 2024</p>
                <div
                    class="mt-4 h-1 bg-gradient-to-r from-carob-400 to-carob-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>
        </div>

        <!-- Main Service Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-4 hidden">
            <!-- Klinik Hewan -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group flex flex-col h-full">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1576201836106-db1758fd1c97?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Klinik Hewan"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-matcha-400/80 to-matcha-600/80"></div>
                    <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1">
                        <span class="text-white text-xs font-medium">POPULAR</span>
                    </div>
                    <div class="absolute bottom-4 right-4 bg-white/20 backdrop-blur-sm rounded-full p-2">
                        <i data-lucide="heart" class="text-white text-sm w-4 h-4"></i>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-carob-900 mb-3">Klinik Hewan</h3>
                    <p class="text-carob-600 text-sm mb-4 leading-relaxed">
                        Perawatan dokter hewan profesional dengan fasilitas modern.
                    </p>
                    <ul class="space-y-2 mb-6 flex-grow">
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-matcha-500 rounded-full mr-3 flex items-center justify-center">
                                <i data-lucide="check" class="text-white text-xs w-3 h-3"></i>
                            </span>
                            Pemeriksaan kesehatan
                        </li>
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-matcha-500 rounded-full mr-3 flex items-center justify-center">
                                <i data-lucide="check" class="text-white text-xs w-3 h-3"></i>
                            </span>
                            Vaksinasi lengkap
                        </li>
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-matcha-500 rounded-full mr-3 flex items-center justify-center">
                                <i data-lucide="check" class="text-white text-xs w-3 h-3"></i>
                            </span>
                            Operasi
                        </li>
                    </ul>
                    <button
                        class="w-full bg-matcha-500 text-white py-3 rounded-xl hover:bg-matcha-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 font-semibold mt-auto shadow-lg">
                        Pesan Sekarang
                    </button>
                </div>
            </div>

            <!-- Salon Hewan -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group flex flex-col h-full">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Salon Hewan"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-chai-400/80 to-chai-600/80"></div>
                    <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1">
                        <span class="text-white text-xs font-medium">QUICK & EASY</span>
                    </div>
                    <div class="absolute bottom-4 right-4 bg-white/20 backdrop-blur-sm rounded-full p-2">
                        <i data-lucide="sparkles" class="text-white text-sm w-4 h-4"></i>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-carob-900 mb-3">Salon Hewan</h3>
                    <p class="text-carob-600 text-sm mb-4 leading-relaxed">
                        Layanan grooming profesional untuk kebersihan hewan Anda.
                    </p>
                    <ul class="space-y-2 mb-6 flex-grow">
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-chai-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            Grooming lengkap
                        </li>
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-chai-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            Potong kuku
                        </li>
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-chai-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            Mandi
                        </li>
                    </ul>
                    <button
                        class="w-full bg-chai-500 text-white py-3 rounded-xl hover:bg-chai-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 font-semibold mt-auto shadow-lg">
                        Pesan Sekarang
                    </button>
                </div>
            </div>

            <!-- Hotel Hewan -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group flex flex-col h-full">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Hotel Hewan"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-carob-400/80 to-carob-600/80"></div>
                    <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1">
                        <span class="text-white text-xs font-medium">SAFE & COZY</span>
                    </div>
                    <div class="absolute bottom-4 right-4 bg-white/20 backdrop-blur-sm rounded-full p-2">
                        <span class="text-white text-sm">🛏️</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-carob-900 mb-3">Hotel Hewan</h3>
                    <p class="text-carob-600 text-sm mb-4 leading-relaxed">
                        Penginapan yang aman dan nyaman untuk hewan Anda.
                    </p>
                    <ul class="space-y-2 mb-6 flex-grow">
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-carob-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            Pengawasan 24/7
                        </li>
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-carob-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            Kamar ber-AC
                        </li>
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-carob-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            Layanan Makan
                        </li>
                    </ul>
                    <button
                        class="w-full bg-carob-500 text-white py-3 rounded-xl hover:bg-carob-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 font-semibold mt-auto shadow-lg">
                        Pesan Sekarang
                    </button>
                </div>
            </div>

            <!-- Kafe Hewan -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group flex flex-col h-full">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1574144611937-0df059b5ef3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Kafe Hewan"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-pistache-400/80 to-pistache-600/80"></div>
                    <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1">
                        <span class="text-white text-xs font-medium">RELAX & ENJOY</span>
                    </div>
                    <div class="absolute bottom-4 right-4 bg-white/20 backdrop-blur-sm rounded-full p-2">
                        <span class="text-white text-sm">🐾</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-carob-900 mb-3">Kafe Hewan</h3>
                    <p class="text-carob-600 text-sm mb-4 leading-relaxed">
                        Bersantai dengan hewan Anda sambil menikmati kopi.
                    </p>
                    <ul class="space-y-2 mb-6 flex-grow">
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-pistache-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            Menu Spesial Hewan
                        </li>
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-pistache-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            Tempat Bermain
                        </li>
                        <li class="flex items-center text-sm text-carob-600">
                            <span class="w-4 h-4 bg-pistache-500 rounded-full mr-3 flex items-center justify-center">
                                <span class="text-white text-xs">✓</span>
                            </span>
                            WiFi Gratis
                        </li>
                    </ul>
                    <button
                        class="w-full bg-pistache-500 text-white py-3 rounded-xl hover:bg-pistache-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 font-semibold mt-auto shadow-lg">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>

        <!-- Custom Care Plan Section -->
        <div class="bg-gradient-to-r from-carob-600 to-carob-700 rounded-2xl p-8 text-center text-white hidden">
            <h3 class="text-2xl font-bold mb-4">Need a Custom Care Plan?</h3>
            <p class="text-carob-100 mb-6 max-w-2xl mx-auto">
                Let our experts create a personalized wellness program for your pet
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button
                    class="relative overflow-hidden bg-white text-carob-700 px-8 py-3 rounded-xl hover:bg-almond-50 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold shadow-lg">
                    <span class="mr-2">📅</span>
                    Schedule Consultation
                </button>
                <button
                    class="relative overflow-hidden flex items-center space-x-2 text-carob-100 hover:text-white transition-all duration-300 bg-transparent border border-carob-100 hover:border-white px-8 py-3 rounded-xl hover:bg-carob-100/10 hover:-translate-y-1 hover:shadow-xl font-semibold shadow-lg">
                    <span class="text-sm">📞</span>
                    <span class="text-sm">Call us: (021) 123-4567</span>
                </button>
            </div>
        </div>

        <!-- Booking Section -->
        <div id="booking" class="bg-gradient-to-br from-matcha-50 via-white to-chai-50 rounded-2xl p-8 mt-4">
            <div class="relative text-center mb-10">
                <div
                    class="absolute -top-10 -left-10 w-40 h-40 rounded-full bg-[radial-gradient(ellipse_at_center,rgba(16,185,129,0.12),transparent_60%)] blur-md -z-10">
                </div>
                <div
                    class="absolute -bottom-6 -right-8 w-44 h-44 rounded-full bg-[radial-gradient(ellipse_at_center,rgba(234,179,8,0.14),transparent_60%)] blur-md -z-10">
                </div>

                <div
                    class="inline-flex items-center bg-chai-600 text-white px-6 py-2 rounded-full text-sm font-semibold shadow-sm mb-5">
                    <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                    Quick Booking
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold text-carob-900 font-heading mb-3">
                    Mudah Booking untuk Pet Kesayangan
                </h3>
                <p class="text-base sm:text-lg text-carob-600 max-w-2xl mx-auto leading-relaxed mb-6">
                    Jadwalkan appointment dengan cepat, bayar mudah, dan dukungan WhatsApp.
                </p>
                <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-8">
                    <span
                        class="inline-flex items-center bg-almond-50 text-carob-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-carob-200">
                        <i data-lucide="zap" class="w-4 h-4 mr-2"></i> Cepat
                    </span>
                    <span
                        class="inline-flex items-center bg-matcha-50 text-matcha-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-matcha-200">
                        <i data-lucide="layout-panel-top" class="w-4 h-4 mr-2"></i> Multi-step
                    </span>
                    <span
                        class="inline-flex items-center bg-chai-50 text-chai-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-chai-200">
                        <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i> WhatsApp
                    </span>
                </div>
            </div>

            <!-- Doctor Gallery Section -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-matcha-100 mb-6">
                <!-- Header -->
                <div class="flex items-center mb-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-matcha-400 to-matcha-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                        <i data-lucide="user-check" class="text-white w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-carob-900">Tim Dokter Profesional</h4>
                        <p class="text-carob-600 text-sm">Pilih dokter dan lihat jadwal ketersediaan mereka</p>
                    </div>
                </div>

                <!-- Doctors Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $colorSchemes = [
                            ['from' => 'matcha', 'to' => 'matcha'],
                            ['from' => 'chai', 'to' => 'chai'],
                            ['from' => 'pistache', 'to' => 'pistache'],
                            ['from' => 'carob', 'to' => 'carob']
                        ];
                    @endphp

                    @forelse($vets ?? [] as $index => $vet)
                        @php
                            $scheme = $colorSchemes[$index % 4];
                            $fromColor = $scheme['from'];
                            $toColor = $scheme['to'];
                            $isAvailable = $vet['is_available_for_appointments'] ?? false;
                        @endphp

                        <!-- Doctor Card -->
                        <div class="doctor-card group">
                            <div class="bg-gradient-to-br from-{{ $fromColor }}-50 to-{{ $toColor }}-100 rounded-2xl p-5 border border-{{ $fromColor }}-200 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:-translate-y-2"
                                onclick="window.open('{{ $vet['public_appointment_link'] ?? '#' }}', '_blank')">
                                <!-- Profile Image -->
                                <div class="relative mb-4">
                                    @if(!empty($vet['avatar']) && $vet['avatar'] !== 'https://developer.digitail.io/images/profilepic.jpg')
                                        <img src="{{ $vet['avatar'] }}" alt="{{ $vet['full_name'] ?? 'Doctor' }}"
                                            class="w-20 h-20 mx-auto rounded-full object-cover shadow-lg group-hover:scale-110 transition-transform duration-300 border-2 border-white">
                                    @else
                                        <div
                                            class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-{{ $fromColor }}-400 to-{{ $toColor }}-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <i data-lucide="user" class="text-white w-10 h-10"></i>
                                        </div>
                                    @endif

                                    <!-- Availability Badge -->
                                    <div
                                        class="absolute -bottom-1 -right-1 w-6 h-6 bg-{{ $isAvailable ? 'green' : 'yellow' }}-500 rounded-full border-2 border-white flex items-center justify-center">
                                        <i data-lucide="{{ $isAvailable ? 'check' : 'clock' }}"
                                            class="text-white w-3 h-3"></i>
                                    </div>
                                </div>

                                <!-- Doctor Info -->
                                <div class="text-center">
                                    <h5 class="font-bold text-carob-900 mb-1">
                                        {{ $vet['name_with_title'] ?? $vet['full_name'] ?? 'Dokter' }}
                                    </h5>
                                    <p class="text-{{ $fromColor }}-700 text-sm font-medium mb-3">
                                        {{ $vet['job_title'] ?? 'Veterinarian' }}
                                        @if(!empty($vet['type']))
                                            <span class="text-xs">({{ ucfirst($vet['type']) }})</span>
                                        @endif
                                    </p>

                                    <div class="flex items-center justify-center text-xs text-{{ $fromColor }}-600 mb-3">
                                        <i data-lucide="calendar-check" class="w-3 h-3 mr-1"></i>
                                        <span>{{ $isAvailable ? 'Tersedia untuk Appointment' : 'Jadwal Terbatas' }}</span>
                                    </div>

                                    @if(!empty($vet['public_appointment_link']))
                                        <div class="mt-3 pt-3 border-t border-{{ $fromColor }}-200">
                                            <div
                                                class="flex items-center justify-center text-xs text-{{ $fromColor }}-700 font-medium">
                                                <i data-lucide="external-link" class="w-3 h-3 mr-1"></i>
                                                <span>Klik untuk Booking Online</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback if no vets data -->
                        <div class="col-span-full text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="user-x" class="text-gray-400 w-8 h-8"></i>
                            </div>
                            <p class="text-gray-500">Data dokter sedang dimuat...</p>
                            <p class="text-sm text-gray-400 mt-2">Silakan refresh halaman atau hubungi kami untuk informasi
                                lebih lanjut</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Doctor Schedule Modal -->
            <div id="doctorModal" class="fixed inset-0 z-50 hidden">
                <!-- Backdrop with blur effect -->
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDoctorModal()"></div>

                <!-- Modal Content -->
                <div class="relative flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0"
                        id="modalContent">
                        <!-- Modal Header -->
                        <div class="bg-gradient-to-r from-matcha-500 to-chai-600 text-white p-6 relative">
                            <button onclick="closeDoctorModal()"
                                class="absolute top-4 right-4 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mr-4">
                                    <i data-lucide="user" class="w-8 h-8"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold" id="modalDoctorName">Dr. Ahmad Rizki</h3>
                                    <p class="text-white/80" id="modalDoctorSpecialty">Spesialis Bedah</p>
                                    <div class="flex items-center mt-2">
                                        <i data-lucide="star" class="w-4 h-4 mr-1 fill-current"></i>
                                        <span class="font-semibold" id="modalDoctorRating">4.8</span>
                                        <span class="mx-2">•</span>
                                        <span id="modalDoctorExperience">200+ operasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Body -->
                        <div class="p-6 max-h-[60vh] overflow-y-auto">
                            <div class="mb-6">
                                <h4 class="text-lg font-bold text-carob-900 mb-2">Jadwal Minggu Ini</h4>
                                <p class="text-gray-600 text-sm">21 - 27 Januari 2024</p>
                            </div>

                            <!-- Weekly Schedule -->
                            <div class="space-y-4" id="weeklySchedule">
                                <!-- Monday -->
                                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-matcha-100 to-chai-100 rounded-lg flex items-center justify-center mr-3">
                                                <span class="text-sm font-bold text-carob-900">SEN</span>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold text-carob-900">Senin, 22 Januari</h5>
                                                <p class="text-sm text-gray-600">Hari ini</p>
                                            </div>
                                        </div>
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Tersedia</span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">08:00 - 10:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">10:00 - 12:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                        <div
                                            class="bg-red-50 border border-red-200 rounded-lg p-2 text-center opacity-50">
                                            <div class="text-sm font-medium text-red-800">13:00 - 15:00</div>
                                            <div class="text-xs text-red-600">Operasi</div>
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">15:00 - 17:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tuesday -->
                                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-chai-100 to-matcha-100 rounded-lg flex items-center justify-center mr-3">
                                                <span class="text-sm font-bold text-carob-900">SEL</span>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold text-carob-900">Selasa, 23 Januari</h5>
                                                <p class="text-sm text-gray-600">Besok</p>
                                            </div>
                                        </div>
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Tersedia</span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">09:00 - 11:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">11:00 - 13:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">14:00 - 16:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">16:00 - 18:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Wednesday -->
                                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-pistache-100 to-chai-100 rounded-lg flex items-center justify-center mr-3">
                                                <span class="text-sm font-bold text-carob-900">RAB</span>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold text-carob-900">Rabu, 24 Januari</h5>
                                                <p class="text-sm text-gray-600">2 hari lagi</p>
                                            </div>
                                        </div>
                                        <span
                                            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">Terbatas</span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                        <div
                                            class="bg-red-50 border border-red-200 rounded-lg p-2 text-center opacity-50">
                                            <div class="text-sm font-medium text-red-800">08:00 - 12:00</div>
                                            <div class="text-xs text-red-600">Seminar</div>
                                        </div>
                                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-yellow-800">14:00 - 16:00</div>
                                            <div class="text-xs text-yellow-600">Terbatas</div>
                                        </div>
                                        <div
                                            class="bg-red-50 border border-red-200 rounded-lg p-2 text-center opacity-50">
                                            <div class="text-sm font-medium text-red-800">16:00 - 18:00</div>
                                            <div class="text-xs text-red-600">Penuh</div>
                                        </div>
                                        <div
                                            class="bg-gray-50 border border-gray-200 rounded-lg p-2 text-center opacity-50">
                                            <div class="text-sm font-medium text-gray-800">-</div>
                                            <div class="text-xs text-gray-600">-</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thursday -->
                                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-carob-100 to-chai-100 rounded-lg flex items-center justify-center mr-3">
                                                <span class="text-sm font-bold text-carob-900">KAM</span>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold text-carob-900">Kamis, 25 Januari</h5>
                                                <p class="text-sm text-gray-600">3 hari lagi</p>
                                            </div>
                                        </div>
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Tersedia</span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">08:00 - 10:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">10:00 - 12:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">13:00 - 15:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                            <div class="text-sm font-medium text-green-800">15:00 - 17:00</div>
                                            <div class="text-xs text-green-600">Tersedia</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Friday -->
                                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-orange-100 to-chai-100 rounded-lg flex items-center justify-center mr-3">
                                                <span class="text-sm font-bold text-carob-900">JUM</span>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold text-carob-900">Jumat, 26 Januari</h5>
                                                <p class="text-sm text-gray-600">4 hari lagi</p>
                                            </div>
                                        </div>
                                        <span
                                            class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">Libur</span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                        <div
                                            class="bg-gray-50 border border-gray-200 rounded-lg p-2 text-center opacity-50">
                                            <div class="text-sm font-medium text-gray-800">-</div>
                                            <div class="text-xs text-gray-600">Libur</div>
                                        </div>
                                        <div
                                            class="bg-gray-50 border border-gray-200 rounded-lg p-2 text-center opacity-50">
                                            <div class="text-sm font-medium text-gray-800">-</div>
                                            <div class="text-xs text-gray-600">Libur</div>
                                        </div>
                                        <div
                                            class="bg-gray-50 border border-gray-200 rounded-lg p-2 text-center opacity-50">
                                            <div class="text-sm font-medium text-gray-800">-</div>
                                            <div class="text-xs text-gray-600">Libur</div>
                                        </div>
                                        <div
                                            class="bg-gray-50 border border-gray-200 rounded-lg p-2 text-center opacity-50">
                                            <div class="text-sm font-medium text-gray-800">-</div>
                                            <div class="text-xs text-gray-600">Libur</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                            <div class="text-sm text-gray-600">
                                <i data-lucide="info" class="w-4 h-4 inline mr-1"></i>
                                Klik slot waktu untuk membuat janji temu
                            </div>
                            <div class="flex space-x-3">
                                <button onclick="closeDoctorModal()"
                                    class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                                    Tutup
                                </button>
                                <button
                                    class="px-6 py-2 bg-gradient-to-r from-matcha-500 to-chai-600 text-white rounded-lg hover:from-matcha-600 hover:to-chai-700 transition-all duration-300 font-medium">
                                    Buat Janji Temu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Booking Services -->
            <div class="bg-white rounded-2xl p-5 shadow-lg border border-chai-100">
                <!-- Header -->
                <div class="flex items-center mb-5">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-matcha-400 to-chai-500 rounded-xl flex items-center justify-center mr-3">
                        <i data-lucide="zap" class="text-white w-5 h-5"></i>
                    </div>
                    <h4 class="text-xl font-bold text-carob-900">Quick Booking Services</h4>
                </div>

                <!-- Services Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
                    <!-- Grooming Premium -->
                    <div
                        class="bg-gradient-to-r from-chai-50 to-vanilla-50 rounded-xl p-4 border border-chai-200 relative">
                        <div class="flex items-center justify-between mb-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-chai-400 to-chai-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="sparkles" class="text-white w-4 h-4"></i>
                            </div>
                            <span class="bg-chai-500 text-white text-xs px-2 py-1 rounded-full font-medium">NEW</span>
                        </div>
                        <h5 class="font-bold text-carob-900 mb-1">Grooming Premium</h5>
                        <p class="text-chai-700 font-semibold text-sm mb-2">Rp 100.000</p>
                        <button
                            class="quick-book-btn w-full bg-gradient-to-r from-chai-500 to-chai-600 text-white py-2 rounded-lg text-sm hover:from-chai-600 hover:to-chai-700 transition-colors font-medium"
                            data-service="grooming" aria-label="Book Grooming Premium" title="Book Grooming Premium">
                            Book Now
                        </button>
                    </div>

                    <!-- Konsultasi Dokter -->
                    <div class="bg-gradient-to-r from-matcha-50 to-matcha-100 rounded-xl p-4 border border-matcha-200">
                        <div class="flex items-center justify-between mb-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-matcha-400 to-matcha-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="stethoscope" class="text-white w-4 h-4"></i>
                            </div>
                            <span
                                class="bg-matcha-600 text-white text-xs px-2 py-1 rounded-full font-medium">Popular</span>
                        </div>
                        <h5 class="font-bold text-carob-900 mb-1">Konsultasi Dokter</h5>
                        <p class="text-matcha-700 font-semibold text-sm mb-2">Rp 150.000</p>
                        <button
                            class="quick-book-btn w-full bg-matcha-500 text-white py-2 rounded-lg text-sm hover:bg-matcha-600 transition-colors font-medium"
                            data-service="konsultasi" aria-label="Book Konsultasi Dokter"
                            title="Book Konsultasi Dokter">
                            Book Now
                        </button>
                    </div>

                    <!-- Vaksinasi Lengkap -->
                    <div
                        class="bg-gradient-to-r from-pistache-50 to-pistache-100 rounded-xl p-4 border border-pistache-200">
                        <div class="flex items-center justify-between mb-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-pistache-400 to-pistache-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="syringe" class="text-white w-4 h-4"></i>
                            </div>
                            <span
                                class="bg-pistache-600 text-white text-xs px-2 py-1 rounded-full font-medium">Essential</span>
                        </div>
                        <h5 class="font-bold text-carob-900 mb-1">Vaksinasi Lengkap</h5>
                        <p class="text-pistache-700 font-semibold text-sm mb-2">Rp 200.000</p>
                        <button
                            class="quick-book-btn w-full bg-pistache-500 text-white py-2 rounded-lg text-sm hover:bg-pistache-600 transition-colors font-medium"
                            data-service="vaksinasi" aria-label="Book Vaksinasi Lengkap" title="Book Vaksinasi Lengkap">
                            Book Now
                        </button>
                    </div>

                    <!-- Health Check-up -->
                    <div class="bg-gradient-to-r from-carob-50 to-carob-100 rounded-xl p-4 border border-carob-200">
                        <div class="flex items-center justify-between mb-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-carob-400 to-carob-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="search" class="text-white w-4 h-4"></i>
                            </div>
                            <span
                                class="bg-carob-600 text-white text-xs px-2 py-1 rounded-full font-medium">Trusted</span>
                        </div>
                        <h5 class="font-bold text-carob-900 mb-1">Health Check-up</h5>
                        <p class="text-carob-700 font-semibold text-sm mb-2">Rp 250.000</p>
                        <button
                            class="quick-book-btn w-full bg-carob-500 text-white py-2 rounded-lg text-sm hover:bg-carob-600 transition-colors font-medium"
                            data-service="checkup" aria-label="Book Health Check-up" title="Book Health Check-up">
                            Book Now
                        </button>
                    </div>
                </div>

                <!-- Modal Booking Form -Digitail Redirect -->
                <div id="bookingModal"
                    class="hidden fixed inset-0 z-50 flex items-start sm:items-center justify-center px-4 sm:px-8 xl:px-16 pb-6 sm:pb-6 pt-4 sm:pt-4"
                    role="dialog" aria-modal="true" aria-labelledby="bookingTitle" tabindex="-1">
                    <div id="bookingBackdrop" class="absolute inset-0 bg-carob-900/30 backdrop-blur-sm"
                        aria-hidden="true"></div>
                    <div id="bookingForm"
                        class="hidden mt-0 sm:mt-0 bg-white rounded-xl sm:rounded-3xl shadow-2xl border border-chai-100 ring-1 ring-chai-200 transform transition-all duration-300 ease-out motion-reduce:transition-none motion-reduce:transform-none opacity-0 translate-y-4 backdrop-blur-sm overflow-hidden mx-0 w-full mb-6 sm:mb-8 sm:max-w-[500px] md:max-w-[540px] lg:max-w-[600px] sm:mx-auto">
                        <!-- Form Header -->
                        <div
                            class="bg-gradient-to-br from-chai-50 to-matcha-50 text-center p-6 sm:p-8 border-b border-chai-100">
                            <div class="flex justify-end mb-4">
                                <button id="closeForm" type="button" aria-label="Tutup modal" title="Tutup modal"
                                    class="text-carob-400 hover:text-carob-600 transition-all duration-200 hover:scale-110 hover:bg-white/50 p-2 rounded-full focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-chai-400">
                                    <i data-lucide="x" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                                </button>
                            </div>
                            <div
                                class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-chai-500 to-chai-600 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <i data-lucide="calendar-plus" class="text-white w-8 h-8 sm:w-10 sm:h-10"></i>
                            </div>
                            <h2 id="bookingTitle" class="text-2xl sm:text-3xl font-bold text-carob-900 mb-3">Buat
                                Appointment</h2>
                            <p class="text-sm sm:text-base text-carob-600 mb-2">Jadwalkan layanan terbaik untuk hewan
                                peliharaan Anda</p>
                            <p class="text-xs sm:text-sm text-carob-500">Powered by Digitail Booking System</p>
                        </div>

                        <!-- Booking Content -->
                        <div class="p-6 sm:p-8">
                            <div
                                class="bg-gradient-to-br from-white to-chai-50 rounded-2xl p-6 sm:p-8 border-2 border-chai-200 mb-6">
                                <div class="flex items-start mb-4">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-matcha-400 to-matcha-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <i data-lucide="info" class="text-white w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-carob-900 mb-2">Sistem Booking Online</h3>
                                        <p class="text-sm text-carob-600">Anda akan diarahkan ke sistem booking online
                                            kami yang aman dan mudah digunakan.</p>
                                    </div>
                                </div>

                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center text-sm text-carob-700">
                                        <i data-lucide="check-circle"
                                            class="w-5 h-5 text-matcha-600 mr-3 flex-shrink-0"></i>
                                        <span>Pilih layanan yang Anda butuhkan</span>
                                    </div>
                                    <div class="flex items-center text-sm text-carob-700">
                                        <i data-lucide="check-circle"
                                            class="w-5 h-5 text-matcha-600 mr-3 flex-shrink-0"></i>
                                        <span>Tentukan waktu yang sesuai</span>
                                    </div>
                                    <div class="flex items-center text-sm text-carob-700">
                                        <i data-lucide="check-circle"
                                            class="w-5 h-5 text-matcha-600 mr-3 flex-shrink-0"></i>
                                        <span>Isi data hewan peliharaan Anda</span>
                                    </div>
                                    <div class="flex items-center text-sm text-carob-700">
                                        <i data-lucide="check-circle"
                                            class="w-5 h-5 text-matcha-600 mr-3 flex-shrink-0"></i>
                                        <span>Dapatkan konfirmasi langsung</span>
                                    </div>
                                </div>

                                <div
                                    class="bg-gradient-to-r from-pistache-50 to-chai-50 rounded-xl p-4 border border-pistache-200">
                                    <div class="flex items-start">
                                        <i data-lucide="shield-check"
                                            class="w-5 h-5 text-pistache-600 mr-2 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-xs text-carob-600">
                                            <strong class="text-carob-800">Aman & Terpercaya:</strong> Data Anda
                                            dilindungi dengan enkripsi tingkat tinggi
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <a href="https://developer.digitail.io/clinics/zowzowvetique-first?widget"
                                    target="_blank" rel="noopener noreferrer"
                                    class="block w-full px-6 py-4 bg-gradient-to-r from-chai-500 to-chai-600 text-white text-center rounded-xl hover:from-chai-600 hover:to-chai-700 hover:shadow-lg transition-all duration-300 font-semibold text-base sm:text-lg group">
                                    <span class="flex items-center justify-center">
                                        Lanjutkan ke Booking
                                        <i data-lucide="external-link"
                                            class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </span>
                                </a>

                                <button type="button" id="cancelBooking"
                                    class="w-full px-6 py-3 bg-carob-100 text-carob-700 text-center rounded-xl hover:bg-carob-200 transition-all duration-300 font-medium text-sm sm:text-base">
                                    Batal
                                </button>
                            </div>

                            <p class="text-xs text-center text-carob-500 mt-6">
                                Halaman booking akan terbuka di tab baru
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- Booking Form JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentStep = 1;
        const totalSteps = 3;

        // Elements
        const quickBookBtns = document.querySelectorAll('.quick-book-btn');
        const appointmentBtn = document.getElementById('appointmentBtn');
        const bookingForm = document.getElementById('bookingForm');
        const bookingModal = document.getElementById('bookingModal');
        const bookingBackdrop = document.getElementById('bookingBackdrop');
        const closeForm = document.getElementById('closeForm');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const progressBar = document.getElementById('progressBar');
        const currentStepSpan = document.getElementById('currentStep');

        // Touch interaction improvements for mobile
        function addTouchInteractions() {
            // Add touch feedback for buttons
            const buttons = document.querySelectorAll('button, .cursor-pointer');
            buttons.forEach(button => {
                button.addEventListener('touchstart', function () {
                    this.style.transform = 'scale(0.95)';
                    this.style.transition = 'transform 0.1s ease';
                });

                button.addEventListener('touchend', function () {
                    this.style.transform = 'scale(1)';
                });

                button.addEventListener('touchcancel', function () {
                    this.style.transform = 'scale(1)';
                });
            });

            // Improve radio button touch targets
            const radioLabels = document.querySelectorAll('label[for*="service"], label[for*="doctor"]');
            radioLabels.forEach(label => {
                label.style.minHeight = '44px'; // iOS recommended touch target size
                label.style.display = 'flex';
                label.style.alignItems = 'center';
            });

            // Add swipe gestures for form navigation
            let touchStartX = 0;
            let touchEndX = 0;

            bookingForm.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].screenX;
            });

            bookingForm.addEventListener('touchend', function (e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const swipeDistance = touchEndX - touchStartX;

                if (Math.abs(swipeDistance) > swipeThreshold) {
                    if (swipeDistance > 0 && currentStep > 1) {
                        // Swipe right - go to previous step
                        previousStep();
                    } else if (swipeDistance < 0 && currentStep < totalSteps) {
                        // Swipe left - go to next step
                        if (validateCurrentStep()) {
                            nextStep();
                        }
                    }
                }
            }

            // Prevent zoom on double tap for form inputs
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('touchend', function (e) {
                    e.preventDefault();
                    this.focus();
                });
            });
        }

        // Initialize touch interactions
        addTouchInteractions();

        // Service prices
        const servicePrices = {
            'grooming': { name: 'Grooming Premium', price: 'Rp 100.000' },
            'konsultasi': { name: 'Konsultasi Dokter', price: 'Rp 150.000' },
            'vaksinasi': { name: 'Vaksinasi Lengkap', price: 'Rp 200.000' },
            'checkup': { name: 'Health Check-up', price: 'Rp 250.000' }
        };

        // Doctor names
        const doctorNames = {
            'dr-sarah': 'Dr. Sarah Wijaya',
            'dr-budi': 'Dr. Budi Santoso'
        };

        // Focus management helpers for modal
        let focusTrapHandler = null;
        function getFocusableElements(container) {
            return container.querySelectorAll('a[href], button:not([disabled]), textarea, input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])');
        }
        function trapFocus(container) {
            const focusables = Array.from(getFocusableElements(container));
            if (focusables.length) {
                (focusables[0] || container).focus({ preventScroll: true });
            }
            focusTrapHandler = function (e) {
                if (e.key !== 'Tab') return;
                const first = focusables[0];
                const last = focusables[focusables.length - 1];
                if (e.shiftKey) {
                    if (document.activeElement === first) {
                        e.preventDefault();
                        last.focus();
                    }
                } else {
                    if (document.activeElement === last) {
                        e.preventDefault();
                        first.focus();
                    }
                }
            };
            document.addEventListener('keydown', focusTrapHandler);
        }
        function releaseFocus() {
            if (focusTrapHandler) {
                document.removeEventListener('keydown', focusTrapHandler);
                focusTrapHandler = null;
            }
        }

        // Show/Hide form with seamless animation
        function showBookingForm(selectedService = null) {
            // Pre-select the service if provided
            if (selectedService) {
                const serviceRadio = document.querySelector(`input[name^="petService_"][value="${selectedService}"]`);
                if (serviceRadio) {
                    serviceRadio.checked = true;
                }
            }

            // Tampilkan modal + form dengan animasi lembut + kompensasi scrollbar
            if (bookingModal) {
                bookingModal.classList.remove('hidden');
                const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
                document.body.classList.add('overflow-hidden');
                if (scrollbarWidth > 0) {
                    document.body.style.paddingRight = scrollbarWidth + 'px';
                }
            }

            bookingForm.classList.remove('hidden');
            bookingForm.style.maxHeight = '0px';
            bookingForm.style.overflow = 'hidden';
            bookingForm.style.opacity = '0';
            bookingForm.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';

            // Trigger animation
            requestAnimationFrame(() => {
                bookingForm.style.maxHeight = '100vh';
                bookingForm.style.opacity = '1';
            });

            // Pulihkan scroll internal modal & aktifkan focus trap
            setTimeout(() => {
                bookingForm.style.overflow = 'auto';
                trapFocus(bookingForm);
                const closeBtn = document.getElementById('closeForm');
                if (closeBtn) closeBtn.focus({ preventScroll: true });
            }, 300);
        }

        // Appointment button handler (guard if not present)
        if (appointmentBtn) {
            appointmentBtn.addEventListener('click', function (e) {
                e.preventDefault();
                showBookingForm();
            });
        }

        // Quick book buttons handler
        quickBookBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const selectedService = this.getAttribute('data-service');
                showBookingForm(selectedService);
            });
        });

        // Close modal when clicking the backdrop
        if (bookingBackdrop) {
            bookingBackdrop.addEventListener('click', function () {
                closeForm.click();
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && bookingModal && !bookingModal.classList.contains('hidden')) {
                closeForm.click();
            }
        });

        closeForm.addEventListener('click', function () {
            // Animasi tutup yang halus + release focus
            bookingForm.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            bookingForm.style.maxHeight = '0px';
            bookingForm.style.opacity = '0';

            setTimeout(() => {
                bookingForm.classList.add('hidden');
                bookingForm.style.maxHeight = '';
                bookingForm.style.opacity = '';
                bookingForm.style.transition = '';
                if (bookingModal) {
                    bookingModal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                    document.body.style.paddingRight = '';
                }
                releaseFocus();
                resetForm();
            }, 300);
        });

        // Cancel booking button
        const cancelBooking = document.getElementById('cancelBooking');
        if (cancelBooking) {
            cancelBooking.addEventListener('click', function () {
                closeForm.click();
            });
        }

        // Navigation
        nextBtn.addEventListener('click', function () {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateStep();
                }
            }
        });

        prevBtn.addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                updateStep();
            }
        });

        submitBtn.addEventListener('click', function () {
            if (validateStep(currentStep)) {
                // Store form data before hiding steps
                const formData = {
                    customerName: document.getElementById('customerName')?.value || '',
                    customerWhatsapp: document.getElementById('customerWhatsapp')?.value || '',
                    selectedService: document.querySelector('input[name^="petService_"]:checked'),
                    appointmentDate: document.getElementById('appointmentDate')?.value || '',
                    appointmentTime: document.getElementById('appointmentTime')?.value || '',
                    selectedDoctor: document.querySelector('input[name^="doctor_"]:checked')
                };

                // Show success message with stored data
                showSuccessMessage(formData);
            }
        });

        function updateStep() {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(step => {
                step.classList.add('hidden');
            });

            // Show current step
            document.getElementById('step' + currentStep).classList.remove('hidden');

            // Update progress bar
            const progress = (currentStep / totalSteps) * 100;
            progressBar.style.width = progress + '%';
            currentStepSpan.textContent = currentStep;

            // Update buttons
            prevBtn.classList.toggle('hidden', currentStep === 1);
            nextBtn.classList.toggle('hidden', currentStep === totalSteps);
            submitBtn.classList.toggle('hidden', currentStep !== totalSteps);

            // Generate doctor selections when entering step 2
            if (currentStep === 2) {
                generateDoctorSelections();
            }

            // Update summary on step 3
            if (currentStep === 3) {
                updateSummary();
            }
        }

        function validateStep(step) {
            switch (step) {
                case 1:
                    // Validate all pets data including service selection
                    let allPetsValid = true;
                    let invalidPetIndex = -1;

                    for (let i = 0; i < pets.length; i++) {
                        const petName = document.querySelector(`[name="petName_${i}"]`)?.value?.trim();
                        const petType = document.querySelector(`[name="petType_${i}"]`)?.value;
                        const petAge = document.querySelector(`[name="petAge_${i}"]`)?.value?.trim();
                        const petGender = document.querySelector(`[name="petGender_${i}"]:checked`);
                        const petColor = document.querySelector(`[name="petColor_${i}"]`)?.value?.trim();
                        const petService = document.querySelector(`[name="petService_${i}"]:checked`);

                        if (!petName || !petType || !petAge || !petGender || !petColor || !petService) {
                            allPetsValid = false;
                            invalidPetIndex = i;
                            break;
                        }
                    }

                    if (!allPetsValid) {
                        // Navigate to the invalid pet
                        currentPetIndex = invalidPetIndex;
                        showCurrentPet();
                        updatePetNavigation();

                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Tidak Lengkap',
                            text: `Silakan lengkapi data dan pilih layanan untuk hewan peliharaan #${invalidPetIndex + 1}`,
                            confirmButtonColor: '#D4A574'
                        });
                        return false;
                    }
                    return true;

                case 2:
                    const date = document.getElementById('appointmentDate').value;
                    const time = document.getElementById('appointmentTime').value;

                    if (!date || !time) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Jadwal Belum Dipilih',
                            text: 'Silakan pilih tanggal dan waktu janji temu',
                            confirmButtonColor: '#D4A574'
                        });
                        return false;
                    }

                    // Check if all pets have doctors assigned
                    let allDoctorsSelected = true;
                    for (let i = 0; i < pets.length; i++) {
                        const petService = document.querySelector(`[name="petService_${i}"]:checked`);
                        if (petService) {
                            const doctorSelected = document.querySelector(`input[name="doctor_${i}"]:checked`);
                            if (!doctorSelected) {
                                allDoctorsSelected = false;
                                break;
                            }
                        }
                    }

                    if (!allDoctorsSelected) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Dokter Belum Dipilih',
                            text: 'Silakan pilih dokter untuk setiap hewan peliharaan',
                            confirmButtonColor: '#D4A574'
                        });
                        return false;
                    }

                    // Check if date is not in the past
                    const selectedDate = new Date(date);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (selectedDate < today) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tanggal Tidak Valid',
                            text: 'Tanggal tidak boleh di masa lalu',
                            confirmButtonColor: '#D4A574'
                        });
                        return false;
                    }
                    return true;

                case 3:
                    const customerName = document.getElementById('customerName').value.trim();
                    const customerWhatsapp = document.getElementById('customerWhatsapp').value.trim();
                    const agreeTerms = document.getElementById('agreeTerms').checked;
                    const agreeResponsibility = document.getElementById('agreeResponsibility').checked;

                    if (!customerName || !customerWhatsapp) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Informasi Tidak Lengkap',
                            text: 'Silakan lengkapi informasi kontak',
                            confirmButtonColor: '#D4A574'
                        });
                        return false;
                    }

                    if (!agreeTerms) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Syarat dan Ketentuan',
                            text: 'Silakan setujui syarat dan ketentuan',
                            confirmButtonColor: '#D4A574'
                        });
                        return false;
                    }

                    if (!agreeResponsibility) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Persetujuan Tanggung Jawab',
                            text: 'Silakan setujui pernyataan tanggung jawab klinik',
                            confirmButtonColor: '#D4A574'
                        });
                        return false;
                    }

                    // Basic phone validation
                    if (customerWhatsapp.length < 10) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Nomor Tidak Valid',
                            text: 'Nomor WhatsApp tidak valid',
                            confirmButtonColor: '#D4A574'
                        });
                        return false;
                    }
                    return true;

                default:
                    return true;
            }
        }

        function collectPetData() {
            // Update pets array with current form data
            pets.forEach((pet, index) => {
                const nameInput = document.getElementById(`petName_${index}`);
                const typeInput = document.getElementById(`petType_${index}`);
                const ageInput = document.getElementById(`petAge_${index}`);
                const genderInput = document.querySelector(`input[name="petGender_${index}"]:checked`);
                const colorInput = document.getElementById(`petColor_${index}`);
                const notesInput = document.getElementById(`petNotes_${index}`);

                if (nameInput) pet.name = nameInput.value;
                if (typeInput) pet.type = typeInput.value;
                if (ageInput) pet.age = ageInput.value;
                if (genderInput) pet.gender = genderInput.value;
                if (colorInput) pet.color = colorInput.value;
                if (notesInput) pet.notes = notesInput.value;
            });
        }

        function updateSummary() {
            // Collect current pet data from forms
            collectPetData();

            // Update pets summary
            const petSummaryContainer = document.getElementById('petSummary');
            let petsSummaryHTML = '';
            let servicesUsed = new Set();

            pets.forEach((pet, index) => {
                const petService = document.querySelector(`[name="petService_${index}"]:checked`);
                if (petService) {
                    const serviceData = servicePrices[petService.value];
                    servicesUsed.add(serviceData.name);

                    petsSummaryHTML += `
                            <div class="bg-gradient-to-r from-pistache-50 to-chai-50 rounded-xl p-4 border border-pistache-200">
                                <h5 class="font-bold text-carob-900 mb-3 flex items-center text-sm">
                                    <i data-lucide="heart" class="w-4 h-4 mr-2 text-pistache-600 flex-shrink-0"></i>
                                    <span>${pet.name}</span>
                                </h5>
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div class="flex justify-between">
                                        <span class="text-carob-600">Jenis:</span>
                                        <span class="font-semibold text-carob-900">${pet.type}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-carob-600">Usia:</span>
                                        <span class="font-semibold text-carob-900">${pet.age}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-carob-600">Kelamin:</span>
                                        <span class="font-semibold text-carob-900">${pet.gender}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-carob-600">Warna:</span>
                                        <span class="font-semibold text-carob-900">${pet.color}</span>
                                    </div>
                                    <div class="col-span-2 flex justify-between pt-2 border-t border-pistache-200">
                                        <span class="text-carob-600">Layanan:</span>
                                        <span class="font-semibold text-chai-600">${serviceData.name}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                }
            });

            petSummaryContainer.innerHTML = petsSummaryHTML;

            // Update appointment summary
            const date = document.getElementById('appointmentDate').value;
            const time = document.getElementById('appointmentTime').value;

            if (date) {
                const formattedDate = new Date(date).toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                document.getElementById('summaryDate').textContent = formattedDate;
            }

            if (time) {
                document.getElementById('summaryTime').textContent = time + ' WIB';
            }

            // Update doctor summary - show all selected doctors
            let doctorSummary = '';
            pets.forEach((pet, index) => {
                const petService = document.querySelector(`[name="petService_${index}"]:checked`);
                const selectedDoctor = document.querySelector(`input[name="doctor_${index}"]:checked`);

                if (petService && selectedDoctor && pet.name) {
                    const doctorName = doctorNames[selectedDoctor.value];
                    doctorSummary += `${pet.name}: ${doctorName}<br>`;
                }
            });

            if (doctorSummary) {
                document.getElementById('summaryDoctor').innerHTML = doctorSummary;
            }

            // Update service summary
            const serviceSummaryContainer = document.getElementById('serviceSummary');
            let serviceSummaryHTML = '';

            Array.from(servicesUsed).forEach(serviceName => {
                serviceSummaryHTML += `
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-chai-50 to-white rounded-lg border border-chai-200">
                            <div class="flex items-center">
                                <i data-lucide="scissors" class="w-4 h-4 text-chai-600 mr-2"></i>
                                <span class="font-semibold text-carob-900 text-sm">${serviceName}</span>
                            </div>
                            <i data-lucide="check-circle" class="w-4 h-4 text-matcha-600"></i>
                        </div>
                    `;
            });

            serviceSummaryContainer.innerHTML = serviceSummaryHTML;
        }

        function showSuccessMessage(formData) {
            // Get data directly from DOM elements with better error handling
            const customerNameEl = document.getElementById('customerName');
            const customerWhatsappEl = document.getElementById('customerWhatsapp');
            const selectedServiceEl = document.querySelector('input[name^="petService_"]:checked');
            const dateEl = document.getElementById('appointmentDate');
            const timeEl = document.getElementById('appointmentTime');
            const selectedDoctorEl = document.querySelector('input[name^="doctor_"]:checked');

            // Extract values with fallbacks
            const customerName = customerNameEl?.value || formData?.customerName || '';
            const customerWhatsapp = customerWhatsappEl?.value || formData?.customerWhatsapp || '';
            const selectedService = selectedServiceEl || formData?.selectedService;
            const date = dateEl?.value || formData?.appointmentDate || '';
            const time = timeEl?.value || formData?.appointmentTime || '';
            const selectedDoctor = selectedDoctorEl || formData?.selectedDoctor;

            // Debug logging to see what's missing
            console.log('Form data check:', {
                customerName: customerName,
                customerWhatsapp: customerWhatsapp,
                selectedService: selectedService?.value,
                date: date,
                time: time,
                selectedDoctor: selectedDoctor?.value
            });

            // Check if all required data exists
            if (!customerName || !customerWhatsapp || !selectedService || !date || !time || !selectedDoctor) {
                console.error('Required form data not available. Missing:', {
                    customerName: !customerName,
                    customerWhatsapp: !customerWhatsapp,
                    selectedService: !selectedService,
                    date: !date,
                    time: !time,
                    selectedDoctor: !selectedDoctor
                });

                // Try to get missing data from visible form elements
                if (!customerName || !customerWhatsapp) {
                    alert('Mohon lengkapi data pelanggan terlebih dahulu');
                    return;
                }
                if (!selectedService) {
                    alert('Mohon pilih layanan terlebih dahulu');
                    return;
                }
                if (!date || !time) {
                    alert('Mohon pilih tanggal dan waktu appointment');
                    return;
                }
                if (!selectedDoctor) {
                    alert('Mohon pilih dokter terlebih dahulu');
                    return;
                }
                return;
            }

            const serviceData = servicePrices[selectedService.value];
            const doctorName = doctorNames[selectedDoctor.value];

            // Format date for display
            const formattedDate = new Date(date).toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Create pets information for WhatsApp message
            let petsInfo = '';
            pets.forEach((pet, index) => {
                const petName = document.querySelector(`[name="petName_${index}"]`)?.value || '-';
                const petType = document.querySelector(`[name="petType_${index}"]`)?.value || '-';
                const petGender = document.querySelector(`[name="petGender_${index}"]:checked`)?.value || '-';
                const petColor = document.querySelector(`[name="petColor_${index}"]`)?.value || '-';
                const petAge = document.querySelector(`[name="petAge_${index}"]`)?.value || '-';
                const petNotes = document.querySelector(`[name="petNotes_${index}"]`)?.value || '';

                petsInfo += `🐾 *Pet ${index + 1}:* ${petName} (${petType})\n`;
                petsInfo += `   ↳ Umur: ${petAge}, Gender: ${petGender}, Warna: ${petColor}\n`;
                if (petNotes.trim()) {
                    petsInfo += `   ↳ Catatan: ${petNotes}\n`;
                }
                petsInfo += '\n';
            });

            // Create WhatsApp message
            let servicesInfo = '';
            let totalPrice = 0;
            let allServices = new Set();

            pets.forEach((pet, index) => {
                const petService = document.querySelector(`[name="petService_${index}"]:checked`);
                if (petService) {
                    const serviceData = servicePrices[petService.value];
                    totalPrice += parseInt(serviceData.price.replace(/[^\d]/g, ''));
                    allServices.add(serviceData.name);

                    servicesInfo += `   ↳ Layanan: ${serviceData.name} (${serviceData.price})\n`;
                }
            });

            const formattedTotalPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(totalPrice);

            const whatsappMessage = `*BOOKING APPOINTMENT ZOW-ZOW*\n\n` +
                `👤 *Nama:* ${customerName}\n` +
                `${petsInfo}` +
                `${servicesInfo}\n` +
                `💰 *Total Harga:* ${formattedTotalPrice}\n` +
                `📅 *Tanggal:* ${formattedDate}\n` +
                `⏰ *Waktu:* ${time} WIB\n` +
                `👨‍⚕️ *Dokter:* ${doctorName}\n\n` +
                `Mohon konfirmasi ketersediaan jadwal. Terima kasih! 🙏`;

            // Encode message for WhatsApp URL
            const encodedMessage = encodeURIComponent(whatsappMessage);
            const whatsappUrl = `https://wa.me/6281219088899?text=${encodedMessage}`;

            // Create pets names for success message
            const petsNames = pets.map((pet, index) => {
                const petName = document.querySelector(`[name="petName_${index}"]`)?.value || `Pet ${index + 1}`;
                return petName;
            }).join(', ');

            // Hide all steps and show success message
            document.querySelectorAll('.step-content').forEach(step => {
                step.classList.add('hidden');
            });

            // Hide navigation buttons
            document.querySelector('.flex.justify-between').classList.add('hidden');

            // Show success message
            const successMessage = document.getElementById('successMessage');
            successMessage.classList.remove('hidden');

            // Update success message content with booking details
            const successTitle = successMessage.querySelector('h4');
            const successText = successMessage.querySelector('p');

            successTitle.textContent = `Booking Berhasil, ${customerName}!`;
            successText.innerHTML = `Appointment untuk <strong>${petsNames}</strong> dengan layanan <strong>${Array.from(allServices).join(', ')}</strong> telah berhasil dijadwalkan pada <strong>${formattedDate}</strong> pukul <strong>${time} WIB</strong>.<br><br>Silakan klik tombol di bawah untuk mengirim konfirmasi melalui WhatsApp.`;

            // Add WhatsApp button
            const newBookingBtn = document.getElementById('newBookingBtn');
            newBookingBtn.innerHTML = `
                    <span class="hidden sm:inline">Kirim ke WhatsApp</span>
                    <span class="sm:hidden">WhatsApp</span>
                `;
            newBookingBtn.onclick = function () {
                window.open(whatsappUrl, '_blank');
                // Refresh page after 2 seconds
                setTimeout(() => {
                    location.reload();
                }, 2000);
            };
        }

        function resetForm() {
            currentStep = 1;
            updateStep();

            // Reset all form fields
            document.querySelectorAll('input[type="text"], input[type="tel"], textarea, select').forEach(field => {
                field.value = '';
            });

            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.checked = false;
            });

            document.getElementById('appointmentDate').value = '';

            // Reset multi-pet functionality
            pets = [];
            currentPetIndex = 0;
            document.getElementById('petFormsContainer').innerHTML = '';
            document.getElementById('petNavigation').classList.add('hidden');

            // Re-initialize with first pet
            addPet();
        }

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('appointmentDate').setAttribute('min', today);

        // Multi-Pet Functionality
        let pets = [];
        let currentPetIndex = 0;

        function initializeMultiPet() {
            // Add first pet by default
            addPet();

            // Event listeners
            document.getElementById('addPetBtn').addEventListener('click', addPet);
            document.getElementById('prevPetBtn').addEventListener('click', () => navigatePet(-1));
            document.getElementById('nextPetBtn').addEventListener('click', () => navigatePet(1));
        }

        function addPet() {
            const petIndex = pets.length;
            const petData = {
                index: petIndex,
                name: '',
                type: '',
                age: '',
                gender: '',
                color: '',
                notes: ''
            };

            pets.push(petData);

            // Create pet form from template
            const template = document.getElementById('petFormTemplate');
            const clone = template.content.cloneNode(true);

            // Update form attributes and IDs
            const wrapper = clone.querySelector('.pet-form-wrapper');
            wrapper.setAttribute('data-pet-index', petIndex);
            wrapper.style.display = petIndex === currentPetIndex ? 'block' : 'none';

            // Update title
            clone.querySelector('.pet-title').textContent = `Hewan Peliharaan #${petIndex + 1}`;

            // Update form field names and IDs
            const inputs = clone.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                if (input.name && input.name.includes('petGender_')) {
                    input.name = `petGender_${petIndex}`;
                } else if (input.name && input.name.includes('petService_')) {
                    input.name = `petService_${petIndex}`;
                } else {
                    const baseName = input.className.includes('pet-name') ? 'petName' :
                        input.className.includes('pet-type') ? 'petType' :
                            input.className.includes('pet-age') ? 'petAge' :
                                input.className.includes('pet-color') ? 'petColor' :
                                    input.className.includes('pet-notes') ? 'petNotes' : '';

                    if (baseName) {
                        input.name = `${baseName}_${petIndex}`;
                        input.id = `${baseName}_${petIndex}`;
                    }
                }
            });

            // Update service radio button names (redundant but keeping for safety)
            const serviceRadios = clone.querySelectorAll('input[name*="petService_"]');
            serviceRadios.forEach(radio => {
                radio.name = `petService_${petIndex}`;
            });

            // Add remove button functionality
            const removeBtn = clone.querySelector('.remove-pet-btn');
            if (pets.length > 1) {
                removeBtn.classList.remove('hidden');
            }
            removeBtn.addEventListener('click', () => removePet(petIndex));

            // Add to container
            document.getElementById('petFormsContainer').appendChild(clone);

            // Re-initialize Lucide icons for the new cloned form
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Update UI
            updatePetNavigation();
            updatePetCounter();

            // Show navigation if more than one pet
            if (pets.length > 1) {
                document.getElementById('petNavigation').classList.remove('hidden');
            }
        }

        function removePet(petIndex) {
            if (pets.length <= 1) return;

            // Remove from array
            pets.splice(petIndex, 1);

            // Remove from DOM
            const wrapper = document.querySelector(`[data-pet-index="${petIndex}"]`);
            if (wrapper) {
                wrapper.remove();
            }

            // Update remaining pet indices
            pets.forEach((pet, index) => {
                pet.index = index;
                const wrapper = document.querySelector(`[data-pet-index="${petIndex + index + 1}"]`);
                if (wrapper) {
                    wrapper.setAttribute('data-pet-index', index);
                    wrapper.querySelector('.pet-title').textContent = `Hewan Peliharaan #${index + 1}`;
                }
            });

            // Adjust current pet index
            if (currentPetIndex >= pets.length) {
                currentPetIndex = pets.length - 1;
            }

            // Update UI
            updatePetNavigation();
            updatePetCounter();
            showCurrentPet();

            // Hide navigation if only one pet
            if (pets.length <= 1) {
                document.getElementById('petNavigation').classList.add('hidden');
            }
        }

        function navigatePet(direction) {
            const newIndex = currentPetIndex + direction;
            if (newIndex >= 0 && newIndex < pets.length) {
                currentPetIndex = newIndex;
                showCurrentPet();
                updatePetNavigation();
            }
        }

        function showCurrentPet() {
            document.querySelectorAll('.pet-form-wrapper').forEach((wrapper, index) => {
                wrapper.style.display = index === currentPetIndex ? 'block' : 'none';
            });
        }

        function updatePetNavigation() {
            const petTabs = document.getElementById('petTabs');
            petTabs.innerHTML = '';

            pets.forEach((pet, index) => {
                const tab = document.createElement('button');
                tab.type = 'button';
                tab.className = `px-3 py-1 rounded-lg text-xs font-medium transition-all duration-300 ${index === currentPetIndex
                    ? 'bg-chai-500 text-white'
                    : 'bg-carob-100 text-carob-600 hover:bg-chai-100'
                    }`;
                tab.textContent = index + 1;
                tab.addEventListener('click', () => {
                    currentPetIndex = index;
                    showCurrentPet();
                    updatePetNavigation();
                });
                petTabs.appendChild(tab);
            });

            // Update navigation buttons
            document.getElementById('prevPetBtn').disabled = currentPetIndex === 0;
            document.getElementById('nextPetBtn').disabled = currentPetIndex === pets.length - 1;
        }

        function updatePetCounter() {
            document.getElementById('petCounter').textContent = `Pet ${currentPetIndex + 1} dari ${pets.length}`;
        }

        function updatePetsSummary() {
            const container = document.getElementById('petSummary');
            if (!container) {
                console.error('petSummary element not found');
                return;
            }

            container.innerHTML = '';

            pets.forEach((pet, index) => {
                const petName = document.querySelector(`[name="petName_${index}"]`)?.value || '-';
                const petType = document.querySelector(`[name="petType_${index}"]`)?.value || '-';
                const petGender = document.querySelector(`[name="petGender_${index}"]:checked`)?.value || '-';
                const petColor = document.querySelector(`[name="petColor_${index}"]`)?.value || '-';

                const petSummary = document.createElement('div');
                petSummary.className = 'mb-3 p-3 bg-gradient-to-r from-matcha-50 to-pistache-50 rounded-xl border border-matcha-200';
                petSummary.innerHTML = `
                        <h5 class="font-semibold text-carob-800 mb-2 flex items-center text-sm">
                            <i data-lucide="paw-print" class="w-3 h-3 mr-2 text-matcha-600"></i>
                            Hewan Peliharaan #${index + 1}
                        </h5>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-carob-600">Nama:</span>
                                <span class="font-medium text-carob-900">${petName}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-carob-600">Jenis:</span>
                                <span class="font-medium text-carob-900">${petType}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-carob-600">Gender:</span>
                                <span class="font-medium text-carob-900">${petGender}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-carob-600">Warna:</span>
                                <span class="font-medium text-carob-900">${petColor}</span>
                            </div>
                        </div>
                    `;
                container.appendChild(petSummary);
            });

            // Re-initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // Initialize multi-pet functionality
        initializeMultiPet();

        // Generate doctor selections for each pet based on their services
        function generateDoctorSelections() {
            const container = document.getElementById('doctorSelectionContainer');
            let doctorHTML = '';

            // Collect current pet data
            collectPetData();

            pets.forEach((pet, index) => {
                const petService = document.querySelector(`[name="petService_${index}"]:checked`);
                if (petService && pet.name) {
                    const serviceData = servicePrices[petService.value];

                    doctorHTML += `
                            <div class="mb-6 p-4 bg-gradient-to-r from-pistache-50 to-chai-50 rounded-xl border border-pistache-200">
                                <h4 class="font-bold text-carob-900 mb-3 flex items-center text-sm">
                                    <i data-lucide="heart" class="w-4 h-4 mr-2 text-pistache-600"></i>
                                    ${pet.name} - ${serviceData.name}
                                </h4>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                                    <label class="group flex items-center p-3 border-2 border-carob-100 rounded-xl hover:border-matcha-500 cursor-pointer transition-all duration-300 hover:shadow-lg hover:bg-gradient-to-br hover:from-matcha-50 hover:to-white">
                                        <input type="radio" name="doctor_${index}" value="dr-sarah" class="mr-3 text-matcha-500 scale-110 flex-shrink-0">
                                        <div class="flex items-center flex-1 min-w-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-matcha-400 to-matcha-600 rounded-full flex items-center justify-center mr-3 group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                                                <i data-lucide="stethoscope" class="text-white w-5 h-5"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-bold text-carob-900 text-sm truncate">Dr. Sarah Wijaya</div>
                                                <div class="text-xs text-carob-600 font-medium truncate">🐱 Spesialis Hewan Kecil</div>
                                                <div class="text-xs text-matcha-600 truncate">⭐ 4.9 Rating</div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="group flex items-center p-3 border-2 border-carob-100 rounded-xl hover:border-chai-500 cursor-pointer transition-all duration-300 hover:shadow-lg hover:bg-gradient-to-br hover:from-chai-50 hover:to-white">
                                        <input type="radio" name="doctor_${index}" value="dr-budi" class="mr-3 text-chai-500 scale-110 flex-shrink-0">
                                        <div class="flex items-center flex-1 min-w-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-chai-400 to-chai-600 rounded-full flex items-center justify-center mr-3 group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                                                <i data-lucide="stethoscope" class="text-white w-5 h-5"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-bold text-carob-900 text-sm truncate">Dr. Budi Santoso</div>
                                                <div class="text-xs text-carob-600 font-medium truncate">🐕 Spesialis Hewan Besar</div>
                                                <div class="text-xs text-chai-600 truncate">⭐ 4.8 Rating</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        `;
                }
            });

            container.innerHTML = doctorHTML;
        }

        // Update the existing updateSummary function to handle multiple pets
        const originalUpdateSummary = updateSummary;
        updateSummary = function () {
            originalUpdateSummary();
            updatePetsSummary();
        };

    });

    // Doctor Modal Functionality
    const doctorData = {
        doctor1: {
            name: "Dr. Ahmad Rizki",
            specialty: "Spesialis Bedah",
            rating: "4.8",
            experience: "200+ operasi"
        },
        doctor2: {
            name: "Dr. Sarah Wijaya",
            specialty: "Spesialis Hewan Kecil",
            rating: "4.9",
            experience: "150+ pasien"
        },
        doctor3: {
            name: "Dr. Budi Santoso",
            specialty: "Spesialis Hewan Besar",
            rating: "4.7",
            experience: "300+ kasus"
        },
        doctor4: {
            name: "Dr. Lisa Chen",
            specialty: "Spesialis Dermatologi",
            rating: "4.9",
            experience: "180+ treatment"
        }
    };

    function openDoctorModal(doctorId) {
        const modal = document.getElementById('doctorModal');
        const modalContent = document.getElementById('modalContent');
        const doctor = doctorData[doctorId];

        if (!doctor) return;

        // Update modal content with doctor data
        document.getElementById('modalDoctorName').textContent = doctor.name;
        document.getElementById('modalDoctorSpecialty').textContent = doctor.specialty;
        document.getElementById('modalDoctorRating').textContent = doctor.rating;
        document.getElementById('modalDoctorExperience').textContent = doctor.experience;

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Animate modal appearance
        setTimeout(() => {
            modalContent.style.transform = 'scale(1)';
            modalContent.style.opacity = '1';
        }, 10);
    }

    function closeDoctorModal() {
        const modal = document.getElementById('doctorModal');
        const modalContent = document.getElementById('modalContent');

        // Animate modal disappearance
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Close modal when pressing Escape key
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeDoctorModal();
        }
    });
</script>