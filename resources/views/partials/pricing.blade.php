<!-- Pricing Section -->
<section id="harga" class="py-16 bg-gradient-to-br from-chai-25 to-matcha-25">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-12">
            <div
                class="inline-flex items-center bg-vanilla-100 text-chai-800 px-4 py-2 rounded-full text-sm font-medium mb-4">
                <i data-lucide="dollar-sign" class="w-4 h-4 mr-2"></i>
                Transparent Pricing
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-carob-900 mb-4">Our Services & Pricing</h2>
            <p class="text-carob-600 max-w-2xl mx-auto">
                Choose the perfect care package for your beloved pet with our comprehensive and affordable services.
            </p>
        </div>

        <!-- Pricing Cards Grid -->
        @if($pricing && $pricing->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @foreach($pricing as $index => $package)
                    @php
                        // Define color schemes for variety
                        $colorSchemes = [
                            ['border' => 'border-chai-100', 'price' => 'text-chai-600', 'button' => 'bg-chai-500 hover:bg-chai-600', 'popular' => 'bg-chai-500', 'feature' => 'text-chai-600'],
                            ['border' => 'border-matcha-100', 'price' => 'text-matcha-600', 'button' => 'bg-matcha-500 hover:bg-matcha-600', 'popular' => 'bg-matcha-500', 'feature' => 'text-matcha-600'],
                            ['border' => 'border-vanilla-200', 'price' => 'text-vanilla-600', 'button' => 'bg-vanilla-500 hover:bg-vanilla-600', 'popular' => 'bg-vanilla-500', 'feature' => 'text-vanilla-600'],
                            ['border' => 'border-carob-100', 'price' => 'text-carob-600', 'button' => 'bg-carob-500 hover:bg-carob-600', 'popular' => 'bg-carob-500', 'feature' => 'text-carob-600'],
                            ['border' => 'border-pistache-200', 'price' => 'text-pistache-600', 'button' => 'bg-pistache-600 hover:bg-pistache-700', 'popular' => 'bg-pistache-600', 'feature' => 'text-pistache-600']
                        ];
                        $colors = $colorSchemes[$index % count($colorSchemes)];
                    @endphp
                    
                    <div class="bg-white rounded-2xl p-6 shadow-lg border {{ $colors['border'] }} relative flex flex-col h-full">
                        @if($package->is_popular)
                            <div class="absolute top-4 left-4">
                                <span class="{{ $colors['popular'] }} text-white text-xs px-3 py-1 rounded-full font-medium">POPULAR</span>
                            </div>
                        @endif
                        
                        <div class="{{ $package->is_popular ? 'pt-8' : 'pt-4' }} flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-carob-900 mb-2">{{ $package->name }}</h3>
                            <p class="text-carob-600 text-sm mb-4">{{ $package->description }}</p>

                            <div class="mb-4">
                                <span class="text-3xl font-bold {{ $colors['price'] }}">{{ $package->formatted_price }}</span>
                                @if($package->duration)
                                    <div class="flex items-center text-carob-500 text-sm mt-1">
                                        <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                                        {{ $package->duration }}
                                    </div>
                                @endif
                            </div>

                            @if($package->features && is_array($package->features))
                                <ul class="space-y-2 mb-6 flex-1" data-features-container>
                                    @foreach(array_slice($package->features, 0, 3) as $feature)
                                        <li class="flex items-center text-sm text-carob-700">
                                            <i data-lucide="check" class="w-4 h-4 text-matcha-500 mr-2"></i>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                    
                                    @if(count($package->features) > 3)
                                        <!-- Hidden features (initially hidden) -->
                                        <div class="hidden-features" style="display: none;">
                                            @foreach(array_slice($package->features, 3) as $feature)
                                                <li class="flex items-center text-sm text-carob-700">
                                                    <i data-lucide="check" class="w-4 h-4 text-matcha-500 mr-2"></i>
                                                    {{ $feature }}
                                                </li>
                                            @endforeach
                                        </div>
                                        
                                        <!-- Toggle button -->
                                        <li class="expand-toggle cursor-pointer hover:underline {{ $colors['feature'] }} text-sm font-medium transition-colors duration-200" 
                                            data-expanded="false"
                                            data-more-text="+{{ count($package->features) - 3 }} more features..."
                                            data-less-text="Show less features">
                                            +{{ count($package->features) - 3 }} more features...
                                        </li>
                                    @endif
                                </ul>
                            @endif

                            <a href="{{ $package->button_link ?? '#' }}"
                               class="w-full {{ $colors['button'] }} text-white py-3 rounded-xl transition-colors font-medium mt-auto text-center block">
                                <i data-lucide="calendar" class="w-4 h-4 mr-2 inline"></i>
                                {{ $package->button_text ?? 'Book Now' }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Fallback content when no pricing data is available -->
            <div class="text-center py-12">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 max-w-md mx-auto">
                    <i data-lucide="package" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                    <h3 class="text-xl font-bold text-carob-900 mb-2">No Pricing Packages Available</h3>
                    <p class="text-carob-600 text-sm">Please check back later for our pricing packages.</p>
                </div>
            </div>
        @endif

        <!-- Special Member Benefits -->
        <div class="bg-gradient-to-r from-vanilla-100 to-vanilla-200 rounded-3xl p-8 text-center">
            <div class="flex items-center justify-center mb-4">
                <i data-lucide="heart" class="w-6 h-6 text-vanilla-600 mr-2"></i>
                <h3 class="text-2xl font-bold text-carob-900">Special Member Benefits</h3>
            </div>
            <p class="text-carob-700 mb-6 max-w-2xl mx-auto">
                Join our exclusive membership program and unlock amazing savings up to 30% on all services!
            </p>

            <div class="grid md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="flex items-center justify-center mb-2">
                        <i data-lucide="users" class="w-6 h-6 text-chai-500"></i>
                    </div>
                    <h4 class="font-semibold text-carob-900 mb-1">Family Packages Available</h4>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="flex items-center justify-center mb-2">
                        <i data-lucide="clock" class="w-6 h-6 text-matcha-500"></i>
                    </div>
                    <h4 class="font-semibold text-carob-900 mb-1">24/7 Emergency Support</h4>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="flex items-center justify-center mb-2">
                        <i data-lucide="star" class="w-6 h-6 text-vanilla-500"></i>
                    </div>
                    <h4 class="font-semibold text-carob-900 mb-1">Satisfaction Guaranteed</h4>
                </div>
            </div>

            <button
                class="bg-carob-600 text-white px-8 py-3 rounded-xl hover:bg-carob-700 transition-colors font-semibold">
                View Membership Plans
            </button>
        </div>
    </div>
</section>

<style>
    .hidden-features {
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }
    
    .hidden-features.expanding {
        display: block !important;
        animation: slideDown 0.3s ease-in-out;
    }
    
    .hidden-features.collapsing {
        animation: slideUp 0.3s ease-in-out;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            max-height: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            max-height: 200px;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 1;
            max-height: 200px;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            max-height: 0;
            transform: translateY(-10px);
        }
    }
    
    .expand-toggle:hover {
        transform: translateX(2px);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle expand/collapse functionality for pricing features
    const expandToggles = document.querySelectorAll('.expand-toggle');
    
    expandToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('data-expanded') === 'true';
            const hiddenFeatures = this.parentElement.querySelector('.hidden-features');
            const moreText = this.getAttribute('data-more-text');
            const lessText = this.getAttribute('data-less-text');
            
            if (!isExpanded) {
                // Expand
                hiddenFeatures.style.display = 'block';
                hiddenFeatures.classList.add('expanding');
                hiddenFeatures.classList.remove('collapsing');
                
                this.textContent = lessText;
                this.setAttribute('data-expanded', 'true');
                
                // Remove expanding class after animation
                setTimeout(() => {
                    hiddenFeatures.classList.remove('expanding');
                }, 300);
                
            } else {
                // Collapse
                hiddenFeatures.classList.add('collapsing');
                hiddenFeatures.classList.remove('expanding');
                
                this.textContent = moreText;
                this.setAttribute('data-expanded', 'false');
                
                // Hide after animation
                setTimeout(() => {
                    hiddenFeatures.style.display = 'none';
                    hiddenFeatures.classList.remove('collapsing');
                }, 300);
            }
        });
    });
});
</script>

<!-- Technology Section -->
<section class="py-16 bg-gradient-to-br from-carob-50 to-chai-50">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-12">
            <div
                class="inline-flex items-center bg-vanilla-100 text-chai-800 px-4 py-2 rounded-full text-sm font-medium mb-4">
                <i data-lucide="zap" class="w-4 h-4 mr-2"></i>
                Latest Features
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-carob-900 mb-4">Teknologi Canggih untuk Pet Kesayangan</h2>
            <p class="text-carob-600 max-w-3xl mx-auto">
                Nikmati kemudahan teknologi terdepan dalam perawatan kesehatan hewan peliharaan yang dirancang khusus
                untuk kenyamanan Anda dan pet kesayangan
            </p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Pet Lovers -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-carob-100 text-center">
                <div class="flex items-center justify-center mb-4">
                    <i data-lucide="users" class="w-8 h-8 text-chai-500"></i>
                </div>
                <div class="text-3xl font-bold text-carob-900 mb-2">2,500+</div>
                <div class="text-carob-600 text-sm">Pet Lovers</div>
            </div>

            <!-- Appointment Sukses -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-carob-100 text-center">
                <div class="flex items-center justify-center mb-4">
                    <i data-lucide="calendar-check" class="w-8 h-8 text-matcha-600"></i>
                </div>
                <div class="text-3xl font-bold text-carob-900 mb-2">15,000+</div>
                <div class="text-carob-600 text-sm">Appointment Sukses</div>
            </div>

            <!-- Pet Dirawat -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-carob-100 text-center">
                <div class="flex items-center justify-center mb-4">
                    <i data-lucide="heart" class="w-8 h-8 text-chai-600"></i>
                </div>
                <div class="text-3xl font-bold text-carob-900 mb-2">8,500+</div>
                <div class="text-carob-600 text-sm">Pet Dirawat</div>
            </div>

            <!-- Rating -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-carob-100 text-center">
                <div class="flex items-center justify-center mb-4">
                    <i data-lucide="star" class="w-8 h-8 text-vanilla-600"></i>
                </div>
                <div class="text-3xl font-bold text-carob-900 mb-2">4.9/5</div>
                <div class="text-carob-600 text-sm">Rating Kepuasan</div>
            </div>
        </div>

        <!-- Technology Features -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <!-- Appointment Real-time -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-carob-100">
                <div class="flex items-start mb-6">
                    <div class="bg-matcha-100 rounded-2xl p-3 mr-4">
                        <i data-lucide="calendar" class="w-8 h-8 text-matcha-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <h3 class="text-xl font-bold text-carob-900">Appointment Real-time</h3>
                            <span
                                class="bg-matcha-100 text-matcha-800 text-xs px-2 py-1 rounded-full font-medium ml-3">NEW</span>
                        </div>
                        <p class="text-carob-600 mb-4">Sistem booking appointment canggih dengan konfirmasi langsung
                            untuk pet Anda</p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-matcha-600 mr-2"></i>
                                Cek jadwal dokter real-time
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-matcha-600 mr-2"></i>
                                Pilihan dokter spesialis pet
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-matcha-600 mr-2"></i>
                                Konfirmasi instan
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-matcha-600 mr-2"></i>
                                Integrasi kalender pribadi
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- ZOW AI Pet Assistant -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-carob-100">
                <div class="flex items-start mb-6">
                    <div class="bg-chai-100 rounded-2xl p-3 mr-4">
                        <i data-lucide="bot" class="w-8 h-8 text-chai-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <h3 class="text-xl font-bold text-carob-900">ZOW AI Pet Assistant</h3>
                            <span
                                class="bg-chai-100 text-chai-800 text-xs px-2 py-1 rounded-full font-medium ml-3">ENHANCED</span>
                        </div>
                        <p class="text-carob-600 mb-4">Asisten AI pintar yang siap menjawab pertanyaan seputar perawatan
                            pet Anda 24/7</p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-chai-600 mr-2"></i>
                                Respon sesuai kondisi pet
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-chai-600 mr-2"></i>
                                Bahasa Indonesia & English
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-chai-600 mr-2"></i>
                                Quick action untuk emergency
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-chai-600 mr-2"></i>
                                Tersedia 24/7 untuk pet Anda
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Pembayaran Digital Aman -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-carob-100">
                <div class="flex items-start mb-6">
                    <div class="bg-vanilla-100 rounded-2xl p-3 mr-4">
                        <i data-lucide="credit-card" class="w-8 h-8 text-vanilla-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <h3 class="text-xl font-bold text-carob-900">Pembayaran Digital Aman</h3>
                            <span
                                class="bg-vanilla-100 text-vanilla-800 text-xs px-2 py-1 rounded-full font-medium ml-3">NEW</span>
                        </div>
                        <p class="text-carob-600 mb-4">Berbagai metode pembayaran yang aman dan mudah untuk semua
                            layanan pet care</p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-vanilla-600 mr-2"></i>
                                Kartu Kredit/Debit
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-vanilla-600 mr-2"></i>
                                E-wallet (OVO, GoPay, DANA)
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-vanilla-600 mr-2"></i>
                                QRIS scan & pay
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-vanilla-600 mr-2"></i>
                                Transfer bank semua provider
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Konfirmasi Booking Otomatis -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-carob-100">
                <div class="flex items-start mb-6">
                    <div class="bg-pistache-100 rounded-2xl p-3 mr-4">
                        <i data-lucide="smartphone" class="w-8 h-8 text-pistache-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <h3 class="text-xl font-bold text-carob-900">Konfirmasi Booking Otomatis</h3>
                            <span
                                class="bg-pistache-100 text-pistache-800 text-xs px-2 py-1 rounded-full font-medium ml-3">NEW</span>
                        </div>
                        <p class="text-carob-600 mb-4">Sistem konfirmasi otomatis dengan notifikasi WhatsApp untuk
                            setiap appointment pet</p>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-pistache-600 mr-2"></i>
                                Notifikasi WhatsApp langsung
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-pistache-600 mr-2"></i>
                                Tracking ID booking mudah
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-pistache-600 mr-2"></i>
                                Update status real-time
                            </li>
                            <li class="flex items-center text-sm text-carob-700">
                                <i data-lucide="check" class="w-4 h-4 text-pistache-600 mr-2"></i>
                                Receipt digital otomatis
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <div class="bg-gradient-to-r from-matcha-500 to-chai-600 rounded-3xl p-12 text-center">
                <div class="flex items-center justify-center mb-4">
                    <i data-lucide="zap" class="w-8 h-8 text-carob-800 mr-2"></i>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold text-carob-900 mb-4">Siap Memberikan yang Terbaik untuk Pet
                    Kesayangan?</h3>
                <p class="text-carob-700 mb-6 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan pet lovers yang mempercayakan kesehatan hewan kesayangan mereka pada
                    teknologi canggih kami
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        class="bg-carob-600 text-white px-8 py-3 rounded-xl hover:bg-carob-700 transition-colors font-semibold flex items-center justify-center">
                        <i data-lucide="calendar" class="w-5 h-5 mr-2"></i>
                        Booking Sekarang
                    </button>
                    <button
                        class="bg-white text-carob-700 px-8 py-3 rounded-xl hover:bg-carob-50 transition-colors font-semibold flex items-center justify-center border border-carob-200">
                        <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                        Chat Langsung
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>