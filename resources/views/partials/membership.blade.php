<!-- Membership & Lifestyle Ecosystem Section -->
<section id="keanggotaan" class="py-24 relative overflow-hidden bg-gradient-to-b from-white via-vanilla-50/30 to-white">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-20 left-0 w-96 h-96 bg-chai-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-20 right-0 w-96 h-96 bg-forest-moss-green-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-20 w-96 h-96 bg-vanilla-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        
        <!-- Abstract Shapes & Animal Icons -->
        <div class="absolute top-40 right-10 opacity-10 rotate-12 animate-float-slow">
             <x-animal-icon name="cat" class="w-40 h-40 text-chai-400" />
        </div>
        <div class="absolute bottom-40 left-10 opacity-10 -rotate-12 animate-float-medium">
             <x-animal-icon name="dog" class="w-48 h-48 text-forest-moss-green-400" />
        </div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-5 animate-pulse-slow">
             <x-animal-icon name="rabbit" class="w-64 h-64 text-soft-blush-pink-400" />
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Membership Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center bg-white border border-carob-100 rounded-full px-6 py-2 shadow-sm mb-6 animate-fade-in-up">
                <span class="mr-3 flex items-center">
                    <x-animal-icon name="hamster" class="w-6 h-6 text-forest-moss-green-500" />
                </span>
                <span class="text-carob-600 font-medium text-sm tracking-wide uppercase">Join Our Family</span>
            </div>
            
            <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 leading-tight tracking-tight font-heading">
                A Community That<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-chai-500 to-forest-moss-green-600">Feels Like Home</span>
            </h2>
            
            <p class="text-xl text-carob-600 max-w-2xl mx-auto leading-relaxed">
                Designed for Pawrents who treat pets as family. Enjoy priority access, special savings, and a community that shares your love.
            </p>
        </div>

        <!-- Why Become a Member Visuals -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-20">
            <div class="bg-white p-6 rounded-[2rem] border border-carob-50 shadow-sm hover:shadow-lg transition-all text-center group">
                <div class="w-12 h-12 bg-forest-moss-green-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="shield-check" class="w-6 h-6 text-forest-moss-green-600"></i>
                </div>
                <h4 class="font-bold text-carob-900 mb-1">Comprehensive Care</h4>
                <p class="text-sm text-carob-500">Full health coverage</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-carob-50 shadow-sm hover:shadow-lg transition-all text-center group">
                <div class="w-12 h-12 bg-chai-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="tag" class="w-6 h-6 text-chai-600"></i>
                </div>
                <h4 class="font-bold text-carob-900 mb-1">Exclusive Rates</h4>
                <p class="text-sm text-carob-500">Up to 20% off services</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-carob-50 shadow-sm hover:shadow-lg transition-all text-center group">
                <div class="w-12 h-12 bg-vanilla-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="message-circle" class="w-6 h-6 text-vanilla-600"></i>
                </div>
                <h4 class="font-bold text-carob-900 mb-1">24/7 Chat</h4>
                <p class="text-sm text-carob-500">Direct vet access</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-carob-50 shadow-sm hover:shadow-lg transition-all text-center group">
                <div class="w-12 h-12 bg-carob-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="gift" class="w-6 h-6 text-carob-600"></i>
                </div>
                <h4 class="font-bold text-carob-900 mb-1">Monthly Perks</h4>
                <p class="text-sm text-carob-500">Free treats & grooming</p>
            </div>
        </div>

        <!-- Membership Cards -->
        <div class="mb-20 max-w-6xl mx-auto">

            <div class="grid md:grid-cols-3 gap-6 items-stretch">
                @forelse($memberships as $index => $membership)
                    @php
                        // Refined pastel colors using available theme colors
                        $palettes = [
                            ['bg' => 'bg-forest-moss-green-50', 'border' => 'border-forest-moss-green-100', 'btn' => 'bg-forest-moss-green-500 hover:bg-forest-moss-green-600', 'text' => 'text-forest-moss-green-700'],
                            ['bg' => 'bg-chai-50', 'border' => 'border-chai-100', 'btn' => 'bg-chai-500 hover:bg-chai-600', 'text' => 'text-chai-700'],
                            ['bg' => 'bg-soft-blush-pink-50', 'border' => 'border-soft-blush-pink-100', 'btn' => 'bg-soft-blush-pink-500 hover:bg-soft-blush-pink-600', 'text' => 'text-soft-blush-pink-700'],
                        ];
                        $p = $palettes[$index % count($palettes)];
                        $isFeatured = $membership->is_featured;
                    @endphp

                    <div class="relative flex flex-col h-full transition-all duration-300 group 
                        {{ $isFeatured ? 'md:-mt-4 md:mb-4 z-10' : '' }}">
                        
                        <!-- Card Container -->
                        <div class="flex-1 rounded-3xl overflow-hidden flex flex-col
                            {{ $isFeatured 
                                ? 'bg-white shadow-2xl ring-4 ring-forest-moss-green-100' 
                                : 'bg-white shadow-lg border border-gray-100 hover:shadow-xl' 
                            }}">
                            
                            <!-- Image/Header Area -->
                            <div class="relative h-40 overflow-hidden">
                                @if($membership->image)
                                    <img src="{{ asset('storage/' . $membership->image) }}"
                                         alt="{{ $membership->title }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                @else
                                    <div class="w-full h-full {{ $p['bg'] }} flex items-center justify-center">
                                        <i data-lucide="{{ $index == 0 ? 'sparkles' : ($index == 1 ? 'crown' : 'heart') }}" 
                                           class="w-12 h-12 {{ $p['text'] }} opacity-50"></i>
                                    </div>
                                @endif

                                <!-- Badge -->
                                @if($isFeatured)
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-carob-800 shadow-sm flex items-center gap-1">
                                        <span>👑</span> Most Loved
                                    </div>
                                @endif
                                
                                <!-- Title & Price Overlay -->
                                <div class="absolute bottom-4 left-4 text-white drop-shadow-md">
                                    <h3 class="text-xl font-bold font-heading leading-tight mb-0.5 {{ $membership->image ? 'text-white' : 'text-carob-900' }}">
                                        {{ $membership->title }}
                                    </h3>
                                    <div class="flex items-baseline gap-1 {{ $membership->image ? 'text-white/90' : 'text-carob-600' }}">
                                        <span class="text-lg font-bold">{{ $membership->formatted_price }}</span>
                                        <span class="text-xs font-medium opacity-80">/{{ $membership->duration }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Benefits List -->
                            <div class="p-6 flex-1 flex flex-col">
                                <ul class="space-y-3 mb-6 flex-1">
                                    @if($membership->benefits && is_array($membership->benefits))
                                        @foreach($membership->benefits as $benefit)
                                            <li class="flex items-start text-sm text-carob-600">
                                                <div class="min-w-[1rem] mt-0.5 mr-2.5">
                                                    <i data-lucide="check" class="w-4 h-4 {{ $p['text'] }}"></i>
                                                </div>
                                                <span class="leading-snug">{{ $benefit }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                <a href="#register-{{ $membership->id }}" 
                                   class="w-full py-3 rounded-xl font-bold text-sm text-center transition-all duration-300 text-white shadow-md hover:shadow-lg hover:-translate-y-0.5 {{ $p['btn'] }}">
                                    Choose Plan
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                     <!-- Fallback when no data -->
                     <div class="col-span-full text-center py-8">
                        <div class="bg-white rounded-3xl p-8 shadow-lg border border-dashed border-carob-200 max-w-lg mx-auto">
                            <i data-lucide="construction" class="w-12 h-12 text-carob-300 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-carob-900 mb-2">Coming Soon</h3>
                            <p class="text-sm text-carob-600">We are crafting our membership tiers. Stay tuned.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Community CTA -->
        <div class="relative rounded-[3rem] overflow-hidden">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Pet Community" loading="lazy" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-carob-900/90 via-carob-900/80 to-transparent"></div>
            </div>
            
            <div class="relative z-10 p-12 md:p-20 max-w-3xl">
                <h3 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
                    Join a Community That<br/>
                    <span class="text-chai-300">Feels Like Family</span>
                </h3>
                <p class="text-white/90 text-lg mb-10 leading-relaxed max-w-xl">
                    Beyond perks and discounts, Zow membership connects you with fellow pet lovers who share your passion for providing the best life for their companions.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-5">
                    <a href="#join-community" class="bg-chai-500 hover:bg-chai-600 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 shadow-lg shadow-chai-500/30 flex items-center justify-center">
                        <i data-lucide="heart-handshake" class="w-5 h-5 mr-2"></i>
                        Join the Community
                    </a>
                    <a href="#learn-more" class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center">
                        Discover Benefits
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Animation Styles -->
<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    .font-heading {
        font-family: 'Plus Jakarta Sans', sans-serif; /* Ensure this font is loaded or fallback */
    }
</style>
