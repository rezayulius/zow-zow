<section id="beranda" class="relative overflow-hidden bg-transparent min-h-[100svh] sm:min-h-screen group/slider">
    <!-- Background Gradient (Fixed) -->
    <div class="absolute inset-0 bg-gradient-to-b from-soft-linen-50 via-vanilla-50/50 to-soft-linen-100 z-0"></div>

    <!-- Decorative Blobs (Fixed Background) -->
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-br from-forest-moss-green-100/20 to-forest-moss-green-200/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gradient-to-tr from-soft-blush-pink-100/30 to-chai-100/30 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>

    <!-- Slides Container -->
    <div class="relative w-full h-full min-h-screen">
        
        @forelse($heroSlides as $index => $slide)
            @php
                $isActive = $index === 0 ? 'active' : '';
                $themeColor = $slide->theme_color ?? 'forest-moss-green';
                
                // Color mapping
                $colors = [
                    'forest-moss-green' => [
                        'bg' => 'bg-forest-moss-green-500',
                        'text' => 'text-forest-moss-green-600',
                        'text_dark' => 'text-deep-cocoa-brown-800',
                        'badge_ping' => 'bg-forest-moss-green-400',
                        'badge_dot' => 'bg-forest-moss-green-500',
                        'btn_bg' => 'bg-forest-moss-green-600',
                        'btn_shadow' => 'shadow-forest-moss-green-600/20',
                        'btn_hover_shadow' => 'shadow-forest-moss-green-600/30',
                        'gradient_from' => 'from-forest-moss-green-500',
                        'gradient_to' => 'to-forest-moss-green-700',
                        'icon_color' => 'text-forest-moss-green-600',
                        'border_hover' => 'hover:border-forest-moss-green-300',
                        'secondary_blob_shadow' => 'shadow-forest-moss-green-900/10',
                        'highlight_underline' => 'text-soft-blush-pink-300',
                    ],
                    'chai' => [
                        'bg' => 'bg-chai-500',
                        'text' => 'text-chai-600',
                        'text_dark' => 'text-deep-cocoa-brown-800',
                        'badge_ping' => 'bg-chai-400',
                        'badge_dot' => 'bg-chai-500',
                        'btn_bg' => 'bg-chai-500',
                        'btn_shadow' => 'shadow-chai-500/20',
                        'btn_hover_shadow' => 'shadow-chai-500/30',
                        'gradient_from' => 'from-chai-400',
                        'gradient_to' => 'to-chai-600',
                        'icon_color' => 'text-chai-500',
                        'border_hover' => 'hover:border-chai-300',
                        'secondary_blob_shadow' => 'shadow-chai-900/10',
                        'highlight_underline' => 'text-forest-moss-green-200',
                    ],
                    'soft-blush-pink' => [
                        'bg' => 'bg-soft-blush-pink-500',
                        'text' => 'text-soft-blush-pink-600',
                        'text_dark' => 'text-deep-cocoa-brown-800',
                        'badge_ping' => 'bg-soft-blush-pink-400',
                        'badge_dot' => 'bg-soft-blush-pink-500',
                        'btn_bg' => 'bg-soft-blush-pink-500',
                        'btn_shadow' => 'shadow-soft-blush-pink-500/20',
                        'btn_hover_shadow' => 'shadow-soft-blush-pink-500/30',
                        'gradient_from' => 'from-soft-blush-pink-400',
                        'gradient_to' => 'to-soft-blush-pink-600',
                        'icon_color' => 'text-soft-blush-pink-500',
                        'border_hover' => 'hover:border-soft-blush-pink-300',
                        'secondary_blob_shadow' => 'shadow-soft-blush-pink-900/10',
                        'highlight_underline' => 'text-chai-200',
                    ],
                    'deep-cocoa-brown' => [
                        'bg' => 'bg-deep-cocoa-brown-500',
                        'text' => 'text-deep-cocoa-brown-600',
                        'text_dark' => 'text-deep-cocoa-brown-800',
                        'badge_ping' => 'bg-deep-cocoa-brown-400',
                        'badge_dot' => 'bg-deep-cocoa-brown-500',
                        'btn_bg' => 'bg-deep-cocoa-brown-600',
                        'btn_shadow' => 'shadow-deep-cocoa-brown-600/20',
                        'btn_hover_shadow' => 'shadow-deep-cocoa-brown-600/30',
                        'gradient_from' => 'from-deep-cocoa-brown-500',
                        'gradient_to' => 'to-deep-cocoa-brown-700',
                        'icon_color' => 'text-deep-cocoa-brown-600',
                        'border_hover' => 'hover:border-deep-cocoa-brown-300',
                        'secondary_blob_shadow' => 'shadow-deep-cocoa-brown-900/10',
                        'highlight_underline' => 'text-forest-moss-green-200',
                    ],
                ];

                $c = $colors[$themeColor] ?? $colors['forest-moss-green'];
                
                // Handle image paths
                $mainImage = $slide->main_image;
                if (!Str::startsWith($mainImage, 'http')) {
                    $mainImage = asset('storage/' . $mainImage);
                }
                
                $secondaryImage = null;
                if ($slide->secondary_image) {
                    $secondaryImage = $slide->secondary_image;
                    if (!Str::startsWith($secondaryImage, 'http')) {
                        $secondaryImage = asset('storage/' . $secondaryImage);
                    }
                }
            @endphp

            <div class="slide {{ $isActive }} absolute inset-0 w-full h-full z-10 transition-all duration-700 ease-in-out" data-slide="{{ $index }}">
                <div class="w-full h-full flex items-center pt-24 sm:pt-28 pb-12 sm:pb-16 lg:pt-32 lg:pb-24">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                            <!-- Left Column -->
                            <div class="flex flex-col items-center lg:items-start text-center lg:text-left space-y-8">
                                @if($slide->badge_text)
                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-sm border border-soft-linen-200 shadow-sm shadow-deep-cocoa-brown-900/5 cursor-default">
                                    <span class="flex h-2 w-2 relative">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $c['badge_ping'] }} opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 {{ $c['badge_dot'] }}"></span>
                                    </span>
                                    <span class="text-xs sm:text-sm font-medium text-deep-cocoa-brown-600 tracking-wide uppercase">{{ $slide->badge_text }}</span>
                                </div>
                                @endif

                                <div class="space-y-4 max-w-2xl">
                                    <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-heading font-bold {{ $c['text_dark'] }} leading-[1.1] tracking-tight">
                                        {{ $slide->title }} <br>
                                        @if($slide->highlight_text)
                                        <span class="{{ str_replace('text-', 'text-', $c['text']) }} relative inline-block">
                                            {{ $slide->highlight_text }}
                                            <svg class="absolute w-full h-3 -bottom-1 left-0 {{ $c['highlight_underline'] }} -z-10" viewBox="0 0 200 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.00025 6.99997C25.7201 5.20448 132.856 2.00006 198.001 3.50002" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                                        </span>
                                        @endif
                                    </h1>
                                    <p class="text-lg sm:text-xl text-deep-cocoa-brown-600 leading-relaxed font-light">
                                        {{ $slide->description }}
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                                    @if($slide->primary_cta_text)
                                    <a href="{{ $slide->primary_cta_url ?? '#' }}" class="group relative overflow-hidden {{ $c['btn_bg'] }} text-white px-8 py-4 rounded-2xl font-medium text-base shadow-xl {{ $c['btn_shadow'] }} hover:{{ $c['btn_hover_shadow'] }} hover:-translate-y-1 transition-all duration-300 text-center sm:text-left inline-flex items-center justify-center gap-2">
                                        <span class="relative z-10">{{ $slide->primary_cta_text }}</span>
                                        <i data-lucide="arrow-right" class="w-5 h-5 relative z-10 group-hover:translate-x-1 transition-transform duration-300"></i>
                                        <div class="absolute inset-0 bg-gradient-to-r {{ $c['gradient_from'] }} {{ $c['gradient_to'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </a>
                                    @endif

                                    @if($slide->secondary_cta_text)
                                    <a href="{{ $slide->secondary_cta_url ?? '#' }}" class="group bg-white/80 backdrop-blur-sm text-deep-cocoa-brown-700 px-8 py-4 rounded-2xl font-medium text-base border border-soft-linen-200 {{ $c['border_hover'] }} hover:bg-white shadow-lg shadow-deep-cocoa-brown-900/5 hover:shadow-deep-cocoa-brown-900/10 hover:-translate-y-1 transition-all duration-300 text-center sm:text-left inline-flex items-center justify-center gap-2">
                                        <i data-lucide="message-circle" class="w-5 h-5 {{ $c['icon_color'] }} group-hover:scale-110 transition-transform duration-300"></i>
                                        <span>{{ $slide->secondary_cta_text }}</span>
                                    </a>
                                    @endif
                                </div>

                                <!-- Trust Indicators -->
                                <div class="pt-4 flex items-center gap-6 sm:gap-8 text-deep-cocoa-brown-500/80">
                                    <div class="flex items-center gap-2">
                                        <div class="flex -space-x-3">
                                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1517849845537-4d257902454a?w=100&h=100&fit=crop" alt="User">
                                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="User">
                                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="User">
                                        </div>
                                        <div class="flex flex-col text-xs leading-tight">
                                            <span class="font-bold text-deep-cocoa-brown-700">500+</span>
                                            <span>Happy Owners</span>
                                        </div>
                                    </div>
                                    <div class="w-px h-8 bg-deep-cocoa-brown-200/50"></div>
                                    <div class="flex flex-col text-xs leading-tight">
                                        <span class="font-bold text-deep-cocoa-brown-700 text-base">4.9/5</span>
                                        <span class="flex items-center gap-0.5">
                                            <i data-lucide="star" class="w-3 h-3 fill-yellow-400 text-yellow-400"></i>
                                            Top Rated
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="relative hidden lg:block h-full min-h-[500px] w-full perspective-1000 group">
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] aspect-[4/5] rounded-[2rem] overflow-hidden shadow-2xl shadow-deep-cocoa-brown-900/10 rotate-[-3deg] transition-all duration-700 group-hover:rotate-0 border-[6px] border-white z-10">
                                    <img src="{{ $mainImage }}" alt="{{ $slide->title }}" class="w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-700">
                                    
                                    <!-- Floating Card (Dynamic Content based on theme/index could be added here, currently static style) -->
                                    <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-4 rounded-xl shadow-lg border border-soft-linen-100 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500 delay-100">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs font-semibold text-deep-cocoa-brown-400 uppercase tracking-wider mb-1">Wellness Status</p>
                                                <div class="flex items-center gap-2">
                                                    <div class="w-2 h-2 rounded-full {{ $c['badge_dot'] }} animate-pulse"></div>
                                                    <p class="text-sm font-bold text-deep-cocoa-brown-700">Healthy & Happy</p>
                                                </div>
                                            </div>
                                            <div class="bg-soft-linen-50 p-2 rounded-lg">
                                                <i data-lucide="heart" class="w-5 h-5 {{ $c['icon_color'] }} fill-current"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($secondaryImage)
                                <div class="absolute top-[10%] right-[5%] w-[60%] aspect-square rounded-[2rem] overflow-hidden shadow-xl {{ $c['secondary_blob_shadow'] }} rotate-[6deg] opacity-90 transition-all duration-700 group-hover:rotate-[3deg] group-hover:translate-x-4 border-[6px] border-white z-0">
                                     <img src="{{ $secondaryImage }}" alt="Detail" class="w-full h-full object-cover">
                                </div>
                                @endif

                                <div class="absolute -top-4 left-[10%] bg-white p-3 rounded-2xl shadow-xl rotate-[-10deg] animate-float-slow z-20">
                                    <span class="text-2xl">🐾</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Fallback if no slides -->
            <div class="slide active absolute inset-0 w-full h-full z-10 flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-deep-cocoa-brown-800">Welcome to Zow Vetique</h1>
                    <p class="text-xl text-deep-cocoa-brown-600 mt-4">A Second Home for Your Pet</p>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Slider Navigation (Bottom Center) -->
    @if(count($heroSlides) > 1)
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-30 flex flex-col items-center gap-4">
        <!-- Dots -->
        <div class="flex items-center gap-3">
            @foreach($heroSlides as $index => $slide)
                <button class="slide-nav-btn w-3 h-3 rounded-full bg-deep-cocoa-brown-300 hover:bg-forest-moss-green-600 transition-all duration-300" data-slide="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </div>
    @endif
</section>

<style>
    @keyframes float-slow {
        0%, 100% { transform: translateY(0) rotate(-10deg); }
        50% { transform: translateY(-10px) rotate(-8deg); }
    }
    @keyframes float-medium {
        0%, 100% { transform: translateY(0) rotate(12deg); }
        50% { transform: translateY(-15px) rotate(15deg); }
    }
    .animate-float-slow { animation: float-slow 4s ease-in-out infinite; }
    .animate-float-medium { animation: float-medium 5s ease-in-out infinite; }
    
    /* Slider Transitions */
    .slide {
        opacity: 0;
        visibility: hidden;
        transform: scale(1.05);
        pointer-events: none;
    }
    .slide.active {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
        pointer-events: auto;
    }
    .slide-nav-btn.active {
        background-color: #364E2C; /* forest-moss-green-500 */
        transform: scale(1.2);
    }
</style>
