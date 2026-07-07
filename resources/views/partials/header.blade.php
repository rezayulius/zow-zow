<!-- Header -->
<header id="header"
    class="fixed top-4 left-0 right-0 z-50 transition-all duration-300 px-4 sm:px-6 lg:px-8 pointer-events-none">
    <div
        class="pointer-events-auto max-w-7xl mx-auto bg-soft-linen-50/90 backdrop-blur-xl rounded-2xl shadow-lg shadow-deep-cocoa-brown-900/5 border border-white/50 ring-1 ring-deep-cocoa-brown-900/5 relative transition-all duration-300">

        <!-- Progress Bar -->
        <div class="absolute bottom-0 left-2 right-2 h-[2px] bg-soft-linen-200/50 rounded-full overflow-hidden">
            <div id="scrollProgress"
                class="h-full bg-gradient-to-r from-forest-moss-green-400 to-forest-moss-green-600 rounded-full transition-all duration-150 ease-out w-0">
            </div>
        </div>

        <nav class="flex items-center w-full py-2 px-4 sm:px-6 gap-2 lg:gap-4">
            <!-- Logo (Left) -->
            <a href="{{ route('home') }}" wire:navigate class="flex-shrink-0 flex items-center gap-3 group">
                <img src="{{ asset('images/logo/zow-vet-logo-brown.webp') }}"
                     alt="Zow Vetique"
                     width="500" height="223"
                     class="h-8 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Desktop Navigation (Center) -->
            <div class="hidden lg:flex flex-1 items-center justify-center gap-1">
                <a href="{{ route('home') }}#beranda"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.home') }}</a>

                <div class="relative group">
                    <button
                        class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200 inline-flex items-center gap-1">
                        {{ __('messages.services') }}
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-deep-cocoa-brown-400 group-hover:text-forest-moss-green-600 transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>

                    <!-- Services Mega-menu (level 1: categories) -->
                    <div
                        class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-60 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 z-50">
                        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl shadow-deep-cocoa-brown-900/10 border border-soft-linen-100 p-1.5">
                            @forelse ($navCategories ?? [] as $category)
                                <div class="relative group/cat">
                                    <a href="{{ route('service-category.show', $category) }}" wire:navigate
                                        class="flex items-center justify-between gap-2 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 font-medium text-sm px-3 py-2.5 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200">
                                        <span class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-forest-moss-green-300"></span>
                                            {{ $category->name }}
                                        </span>
                                        @if ($category->clinicServices->isNotEmpty())
                                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-deep-cocoa-brown-300"></i>
                                        @endif
                                    </a>

                                    <!-- Level 2: services within this category, flyout to the right -->
                                    @if ($category->clinicServices->isNotEmpty())
                                        @php
                                            $serviceCount = $category->clinicServices->count();
                                            $useTwoColumns = $serviceCount > 6;
                                            $rowsPerColumn = $useTwoColumns ? (int) ceil($serviceCount / 2) : $serviceCount;
                                        @endphp
                                        <div
                                            class="absolute left-full top-0 ml-1 {{ $useTwoColumns ? 'w-[30rem] max-w-[min(30rem,90vw)]' : 'w-64 max-w-[90vw]' }} opacity-0 translate-x-2 pointer-events-none group-hover/cat:opacity-100 group-hover/cat:translate-x-0 group-hover/cat:pointer-events-auto transition-all duration-200">
                                            <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl shadow-deep-cocoa-brown-900/10 border border-soft-linen-100 p-1.5 overflow-hidden">
                                                <div class="grid gap-x-1 {{ $useTwoColumns ? 'grid-cols-2 grid-flow-col' : '' }}"
                                                    @if ($useTwoColumns) style="grid-template-rows: repeat({{ $rowsPerColumn }}, minmax(0, 1fr));" @endif>
                                                    @foreach ($category->clinicServices as $service)
                                                        <a href="{{ route('service.show', [$category, $service]) }}" wire:navigate
                                                            class="flex items-center gap-2 min-w-0 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 font-medium text-sm px-3 py-2.5 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-chai-300 flex-shrink-0"></span>
                                                            <span class="truncate">{{ $service->name }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p class="px-3 py-2.5 text-sm text-deep-cocoa-brown-400">-</p>
                            @endforelse

                            {{-- Static link, deliberately outside the dynamic category loop above:
                                 facilities aren't a bookable service category (no sub-flyout, no
                                 WhatsApp/booking CTA), just an informational/SEO page about the
                                 clinic itself — the divider keeps that distinction visually clear. --}}
                            <div class="my-1.5 border-t border-soft-linen-100"></div>
                            <a href="{{ route('facility.index') }}" wire:navigate
                                class="flex items-center gap-2 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 font-medium text-sm px-3 py-2.5 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-chai-300"></span>
                                {{ __('messages.facilities') }}
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('home') }}#health"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.pricing') }}</a>

                <a href="{{ route('home') }}#booking"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.booking') }}</a>

                <a href="{{ route('home') }}#our-vets"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.our_vets') }}</a>

                <a href="{{ route('home') }}#harga"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.bundle') }}</a>
                <a href="{{ route('home') }}#testimoni"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.testimonials') }}</a>
                <a href="{{ route('home') }}#lokasi"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.location') }}</a>
            </div>

            <!-- Right Actions -->
            <div class="hidden lg:flex flex-shrink-0 items-center gap-3">
                <!-- Language Switcher -->
                <x-lang-switch :locales="['id', 'en']" />

                <div class="h-6 w-px bg-deep-cocoa-brown-100"></div>

                <!-- Emergency Button -->
                <div class="flex flex-col items-center">
                    <button id="btnEmergencyCall"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-2 font-medium text-sm shadow-lg shadow-red-200 hover:shadow-red-300 transform hover:-translate-y-0.5 animate-pulse hover:animate-none group">
                        <i data-lucide="phone-call" class="w-3.5 h-3.5 fill-current"></i>
                        <span>{{ __('messages.emergency') }}</span>
                    </button>
                    <a href="tel:+6281295911911" class="text-[10px] font-bold text-red-500 hover:text-red-600 mt-1 tracking-wide transition-colors">+62 812 9591 1911</a>
                </div>

                <!-- Auth -->
                @auth
                    <div class="relative group ml-1">
                        <button
                            class="flex items-center gap-2.5 pl-2 pr-1 py-1 rounded-full hover:bg-soft-linen-100 transition-all duration-200 border border-transparent hover:border-soft-linen-200">
                            <span class="text-deep-cocoa-brown-700 font-medium text-sm hidden xl:block">{{ auth()->user()->name }}</span>
                            <div
                                class="w-9 h-9 bg-gradient-to-br from-forest-moss-green-100 to-forest-moss-green-200 rounded-full flex items-center justify-center border-2 border-white shadow-sm overflow-hidden">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                                        width="36" height="36" loading="lazy"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="text-forest-moss-green-700 font-bold text-xs">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="absolute right-0 top-full pt-2 w-56 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl shadow-deep-cocoa-brown-900/10 border border-soft-linen-100 p-2">
                                <div class="px-3 py-2 border-b border-soft-linen-100 mb-1">
                                    <p class="text-sm font-semibold text-deep-cocoa-brown-800 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-deep-cocoa-brown-500 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('profile') }}" wire:navigate
                                    class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 text-sm">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                    <span>{{ __('messages.profile') }}</span>
                                </a>
                                <a href="{{ route('history') }}" wire:navigate
                                    class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 text-sm">
                                    <i data-lucide="history" class="w-4 h-4"></i>
                                    <span>{{ __('messages.history') }}</span>
                                </a>
                                <div class="border-t border-soft-linen-100 my-1"></div>
                                <form action="{{ route('auth.signout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-red-50 transition-all duration-200 text-red-600 hover:text-red-700 text-sm">
                                        <i data-lucide="log-out" class="w-4 h-4"></i>
                                        <span>{{ __('messages.sign_out') }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2 ml-1">
                        <button data-open-signin
                            class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 font-medium text-sm px-4 py-2 rounded-xl hover:bg-soft-linen-100 transition-all duration-200">
                            {{ __('messages.sign_in') }}
                        </button>
                        <button data-open-signup
                            class="bg-forest-moss-green-600 hover:bg-forest-moss-green-700 text-white px-5 py-2 rounded-xl transition-all duration-200 font-medium text-sm shadow-lg shadow-forest-moss-green-600/20 hover:shadow-forest-moss-green-600/30 transform hover:-translate-y-0.5">
                            {{ __('messages.sign_up') }}
                        </button>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn"
                class="lg:hidden ml-auto p-2.5 rounded-xl text-deep-cocoa-brown-600 hover:bg-soft-linen-100 transition-all duration-200 justify-self-end">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden border-t border-soft-linen-100 overflow-hidden transition-all duration-300 origin-top transform scale-y-95 opacity-0">
            <div class="p-4 space-y-4">

                <!-- 1. Auth Section (Moved to Top) -->
                @auth
                    <div class="bg-soft-linen-50 rounded-2xl p-4 border border-soft-linen-100 shadow-sm">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-forest-moss-green-100 rounded-full flex items-center justify-center overflow-hidden border-2 border-white shadow-sm">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" width="48" height="48" loading="lazy" class="w-full h-full object-cover">
                                @else
                                    <span class="text-forest-moss-green-700 font-bold text-lg">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-bold text-deep-cocoa-brown-800 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-deep-cocoa-brown-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('profile') }}" wire:navigate class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-white text-deep-cocoa-brown-600 text-sm font-bold border border-soft-linen-100 hover:bg-forest-moss-green-50 hover:text-forest-moss-green-700 transition-colors shadow-sm">
                                <i data-lucide="user" class="w-4 h-4"></i> {{ __('messages.profile') }}
                            </a>
                            <a href="{{ route('history') }}" wire:navigate class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-white text-deep-cocoa-brown-600 text-sm font-bold border border-soft-linen-100 hover:bg-forest-moss-green-50 hover:text-forest-moss-green-700 transition-colors shadow-sm">
                                <i data-lucide="history" class="w-4 h-4"></i> {{ __('messages.history') }}
                            </a>
                        </div>
                        <form action="{{ route('auth.signout') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-bold hover:bg-red-100 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i> {{ __('messages.sign_out') }}
                            </button>
                        </form>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-3 p-1">
                        <button data-open-signin
                            class="w-full text-deep-cocoa-brown-700 font-bold text-sm px-4 py-3 rounded-xl bg-soft-linen-100 hover:bg-soft-linen-200 transition-all duration-200">
                            {{ __('messages.sign_in') }}
                        </button>
                        <button data-open-signup
                            class="w-full bg-forest-moss-green-600 hover:bg-forest-moss-green-700 text-white px-4 py-3 rounded-xl transition-all duration-200 font-bold text-sm shadow-md shadow-forest-moss-green-600/20">
                            {{ __('messages.sign_up') }}
                        </button>
                    </div>
                @endauth

                <!-- 2. Navigation Links -->
                <div class="space-y-1">
                    <a href="{{ route('home') }}#beranda"
                        class="flex items-center gap-3 text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-50 transition-all duration-200">
                        <i data-lucide="home" class="w-5 h-5 text-deep-cocoa-brown-400"></i>
                        {{ __('messages.home') }}
                    </a>

                    <!-- Services Dropdown Group (2-level accordion) -->
                    <div class="space-y-1">
                        <button id="mobileServicesBtn" class="w-full flex items-center justify-between text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-50 transition-all duration-200">
                            <div class="flex items-center gap-3">
                                <i data-lucide="sparkles" class="w-5 h-5 text-deep-cocoa-brown-400"></i>
                                {{ __('messages.services') }}
                            </div>
                            <i id="mobileServicesIcon" data-lucide="chevron-down" class="w-4 h-4 text-deep-cocoa-brown-400 transition-transform duration-300"></i>
                        </button>

                        <div id="mobileServicesDropdown" class="hidden pl-4 pr-2 space-y-1 overflow-hidden transition-all duration-300">
                            @foreach ($navCategories ?? [] as $category)
                                <div>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('service-category.show', $category) }}" wire:navigate
                                            class="flex-1 flex items-center gap-3 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 py-2.5 px-3 rounded-xl hover:bg-soft-linen-50 transition-all duration-200 text-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-forest-moss-green-300"></span>
                                            {{ $category->name }}
                                        </a>
                                        @if ($category->clinicServices->isNotEmpty())
                                            <button type="button" data-category-toggle="{{ $category->slug }}"
                                                class="p-2.5 rounded-xl hover:bg-soft-linen-50 text-deep-cocoa-brown-400">
                                                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300" data-category-icon="{{ $category->slug }}"></i>
                                            </button>
                                        @endif
                                    </div>

                                    @if ($category->clinicServices->isNotEmpty())
                                        <div data-category-panel="{{ $category->slug }}" class="hidden pl-6 pr-2 space-y-1">
                                            @foreach ($category->clinicServices as $service)
                                                <a href="{{ route('service.show', [$category, $service]) }}" wire:navigate
                                                    class="flex items-center gap-3 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 py-2 px-3 rounded-xl hover:bg-soft-linen-50 transition-all duration-200 text-xs">
                                                    <span class="w-1 h-1 rounded-full bg-chai-300"></span>
                                                    {{ $service->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                            {{-- Static link, deliberately outside the dynamic category loop above:
                                 facilities aren't a bookable service category, just an
                                 informational/SEO page about the clinic itself. --}}
                            <div class="my-1.5 border-t border-soft-linen-100"></div>
                            <a href="{{ route('facility.index') }}" wire:navigate
                                class="flex items-center gap-3 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 py-2.5 px-3 rounded-xl hover:bg-soft-linen-50 transition-all duration-200 text-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-chai-300"></span>
                                {{ __('messages.facilities') }}
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('home') }}#health"
                        class="flex items-center gap-3 text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-50 transition-all duration-200">
                        <i data-lucide="tag" class="w-5 h-5 text-deep-cocoa-brown-400"></i>
                        {{ __('messages.pricing') }}
                    </a>

                    <a href="{{ route('home') }}#booking"
                        class="flex items-center gap-3 text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-50 transition-all duration-200">
                        <i data-lucide="calendar-check" class="w-5 h-5 text-deep-cocoa-brown-400"></i>
                        {{ __('messages.booking') }}
                    </a>

                    <a href="{{ route('home') }}#our-vets"
                        class="flex items-center gap-3 text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-50 transition-all duration-200">
                        <i data-lucide="stethoscope" class="w-5 h-5 text-deep-cocoa-brown-400"></i>
                        {{ __('messages.our_vets') }}
                    </a>

                    <a href="{{ route('home') }}#harga"
                        class="flex items-center gap-3 text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-50 transition-all duration-200">
                        <i data-lucide="crown" class="w-5 h-5 text-deep-cocoa-brown-400"></i>
                        {{ __('messages.bundle') }}
                    </a>
                    <a href="{{ route('home') }}#testimoni"
                        class="flex items-center gap-3 text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-50 transition-all duration-200">
                        <i data-lucide="message-square-heart" class="w-5 h-5 text-deep-cocoa-brown-400"></i>
                        {{ __('messages.testimonials') }}
                    </a>
                    <a href="{{ route('home') }}#lokasi"
                        class="flex items-center gap-3 text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-50 transition-all duration-200">
                        <i data-lucide="map-pin" class="w-5 h-5 text-deep-cocoa-brown-400"></i>
                        {{ __('messages.location') }}
                    </a>
                </div>

                <!-- 3. Bottom Actions -->
                <div class="pt-4 border-t border-soft-linen-100 space-y-4">
                    <div class="flex items-center justify-between bg-soft-linen-50 rounded-xl p-2 px-3">
                        <span class="text-sm font-medium text-deep-cocoa-brown-600 flex items-center gap-2">
                            <i data-lucide="languages" class="w-4 h-4"></i> {{ __('messages.language') }}
                        </span>
                        <x-lang-switch :locales="['id', 'en']" />
                    </div>

                    <div class="flex flex-col items-center w-full">
                        <button id="emergency-call-mobile"
                            class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3.5 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 font-bold shadow-lg shadow-red-200 hover:shadow-red-300 transform active:scale-95">
                            <i data-lucide="phone-call" class="w-5 h-5 animate-pulse"></i>
                            <span>{{ __('messages.emergency_call') }}</span>
                        </button>
                        <a href="tel:+6281295911911" class="text-xs font-bold text-red-500 hover:text-red-600 mt-2 tracking-wide transition-colors">+62 812 9591 1911</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
