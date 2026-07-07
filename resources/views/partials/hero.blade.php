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
                <div class="w-full h-full flex items-center pt-32 sm:pt-28 pb-36 sm:pb-24 lg:pt-32 lg:pb-24">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                            <!-- Left Column -->
                            <div class="flex flex-col items-center lg:items-start text-center lg:text-left space-y-4 lg:space-y-8 relative z-20 order-2 lg:order-1">
                                @if($slide->badge_text)
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-white/60 backdrop-blur-sm border border-soft-linen-200 shadow-sm shadow-deep-cocoa-brown-900/5 cursor-default mt-4 lg:mt-0">
                                    <span class="flex h-2 w-2 relative">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $c['badge_ping'] }} opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 {{ $c['badge_dot'] }}"></span>
                                    </span>
                                    <span class="text-[0.65rem] sm:text-sm font-medium text-deep-cocoa-brown-600 tracking-wide uppercase">{{ $slide->badge_text }}</span>
                                </div>
                                @endif

                                <div class="space-y-3 sm:space-y-4 max-w-2xl">
                                    <{{ $index === 0 ? 'h1' : 'h3' }} class="text-3xl sm:text-5xl lg:text-6xl xl:text-7xl font-heading font-bold {{ $c['text_dark'] }} leading-[1.1] tracking-tight">
                                        {{ $slide->title }} <br>
                                        @if($slide->highlight_text)
                                        <span class="{{ str_replace('text-', 'text-', $c['text']) }} relative inline-block">
                                            {{ $slide->highlight_text }}
                                            <svg class="absolute w-full h-2 sm:h-3 -bottom-1 left-0 {{ $c['highlight_underline'] }} -z-10" viewBox="0 0 200 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.00025 6.99997C25.7201 5.20448 132.856 2.00006 198.001 3.50002" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                                        </span>
                                        @endif
                                    </{{ $index === 0 ? 'h1' : 'h3' }}>
                                    <p class="text-base sm:text-xl text-deep-cocoa-brown-600 leading-relaxed font-light hidden sm:block">
                                        {{ $slide->description }}
                                    </p>
                                    <p class="text-sm text-deep-cocoa-brown-600 leading-relaxed font-light sm:hidden line-clamp-3">
                                        {{ $slide->description }}
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto px-4 sm:px-0">
                                    @if($slide->primary_cta_text)
                                    <a href="{{ $slide->primary_cta_url ?? '#' }}" class="group relative overflow-hidden {{ $c['btn_bg'] }} text-white px-6 py-3.5 sm:px-8 sm:py-4 rounded-2xl font-medium text-sm sm:text-base shadow-xl {{ $c['btn_shadow'] }} hover:{{ $c['btn_hover_shadow'] }} hover:-translate-y-1 transition-all duration-300 text-center sm:text-left inline-flex items-center justify-center gap-2 w-full sm:w-auto">
                                        <span class="relative z-10">{{ $slide->primary_cta_text }}</span>
                                        <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5 relative z-10 group-hover:translate-x-1 transition-transform duration-300"></i>
                                        <div class="absolute inset-0 bg-gradient-to-r {{ $c['gradient_from'] }} {{ $c['gradient_to'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </a>
                                    @endif

                                    @if($slide->secondary_cta_text)
                                    <a href="{{ $slide->secondary_cta_url ?? '#' }}" class="group bg-white/80 backdrop-blur-sm text-deep-cocoa-brown-700 px-6 py-3.5 sm:px-8 sm:py-4 rounded-2xl font-medium text-sm sm:text-base border border-soft-linen-200 {{ $c['border_hover'] }} hover:bg-white shadow-lg shadow-deep-cocoa-brown-900/5 hover:shadow-deep-cocoa-brown-900/10 hover:-translate-y-1 transition-all duration-300 text-center sm:text-left inline-flex items-center justify-center gap-2 w-full sm:w-auto">
                                        <i data-lucide="message-circle" class="w-4 h-4 sm:w-5 sm:h-5 {{ $c['icon_color'] }} group-hover:scale-110 transition-transform duration-300"></i>
                                        <span>{{ $slide->secondary_cta_text }}</span>
                                    </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="relative h-[280px] sm:h-[400px] lg:h-full lg:min-h-[500px] w-full perspective-1000 group mt-8 lg:mt-0 order-1 lg:order-2 flex justify-center items-center">
                                <div class="relative w-[70%] sm:w-[50%] lg:w-[90%] aspect-[4/5]">
                                    <div class="absolute inset-0 rounded-[2rem] overflow-hidden shadow-2xl shadow-deep-cocoa-brown-900/10 rotate-[-3deg] transition-all duration-700 group-hover:rotate-0 border-[4px] sm:border-[6px] border-white z-10">
                                        <img src="{{ $mainImage }}" alt="{{ $slide->title }}" class="w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-700" {!! $index === 0 ? 'loading="eager" fetchpriority="high"' : 'loading="lazy"' !!}>
                                    </div>
                                    
                                    <!-- Floating Card -->
                                    <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6 bg-white/95 backdrop-blur-md p-3 sm:p-4 rounded-xl shadow-lg border border-soft-linen-100 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500 delay-100 z-20">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-[0.6rem] sm:text-xs font-semibold text-deep-cocoa-brown-400 uppercase tracking-wider mb-0.5 sm:mb-1">Wellness Status</p>
                                                <div class="flex items-center gap-2">
                                                    <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full {{ $c['badge_dot'] }} animate-pulse"></div>
                                                    <p class="text-xs sm:text-sm font-bold text-deep-cocoa-brown-700">Healthy & Happy</p>
                                                </div>
                                            </div>
                                            <div class="bg-soft-linen-50 p-1.5 sm:p-2 rounded-lg">
                                                <i data-lucide="heart" class="w-4 h-4 sm:w-5 sm:h-5 {{ $c['icon_color'] }} fill-current"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($secondaryImage)
                                <div class="absolute top-[5%] right-[5%] sm:right-[15%] lg:right-0 w-[35%] sm:w-[30%] lg:w-[60%] aspect-square rounded-[2rem] overflow-hidden shadow-xl {{ $c['secondary_blob_shadow'] }} rotate-[6deg] opacity-90 transition-all duration-700 group-hover:rotate-[3deg] group-hover:translate-x-4 border-[4px] sm:border-[6px] border-white z-0 hidden sm:block">
                                     <img src="{{ $secondaryImage }}" alt="Detail perawatan hewan ZOW Vetique" class="w-full h-full object-cover" loading="lazy">
                                </div>
                                @endif

                                <div class="absolute -top-2 left-[15%] sm:-top-4 sm:left-[20%] lg:left-[10%] bg-white p-2 sm:p-3 rounded-2xl shadow-xl rotate-[-10deg] animate-float-slow z-20">
                                    <x-animal-icon name="bird" class="w-8 h-8 sm:w-10 sm:h-10 text-forest-moss-green-500" />
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
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-30 flex flex-col items-center gap-4">
        <!-- Dots -->
        <div class="flex items-center gap-3">
            @foreach($heroSlides as $index => $slide)
                <button class="slide-nav-btn w-3 h-3 rounded-full bg-deep-cocoa-brown-300 hover:bg-forest-moss-green-600 transition-all duration-300" data-slide="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Bottom Wave Separator (Seamless Transition) -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20 pointer-events-none text-soft-linen-50">
        <svg class="relative block w-[calc(100%+1.3px)] h-[50px] sm:h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-current transform rotate-180 origin-center"></path>
        </svg>
    </div>
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
