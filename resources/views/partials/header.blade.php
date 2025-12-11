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
            <div class="flex-shrink-0 flex items-center gap-3 group">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-forest-moss-green-500 to-forest-moss-green-700 rounded-xl flex items-center justify-center shadow-md group-hover:shadow-forest-moss-green-500/20 transition-all duration-300">
                    <i data-lucide="heart" class="text-soft-linen-50 w-5 h-5 fill-current"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-bold text-deep-cocoa-brown-800 font-heading leading-tight tracking-tight group-hover:text-forest-moss-green-800 transition-colors">Zow Vetique</span>
                    <span class="text-[0.65rem] font-medium text-deep-cocoa-brown-500 uppercase tracking-widest">Pet Wellness Hub</span>
                </div>
            </div>

            <!-- Desktop Navigation (Center) -->
            <div class="hidden lg:flex flex-1 items-center justify-center gap-1">
                <a href="#beranda"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.home') }}</a>
                
                <div class="relative group">
                    <button
                        class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200 inline-flex items-center gap-1">
                        {{ __('messages.services') }}
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-deep-cocoa-brown-400 group-hover:text-forest-moss-green-600 transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>
                    
                    <!-- Dropdown -->
                    <div
                        class="absolute left-1/2 -translate-x-1/2 top-full mt-2 w-48 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl shadow-deep-cocoa-brown-900/10 border border-soft-linen-100 p-1.5 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 z-50">
                        <a href="#health"
                            class="flex items-center gap-2 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 font-medium text-sm px-3 py-2.5 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-forest-moss-green-300"></span>
                            {{ __('messages.health') }}
                        </a>
                        <a href="#wellness"
                            class="flex items-center gap-2 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 font-medium text-sm px-3 py-2.5 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-forest-moss-green-300"></span>
                            {{ __('messages.wellness') }}
                        </a>
                        <a href="#booking"
                            class="flex items-center gap-2 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 font-medium text-sm px-3 py-2.5 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-forest-moss-green-300"></span>
                            {{ __('messages.booking') }}
                        </a>
                    </div>
                </div>

                <a href="#harga"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.pricing') }}</a>
                <a href="#keanggotaan"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.membership') }}</a>
                <a href="#testimoni"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.testimonials') }}</a>
                <a href="#lokasi"
                    class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 hover:bg-forest-moss-green-50/50 font-medium text-sm px-3 py-2 rounded-xl transition-all duration-200">{{ __('messages.location') }}</a>
            </div>

            <!-- Right Actions -->
            <div class="hidden lg:flex flex-shrink-0 items-center gap-3">
                <!-- Language Switcher -->
                <x-lang-switch :locales="['id', 'en']" />

                <div class="h-6 w-px bg-deep-cocoa-brown-100"></div>

                <!-- Emergency Button -->
                <button id="btnEmergencyCall"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-2 font-medium text-sm shadow-lg shadow-red-200 hover:shadow-red-300 transform hover:-translate-y-0.5 animate-pulse hover:animate-none">
                    <i data-lucide="phone-call" class="w-3.5 h-3.5 fill-current"></i>
                    <span>Emergency</span>
                </button>

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
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="text-forest-moss-green-700 font-bold text-xs">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="absolute right-0 top-full mt-2 w-56 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl shadow-deep-cocoa-brown-900/10 border border-soft-linen-100 p-2 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <div class="px-3 py-2 border-b border-soft-linen-100 mb-1">
                                <p class="text-sm font-semibold text-deep-cocoa-brown-800 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-deep-cocoa-brown-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 text-sm">
                                <i data-lucide="user" class="w-4 h-4"></i>
                                <span>Profile</span>
                            </a>
                            <a href="{{ route('history') }}"
                                class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-forest-moss-green-50/50 transition-all duration-200 text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 text-sm">
                                <i data-lucide="history" class="w-4 h-4"></i>
                                <span>History</span>
                            </a>
                            <div class="border-t border-soft-linen-100 my-1"></div>
                            <form action="{{ route('auth.signout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-red-50 transition-all duration-200 text-red-600 hover:text-red-700 text-sm">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2 ml-1">
                        <button data-open-signin
                            class="text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 font-medium text-sm px-4 py-2 rounded-xl hover:bg-soft-linen-100 transition-all duration-200">
                            Sign In
                        </button>
                        <button data-open-signup
                            class="bg-forest-moss-green-600 hover:bg-forest-moss-green-700 text-white px-5 py-2 rounded-xl transition-all duration-200 font-medium text-sm shadow-lg shadow-forest-moss-green-600/20 hover:shadow-forest-moss-green-600/30 transform hover:-translate-y-0.5">
                            Sign Up
                        </button>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn"
                class="lg:hidden p-2.5 rounded-xl text-deep-cocoa-brown-600 hover:bg-soft-linen-100 transition-all duration-200 justify-self-end">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden border-t border-soft-linen-100">
            <div class="p-4 space-y-1">
                <a href="#beranda"
                    class="block text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-100 transition-all duration-200">{{ __('messages.home') }}</a>
                
                <div class="space-y-1 py-1">
                    <div class="px-4 py-2 text-xs font-semibold text-deep-cocoa-brown-400 uppercase tracking-wider">{{ __('messages.services') }}</div>
                    <a href="#health"
                        class="block text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 py-2.5 px-6 rounded-xl hover:bg-soft-linen-100 transition-all duration-200 text-sm border-l-2 border-transparent hover:border-forest-moss-green-300">
                        {{ __('messages.health') }}
                    </a>
                    <a href="#wellness"
                        class="block text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 py-2.5 px-6 rounded-xl hover:bg-soft-linen-100 transition-all duration-200 text-sm border-l-2 border-transparent hover:border-forest-moss-green-300">
                        {{ __('messages.wellness') }}
                    </a>
                    <a href="#booking"
                        class="block text-deep-cocoa-brown-600 hover:text-forest-moss-green-700 py-2.5 px-6 rounded-xl hover:bg-soft-linen-100 transition-all duration-200 text-sm border-l-2 border-transparent hover:border-forest-moss-green-300">
                        {{ __('messages.booking') }}
                    </a>
                </div>

                <a href="#harga"
                    class="block text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-100 transition-all duration-200">{{ __('messages.pricing') }}</a>
                <a href="#keanggotaan"
                    class="block text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-100 transition-all duration-200">{{ __('messages.membership') }}</a>
                <a href="#testimoni"
                    class="block text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-100 transition-all duration-200">{{ __('messages.testimonials') }}</a>
                <a href="#lokasi"
                    class="block text-deep-cocoa-brown-700 hover:text-forest-moss-green-700 font-medium py-3 px-4 rounded-xl hover:bg-soft-linen-100 transition-all duration-200">{{ __('messages.location') }}</a>
            </div>

            <div class="p-4 border-t border-soft-linen-100 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-deep-cocoa-brown-600">Language</span>
                    <x-lang-switch :locales="['id', 'en']" />
                </div>

                <button id="emergency-call-mobile"
                    class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 font-medium shadow-md shadow-red-200 animate-pulse hover:animate-none">
                    <i data-lucide="phone-call" class="w-4 h-4"></i>
                    <span>Emergency Call</span>
                </button>

                @auth
                    <div class="pt-2 border-t border-soft-linen-100">
                        <div class="flex items-center gap-3 mb-3 px-2">
                            <div class="w-10 h-10 bg-forest-moss-green-100 rounded-full flex items-center justify-center overflow-hidden">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-forest-moss-green-700 font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-deep-cocoa-brown-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-deep-cocoa-brown-500">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('profile') }}" class="flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-soft-linen-50 text-deep-cocoa-brown-600 text-sm font-medium">
                                <i data-lucide="user" class="w-4 h-4"></i> Profile
                            </a>
                            <form action="{{ route('auth.signout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-red-50 text-red-600 text-sm font-medium">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-3">
                        <button data-open-signin
                            class="w-full text-deep-cocoa-brown-700 font-medium text-sm px-4 py-3 rounded-xl bg-soft-linen-100 hover:bg-soft-linen-200 transition-all duration-200">
                            Sign In
                        </button>
                        <button data-open-signup
                            class="w-full bg-forest-moss-green-600 hover:bg-forest-moss-green-700 text-white px-4 py-3 rounded-xl transition-all duration-200 font-medium text-sm shadow-md">
                            Sign Up
                        </button>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
