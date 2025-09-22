<!-- Header -->
<header id="header"
    class="fixed top-3 left-1/2 transform -translate-x-1/2 w-full max-w-[98vw] xl:max-w-7xl mx-auto px-1 sm:px-2 z-50 transition-all duration-300">
    <div
        class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/40 mx-0.5 sm:mx-1 ring-1 ring-black/10 relative overflow-hidden header-container">
        <!-- Progress Bar -->
        <div id="scrollProgress"
            class="absolute top-0 left-0 h-1 bg-gradient-to-r from-matcha-500 to-matcha-600 transition-transform duration-150 ease-out z-10"
            style="transform: scaleX(0); transform-origin: left; will-change: transform; width: 100%;"></div>
        <nav class="flex items-center justify-between py-2.5 px-2 sm:px-4 lg:px-6">
            <!-- Logo (Left) -->
            <div class="flex items-center space-x-2.5 flex-shrink-0">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-matcha-500 to-matcha-600 rounded-xl flex items-center justify-center shadow-md">
                    <i data-lucide="heart" class="text-white w-5 h-5"></i>
                </div>
                <span class="text-xl font-bold text-carob-800 font-heading tracking-tight">Zow Zow</span>
            </div>

            <!-- Desktop Navigation (Center) -->
            <div class="hidden lg:flex items-center space-x-1 xl:space-x-3 flex-1 justify-center ml-1 xl:ml-4">
                <a href="#beranda"
                    class="text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium text-xs xl:text-sm px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-almond-50 whitespace-nowrap">{{ __('messages.home') }}</a>
                <a href="#layanan"
                    class="text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium text-xs xl:text-sm px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-almond-50 whitespace-nowrap">{{ __('messages.services') }}</a>
                <a href="#harga"
                    class="text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium text-xs xl:text-sm px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-almond-50 whitespace-nowrap">{{ __('messages.pricing') }}</a>
                <a href="#keanggotaan"
                    class="text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium text-xs xl:text-sm px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-almond-50 whitespace-nowrap">{{ __('messages.membership') }}</a>
                <a href="#testimoni"
                    class="text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium text-xs xl:text-sm px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-almond-50 whitespace-nowrap">{{ __('messages.testimonials') }}</a>
                <a href="#lokasi"
                    class="text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium text-xs xl:text-sm px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-almond-50 whitespace-nowrap">{{ __('messages.location') }}</a>
            </div>

            <!-- Language Switch & Action Buttons (Right) -->
            <div class="hidden lg:flex items-center space-x-1 xl:space-x-2 flex-shrink-0 header-right">
                <!-- Language Switcher -->
                <x-lang-switch :locales="['id', 'en']" />

                <div class="h-5 w-px bg-almond-200"></div>

                <!-- Contact Buttons -->
                <div class="flex items-center space-x-0.5">
                    <a href="tel:+6281234567890"
                        class="bg-matcha-500 text-white px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-matcha-600 transition-all duration-200 flex items-center space-x-1 font-medium text-xs shadow-lg hover:shadow-xl">
                        <i data-lucide="phone" class="w-3 h-3"></i>
                        <span class="hidden xl:inline">{{ __('messages.call') }}</span>
                    </a>
                    <a href="https://wa.me/6281234567890"
                        class="bg-matcha-500 text-white px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-matcha-600 transition-all duration-200 flex items-center space-x-1 font-medium text-xs shadow-lg hover:shadow-xl">
                        <i data-lucide="message-circle" class="w-3 h-3"></i>
                        <span class="hidden xl:inline">{{ __('messages.whatsapp') }}</span>
                    </a>
                </div>

                <div class="h-5 w-px bg-almond-200"></div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-0.5">
                    <button
                        class="text-carob-600 hover:text-matcha-600 transition-all duration-200 font-medium text-xs xl:text-sm px-1.5 xl:px-2.5 py-1.5 hover:bg-almond-50 rounded-lg whitespace-nowrap">{{ __('messages.login') }}</button>
                    <button
                        class="bg-chai-500 text-white px-1.5 xl:px-3 py-1.5 rounded-lg hover:bg-chai-600 transition-all duration-200 font-medium text-xs xl:text-sm shadow-lg hover:shadow-xl whitespace-nowrap">{{ __('messages.register') }}</button>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn"
                class="lg:hidden p-2 rounded-lg hover:bg-almond-100 transition-all duration-200 text-carob-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden pb-4">
            <div class="px-6">
                <!-- Navigation Links - Vertical Layout -->
                <div class="space-y-2 py-3">
                    <a href="#beranda"
                        class="block text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium py-3 px-4 rounded-lg hover:bg-almond-50">{{ __('messages.home') }}</a>
                    <a href="#layanan"
                        class="block text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium py-3 px-4 rounded-lg hover:bg-almond-50">{{ __('messages.services') }}</a>
                    <a href="#harga"
                        class="block text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium py-3 px-4 rounded-lg hover:bg-almond-50">{{ __('messages.pricing') }}</a>
                    <a href="#keanggotaan"
                        class="block text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium py-3 px-4 rounded-lg hover:bg-almond-50">{{ __('messages.membership') }}</a>
                    <a href="#testimoni"
                        class="block text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium py-3 px-4 rounded-lg hover:bg-almond-50">{{ __('messages.testimonials') }}</a>
                    <a href="#lokasi"
                        class="block text-carob-700 hover:text-matcha-600 transition-all duration-200 font-medium py-3 px-4 rounded-lg hover:bg-almond-50">{{ __('messages.location') }}</a>
                </div>

                <div class="border-t border-almond-200 pt-4 mt-4">
                    <!-- Language Switcher -->
                    <div class="flex items-center justify-center space-x-1 mb-4 bg-almond-100 rounded-lg p-1">
                        <a href="{{ route('locale.set', 'id') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium 
                                  {{ app()->getLocale() === 'id' ? 'bg-white text-[#725C3A] shadow' : 'text-[#725C3A] hover:bg-white hover:shadow' }}">
                            ID
                        </a>
                        <a href="{{ route('locale.set', 'en') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium 
                                  {{ app()->getLocale() === 'en' ? 'bg-white text-[#725C3A] shadow' : 'text-[#725C3A] hover:bg-white hover:shadow' }}">
                            EN
                        </a>
                    </div>

                    <!-- Contact Buttons -->
                    <div class="flex justify-center gap-2 mb-4">
                        <a href="tel:+6281234567890"
                            class="bg-matcha-500 text-white px-4 py-2 rounded-lg hover:bg-matcha-600 transition-all duration-200 flex items-center space-x-2 font-medium text-sm shadow-lg hover:shadow-xl">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            <span>{{ __('messages.call') }}</span>
                        </a>
                        <a href="https://wa.me/6281234567890"
                            class="bg-matcha-500 text-white px-4 py-2 rounded-lg hover:bg-matcha-600 transition-all duration-200 flex items-center space-x-2 font-medium text-sm shadow-lg hover:shadow-xl">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>{{ __('messages.whatsapp') }}</span>
                        </a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex space-x-3">
                        <button
                            class="text-carob-600 hover:text-matcha-600 transition-all duration-200 font-medium px-4 py-2 hover:bg-almond-50 rounded-lg flex-1 border border-almond-200">{{ __('messages.login') }}</button>
                        <button
                            class="bg-chai-500 text-white px-4 py-2 rounded-lg hover:bg-chai-600 transition-all duration-200 font-medium flex-1 shadow-lg hover:shadow-xl">{{ __('messages.register') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>