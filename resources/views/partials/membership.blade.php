<!-- Membership & Lifestyle Ecosystem Section -->
<section id="keanggotaan" class="py-24 relative overflow-hidden bg-gradient-to-b from-white via-vanilla-50/30 to-white">
    <!-- Top wave: seams the soft-linen-50(Pricing) -> white(Membership) color change -->
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
        <svg class="relative block w-[calc(100%+1.3px)] h-[50px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
        </svg>
    </div>

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
                <span class="text-carob-600 font-medium text-sm tracking-wide uppercase">{{ __('membership.badge') }}</span>
            </div>

            <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 leading-tight tracking-tight font-heading">
                {{ __('membership.title_line1') }}<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-chai-500 to-forest-moss-green-600">{{ __('membership.title_line2') }}</span>
            </h2>

            <p class="text-xl text-carob-600 max-w-2xl mx-auto leading-relaxed">
                {{ __('membership.subtitle') }}
            </p>
        </div>

        <!-- Why Become a Member Visuals -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-20">
            <div class="bg-white p-6 rounded-[2rem] border border-carob-50 shadow-sm hover:shadow-lg transition-all text-center group">
                <div class="w-12 h-12 bg-forest-moss-green-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="shield-check" class="w-6 h-6 text-forest-moss-green-600"></i>
                </div>
                <h3 class="font-bold text-carob-900 mb-1">{{ __('membership.features.care.title') }}</h3>
                <p class="text-sm text-carob-500">{{ __('membership.features.care.desc') }}</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-carob-50 shadow-sm hover:shadow-lg transition-all text-center group">
                <div class="w-12 h-12 bg-chai-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="tag" class="w-6 h-6 text-chai-600"></i>
                </div>
                <h3 class="font-bold text-carob-900 mb-1">{{ __('membership.features.rates.title') }}</h3>
                <p class="text-sm text-carob-500">{{ __('membership.features.rates.desc') }}</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-carob-50 shadow-sm hover:shadow-lg transition-all text-center group">
                <div class="w-12 h-12 bg-vanilla-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="message-circle" class="w-6 h-6 text-vanilla-600"></i>
                </div>
                <h3 class="font-bold text-carob-900 mb-1">{{ __('membership.features.chat.title') }}</h3>
                <p class="text-sm text-carob-500">{{ __('membership.features.chat.desc') }}</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-carob-50 shadow-sm hover:shadow-lg transition-all text-center group">
                <div class="w-12 h-12 bg-carob-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i data-lucide="gift" class="w-6 h-6 text-carob-600"></i>
                </div>
                <h3 class="font-bold text-carob-900 mb-1">{{ __('membership.features.perks.title') }}</h3>
                <p class="text-sm text-carob-500">{{ __('membership.features.perks.desc') }}</p>
            </div>
        </div>

        <!-- Membership Cards -->
        <div class="mb-20 max-w-6xl mx-auto">

            <div class="grid md:grid-cols-3 gap-6 items-stretch">
                @forelse($memberships as $index => $membership)
                    @php
                        // Refined pastel colors using available theme colors.
                        // chai-500 reads ~2.1:1 against white button text (WCAG AA
                        // needs 4.5:1), darkened to chai-800 to pass. Even the darkest
                        // defined pink (900) only reaches ~4.3:1 with white text, so
                        // that button keeps its light pink background and uses dark
                        // text instead (~8:1).
                        $palettes = [
                            ['bg' => 'bg-forest-moss-green-50', 'border' => 'border-forest-moss-green-100', 'btn' => 'bg-forest-moss-green-500 hover:bg-forest-moss-green-600', 'btn_text' => 'text-white', 'text' => 'text-forest-moss-green-700'],
                            ['bg' => 'bg-chai-50', 'border' => 'border-chai-100', 'btn' => 'bg-chai-800 hover:bg-chai-900', 'btn_text' => 'text-white', 'text' => 'text-chai-800'],
                            ['bg' => 'bg-soft-blush-pink-50', 'border' => 'border-soft-blush-pink-100', 'btn' => 'bg-soft-blush-pink-500 hover:bg-soft-blush-pink-600', 'btn_text' => 'text-deep-cocoa-brown-800', 'text' => 'text-soft-blush-pink-700'],
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
                                        <span>👑</span> {{ __('membership.most_loved') }}
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
                                   class="w-full py-3 rounded-xl font-bold text-sm text-center transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5 {{ $p['btn'] }} {{ $p['btn_text'] }}">
                                    {{ __('membership.choose_plan') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                     <!-- Fallback when no data -->
                     <div class="col-span-full text-center py-8">
                        <div class="bg-white rounded-3xl p-8 shadow-lg border border-dashed border-carob-200 max-w-lg mx-auto">
                            <i data-lucide="construction" class="w-12 h-12 text-carob-300 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-carob-900 mb-2">{{ __('membership.empty.title') }}</h3>
                            <p class="text-sm text-carob-600">{{ __('membership.empty.subtitle') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Community CTA: was a 1920px photo pulled from images.unsplash.com on
             every homepage visit, sitting almost entirely under a 80-90%-opacity
             gradient anyway. Replaced with the gradient + a static paw texture
             (same technique as the Booking banner) -- no external request. --}}
        <div class="relative rounded-[3rem] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-carob-900 via-carob-900 to-forest-moss-green-900">
                <div class="absolute inset-0 opacity-[0.07]" style="background-image: url('data:image/svg+xml,%3Csvg width=%2270%22 height=%2270%22 viewBox=%220 0 70 70%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%221%22%3E%3Cellipse cx=%2235%22 cy=%2244%22 rx=%2210%22 ry=%228%22/%3E%3Ccircle cx=%2221%22 cy=%2226%22 r=%225%22/%3E%3Ccircle cx=%2235%22 cy=%2218%22 r=%225.5%22/%3E%3Ccircle cx=%2249%22 cy=%2226%22 r=%225%22/%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>

            <div class="relative z-10 p-12 md:p-20 max-w-3xl">
                <h3 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
                    {{ __('membership.cta.title_line1') }}<br/>
                    <span class="text-chai-300">{{ __('membership.cta.title_line2') }}</span>
                </h3>
                <p class="text-white/90 text-lg mb-10 leading-relaxed max-w-xl">
                    {{ __('membership.cta.subtitle') }}
                </p>

                <div class="flex flex-col sm:flex-row gap-5">
                    <a href="#join-community" class="bg-chai-800 hover:bg-chai-900 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 shadow-lg shadow-chai-500/30 flex items-center justify-center">
                        <i data-lucide="heart-handshake" class="w-5 h-5 mr-2"></i>
                        {{ __('membership.cta.join_community') }}
                    </a>
                    <a href="#learn-more" class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center">
                        {{ __('membership.cta.discover_benefits') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
