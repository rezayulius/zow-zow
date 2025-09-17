<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetWellness Hub - Klinik Hewan Jakarta</title>
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🐾</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Hero Slider - Core Animation States Only */
        .slide {
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .slide:not(.active) {
            opacity: 0;
            transform: translateX(100%);
        }
        
        .slide.active {
            opacity: 1;
            transform: translateX(0);
        }
        
        .slide.prev {
            transform: translateX(-100%);
        }

        /* Animation for top badge/header - slide down */
        .slide-badge {
            animation: slideDownFromTop 1.0s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.1s both;
        }

        /* Parallax Scrolling Effects */
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .parallax-element {
            transform: translateZ(0);
            will-change: transform;
        }

        .parallax-slow {
            transform: translate3d(0, var(--parallax-offset-slow, 0), 0);
        }

        .parallax-medium {
            transform: translate3d(0, var(--parallax-offset-medium, 0), 0);
        }

        .parallax-fast {
            transform: translate3d(0, var(--parallax-offset-fast, 0), 0);
        }

        /* Custom Gradients - Keep only complex ones */
        .gradient-text {
            background: linear-gradient(135deg, #8B7355 0%, #7BA05B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Floating Elements and Micro-interactions */
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(2) {
            animation-delay: -2s;
        }

        .floating-element:nth-child(3) {
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .pulse-effect {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .bounce-in {
            animation: bounceIn 0.6s ease-out;
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Keep only complex animations */
        .shake-on-hover:hover {
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
            20%, 40%, 60%, 80% { transform: translateX(2px); }
        }

        /* Animation for left content - slide in from right */
        .slide-content-left {
            animation: slideInFromRight 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s both;
        }

        /* Animation for right content - slide in from left */
        .slide-content-right {
            animation: slideInFromLeft 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.5s both;
        }

        /* Exit animations - opposite direction */
        .slide.exiting .slide-badge {
            animation: slideUpToTop 0.5s cubic-bezier(0.55, 0.055, 0.675, 0.19) both;
        }

        .slide.exiting .slide-content-left {
            animation: slideOutToRight 0.5s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0.1s both;
        }

        .slide.exiting .slide-content-right {
            animation: slideOutToLeft 0.5s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0.05s both;
        }

        /* Progress Bar - Simplified */
        .progress-indicator {
            contain: layout style paint;
        }
        
        .progress-bar-fill {
            @apply absolute inset-0 h-full w-0 rounded-sm shadow-sm;
            background: linear-gradient(90deg, #84cc16, #65a30d);
            transition: width 0.1s ease-out;
            will-change: width;
            transform: translateZ(0);
        }
        
        .progress-indicator.active .progress-bar-fill {
            animation: progressFill 5s linear;
        }

        /* Slider Progress Bar & Navigation */
        .progress-indicator[data-slide="0"] .progress-bar-fill {
            background: linear-gradient(90deg, #8B7355, #A0845C);
        }
        
        .progress-indicator[data-slide="1"] .progress-bar-fill {
            background: linear-gradient(90deg, #7BA05B, #8FB069);
        }
        
        .progress-indicator[data-slide="2"] .progress-bar-fill {
            background: linear-gradient(90deg, #D4A574, #E0B584);
        }
        
        .slide-nav-btn.active div {
            background-color: white !important;
            transform: scale(1.25);
        }
        
        .slide-nav-btn[data-slide="0"].active div {
            background-color: #8B7355 !important;
        }
        
        .slide-nav-btn[data-slide="1"].active div {
            background-color: #7BA05B !important;
        }
        
        .slide-nav-btn[data-slide="2"].active div {
            background-color: #D4A574 !important;
        }
        
        .slide-nav-btn[data-slide="3"].active div {
            background-color: #F4E4BC !important;
        }
        
        /* Progress bar colors for slide 4 */
        .progress-indicator[data-slide="3"] .progress-bar-fill {
            background: linear-gradient(90deg, #F4E4BC, #D4A574);
        }

        /* Button Shine Effect */
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        /* Card Hover Effects */
        .service-card {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .service-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .service-icon {
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Floating Animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        .floating-delayed {
            animation: floating 3s ease-in-out infinite;
            animation-delay: 1.5s;
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Keyframes for top badge */
        @keyframes slideDownFromTop {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUpToTop {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-50px);
            }
        }

        /* Keyframes for left content */
        @keyframes slideInFromRight {
            from {
                opacity: 0;
                transform: translateX(80px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutToRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(80px);
            }
        }

        /* Keyframes for right content */
        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-80px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutToLeft {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(-100px);
            }
        }

        /* Progress Fill Animation (Optimized with transform) */
        @keyframes progressFill {
            from {
                width: 0%;
            }
            to {
                width: 100%;
            }
        }
        
        /* Alternative transform-based animation for better performance */
        @keyframes progressFillTransform {
            from {
                transform: scaleX(0);
            }
            to {
                transform: scaleX(1);
            }
        }

        .slide:not(.active) .slide-content {
            animation: slideOutContent 0.5s ease-in both;
        }

        @keyframes slideOutContent {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        .progress-bar {
            transition: width 0.1s linear;
        }

        .indicator.active {
            background-color: white;
            transform: scale(1.2);
        }

        .indicator:not(.active) {
            background-color: rgba(255, 255, 255, 0.5);
        }

        /* Header responsive styles */
        @media (max-width: 1280px) {
            .header-container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }
        
        @media (max-width: 1024px) {
            .header-right {
                gap: 0.5rem !important;
            }
            
            .header-right a, .header-right button {
                font-size: 0.875rem !important;
                padding: 0.5rem 1rem !important;
            }
        }

        /* Responsive adjustments for slider */
        @media (max-width: 768px) {
            .slide h1 {
                font-size: 2.5rem !important;
            }
            
            .slide h2 {
                font-size: 1.5rem !important;
            }
            
            .hero-slider {
                min-h-[500px] !important;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-almond-50 to-vanilla-100 text-carob-800">
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
                        <span class="text-white text-lg font-bold">🐾</span>
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
                            <span>📞</span>
                            <span class="hidden xl:inline">{{ __('messages.call') }}</span>
                        </a>
                        <a href="https://wa.me/6281234567890"
                            class="bg-matcha-500 text-white px-1.5 xl:px-2.5 py-1.5 rounded-lg hover:bg-matcha-600 transition-all duration-200 flex items-center space-x-1 font-medium text-xs shadow-lg hover:shadow-xl">
                            <span>💬</span>
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
                                <span>📞</span>
                                <span>{{ __('messages.call') }}</span>
                            </a>
                            <a href="https://wa.me/6281234567890"
                                class="bg-matcha-500 text-white px-4 py-2 rounded-lg hover:bg-matcha-600 transition-all duration-200 flex items-center space-x-2 font-medium text-sm shadow-lg hover:shadow-xl">
                                <span>💬</span>
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
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24">
        <!-- Hero Section (Beranda) - Auto Slider -->
        <section id="beranda" class="relative overflow-hidden bg-gradient-to-br from-almond-50 via-white to-matcha-50">
            <div class="relative overflow-hidden min-h-[100svh] sm:min-h-screen max-h-none">
                
                <!-- Slide 1: Complete Care -->
                <div class="slide active absolute inset-0 w-full h-full z-10" data-slide="0">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#8B7355]/10 to-[#7BA05B]/10"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-full flex items-center pt-20 pb-20 sm:pt-24 sm:pb-24 md:pt-20 md:pb-20 lg:pt-16 lg:pb-16 xl:pt-12 xl:pb-12">
                        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center w-full">
                            <div class="slide-content-left">
                                <div class="slide-badge inline-flex items-center bg-[#8B7355] text-white px-4 py-2 rounded-full text-sm font-medium mb-6 animate-pulse">
                                    <span class="mr-2">🎁</span>
                                    <span>Special Promo!</span>
                                    <span class="ml-2 bg-white/20 px-2 py-1 rounded text-xs">Limited Time</span>
                                </div>
                                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-extrabold text-[#8B7355] mb-2 sm:mb-3 md:mb-4 leading-tight tracking-tight">
                                    Complete Care
                                </h1>
                                <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold gradient-text mb-3 sm:mb-4 md:mb-6 leading-relaxed">
                                    for Your Beloved Pets
                                </h2>
                                <p class="text-sm sm:text-base lg:text-lg text-carob-600 mb-4 sm:mb-6 md:mb-8 leading-relaxed tracking-wide max-w-2xl">
                                    Discover our comprehensive pet wellness services including veterinary care, grooming, boarding, and a cozy cafe.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 md:gap-4 mb-4 sm:mb-6 md:mb-8">
                                    <button class="btn-primary relative overflow-hidden bg-[#8B7355] text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-[#8B7355]/90 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold shadow-lg text-sm sm:text-base">
                                        <span class="mr-2">📅</span>
                                        Book Appointment
                                    </button>
                                    <button class="bg-white text-carob-700 px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-almond-50 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold border-2 border-carob-200 hover:border-carob-400 text-sm sm:text-base">
                                        <span class="mr-2">📞</span>
                                        Call Now
                                    </button>
                                </div>
                                <div class="flex items-center justify-center sm:justify-start space-x-3 sm:space-x-6 md:space-x-8 text-center">
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-carob-700">500+</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Happy Pets</div>
                                    </div>
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-carob-700">5+</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Years Experience</div>
                                    </div>
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-carob-700">24/7</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Support</div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-content-right relative mt-6 sm:mt-8 lg:mt-0">
                                <div class="parallax-element parallax-slow relative bg-white rounded-2xl shadow-2xl overflow-hidden transform will-change-transform">
                                    <img src="https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                         alt="Complete Care" class="w-full h-48 sm:h-64 md:h-80 lg:h-96 object-cover">
                                    <div class="absolute top-4 right-4 bg-white rounded-full p-3 shadow-lg">
                                        <div class="flex items-center text-chai-500">
                                            <span class="text-sm font-bold mr-1">4.9/5</span>
                                            <span>⭐</span>
                                        </div>
                                        <div class="text-xs text-carob-500 text-center">Rating</div>
                                    </div>
                                    <div class="absolute bottom-4 left-4 bg-matcha-500 text-white px-4 py-2 rounded-lg">
                                        <div class="flex items-center">
                                            <span class="mr-2">😊</span>
                                            <div>
                                                <div class="font-semibold text-sm">Premium Care</div>
                                                <div class="text-xs opacity-90">Professional veterinary services</div>
                                                <div class="bg-white/20 text-xs px-2 py-1 rounded mt-1 inline-block">Trusted by 500+ pets</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Emergency Care -->
                <div class="slide absolute inset-0 w-full h-full z-[1]" data-slide="1">
                    <div class="absolute inset-0 bg-gradient-to-r from-matcha-500/10 to-carob-700/10"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-full flex items-center pt-20 pb-20 sm:pt-24 sm:pb-24 md:pt-20 md:pb-20 lg:pt-16 lg:pb-16 xl:pt-12 xl:pb-12">
                        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center w-full">
                            <div class="slide-content-left">
                                <div class="slide-badge inline-flex items-center bg-matcha-500 text-white px-4 py-2 rounded-full text-sm font-medium mb-6 animate-pulse">
                                    <span class="mr-2">🚨</span>
                                    <span>Emergency Ready!</span>
                                    <span class="ml-2 bg-white/20 px-2 py-1 rounded text-xs">Always Available</span>
                                </div>
                                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-extrabold text-matcha-600 mb-2 sm:mb-3 md:mb-4 leading-tight tracking-tight">
                                    Emergency Care
                                </h1>
                                <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold text-carob-700 mb-3 sm:mb-4 md:mb-6 leading-relaxed">
                                    24/7 Always Ready
                                </h2>
                                <p class="text-sm sm:text-base lg:text-lg text-carob-600 mb-4 sm:mb-6 md:mb-8 leading-relaxed tracking-wide max-w-2xl">
                                    Our emergency veterinary services are available round the clock to ensure your pet gets immediate care when needed.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 md:gap-4 mb-4 sm:mb-6 md:mb-8">
                                    <button class="btn-primary relative overflow-hidden bg-matcha-500 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-matcha-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold shadow-lg text-sm sm:text-base">
                                        <span class="mr-2">📅</span>
                                        Book Appointment
                                    </button>
                                    <button class="bg-white text-matcha-600 px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-almond-50 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold border-2 border-matcha-200 hover:border-matcha-400 text-sm sm:text-base">
                                        <span class="mr-2">📞</span>
                                        Call Now
                                    </button>
                                </div>
                                <div class="flex items-center justify-center sm:justify-start space-x-3 sm:space-x-6 md:space-x-8 text-center">
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-matcha-600">500+</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Happy Pets</div>
                                    </div>
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-matcha-600">5+</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Years Experience</div>
                                    </div>
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-matcha-600">24/7</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Support</div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-content-right relative mt-6 sm:mt-8 lg:mt-0">
                                <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1576201836106-db1758fd1c97?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                         alt="Emergency Care" class="w-full h-48 sm:h-64 md:h-80 lg:h-96 object-cover">
                                    <div class="absolute top-4 right-4 bg-white rounded-full p-3 shadow-lg">
                                        <div class="flex items-center text-chai-500">
                                            <span class="text-sm font-bold mr-1">4.9/5</span>
                                            <span>⭐</span>
                                        </div>
                                        <div class="text-xs text-carob-500 text-center">Rating</div>
                                    </div>
                                    <div class="absolute bottom-4 left-4 bg-carob-700 text-white px-4 py-2 rounded-lg">
                                        <div class="flex items-center">
                                            <span class="mr-2">⏰</span>
                                            <div>
                                                <div class="font-semibold text-sm">Emergency Care</div>
                                                <div class="text-xs opacity-90">Immediate response guaranteed</div>
                                                <div class="bg-white/20 text-xs px-2 py-1 rounded mt-1 inline-block">5-minute response time</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Luxury Spa -->
                <div class="slide absolute inset-0 w-full h-full z-[1]" data-slide="2">
                    <div class="absolute inset-0 bg-gradient-to-r from-chai-500/10 to-carob-700/10"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-full flex items-center pt-20 pb-20 sm:pt-24 sm:pb-24 md:pt-20 md:pb-20 lg:pt-16 lg:pb-16 xl:pt-12 xl:pb-12">
                        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center w-full">
                            <div class="slide-content-left">
                                <div class="slide-badge inline-flex items-center bg-chai-500 text-white px-4 py-2 rounded-full text-sm font-medium mb-6 animate-pulse">
                                    <span class="mr-2">✨</span>
                                    <span>Luxury Package!</span>
                                    <span class="ml-2 bg-white/20 px-2 py-1 rounded text-xs">VIP Treatment</span>
                                </div>
                                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-extrabold text-chai-600 mb-2 sm:mb-3 md:mb-4 leading-tight tracking-tight">
                                    Luxury Spa
                                </h1>
                                <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold text-carob-700 mb-3 sm:mb-4 md:mb-6 leading-relaxed">
                                    & Grooming Services
                                </h2>
                                <p class="text-sm sm:text-base lg:text-lg text-carob-600 mb-4 sm:mb-6 md:mb-8 leading-relaxed tracking-wide max-w-2xl">
                                    Premium grooming and spa treatments to keep your pets looking and feeling their absolute best with our luxury services.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 md:gap-4 mb-4 sm:mb-6 md:mb-8">
                                    <button class="btn-primary relative overflow-hidden bg-chai-500 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-chai-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold shadow-lg text-sm sm:text-base">
                                        <span class="mr-2">📅</span>
                                        Book Appointment
                                    </button>
                                    <button class="bg-white text-chai-600 px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-almond-50 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold border-2 border-chai-200 hover:border-chai-400 text-sm sm:text-base">
                                        <span class="mr-2">📞</span>
                                        Call Now
                                    </button>
                                </div>
                                <div class="flex items-center justify-center sm:justify-start space-x-3 sm:space-x-6 md:space-x-8 text-center">
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-chai-600">500+</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Happy Pets</div>
                                    </div>
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-chai-600">5+</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Years Experience</div>
                                    </div>
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-chai-600">24/7</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Support</div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-content-right relative mt-6 sm:mt-8 lg:mt-0">
                                <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                         alt="Luxury Spa" class="w-full h-48 sm:h-64 md:h-80 lg:h-96 object-cover">
                                    <div class="absolute top-4 right-4 bg-white rounded-full p-3 shadow-lg">
                                        <div class="flex items-center text-chai-500">
                                            <span class="text-sm font-bold mr-1">4.9/5</span>
                                            <span>⭐</span>
                                        </div>
                                        <div class="text-xs text-carob-500 text-center">Rating</div>
                                    </div>
                                    <div class="absolute bottom-4 left-4 bg-carob-700 text-white px-4 py-2 rounded-lg">
                                        <div class="flex items-center">
                                            <span class="mr-2">✨</span>
                                            <div>
                                                <div class="font-semibold text-sm">Luxury Spa</div>
                                                <div class="text-xs opacity-90">5-star grooming experience</div>
                                                <div class="bg-white/20 text-xs px-2 py-1 rounded mt-1 inline-block">Award-winning service</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4: Membership -->
                <div class="slide absolute inset-0 w-full h-full z-[1]" data-slide="3">
                    <div class="absolute inset-0 bg-gradient-to-r from-vanilla-500/10 to-chai-500/10"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-full flex items-center pt-20 pb-20 sm:pt-24 sm:pb-24 md:pt-20 md:pb-20 lg:pt-16 lg:pb-16 xl:pt-12 xl:pb-12">
                        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center w-full">
                            <div class="slide-content-left">
                                <div class="slide-badge inline-flex items-center bg-vanilla-500 text-white px-4 py-2 rounded-full text-sm font-medium mb-6 animate-pulse">
                                    <span class="mr-2">👑</span>
                                    <span>VIP Membership!</span>
                                    <span class="ml-2 bg-white/20 px-2 py-1 rounded text-xs">Exclusive Access</span>
                                </div>
                                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-extrabold text-vanilla-600 mb-2 sm:mb-3 md:mb-4 leading-tight tracking-tight">
                                    Membership
                                </h1>
                                <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold text-chai-600 mb-3 sm:mb-4 md:mb-6 leading-relaxed">
                                    Exclusive Benefits
                                </h2>
                                <p class="text-sm sm:text-base lg:text-lg text-carob-600 mb-4 sm:mb-6 md:mb-8 leading-relaxed tracking-wide max-w-2xl">
                                    Join our exclusive membership program and enjoy special discounts, priority booking, and premium services for your beloved pets.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 md:gap-4 mb-4 sm:mb-6 md:mb-8">
                                    <button class="btn-primary relative overflow-hidden bg-vanilla-500 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-vanilla-600 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold shadow-lg text-sm sm:text-base">
                                        <span class="mr-2">📅</span>
                                        Book Appointment
                                    </button>
                                    <button class="bg-white text-vanilla-600 px-6 sm:px-8 py-3 sm:py-4 rounded-xl hover:bg-almond-50 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex items-center justify-center font-semibold border-2 border-vanilla-200 hover:border-vanilla-400 text-sm sm:text-base">
                                        <span class="mr-2">📞</span>
                                        Call Now
                                    </button>
                                </div>
                                <div class="flex items-center justify-center sm:justify-start space-x-3 sm:space-x-6 md:space-x-8 text-center">
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-vanilla-600">500+</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Happy Pets</div>
                                    </div>
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-vanilla-600">5+</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Years Experience</div>
                                    </div>
                                    <div>
                                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-vanilla-600">24/7</div>
                                        <div class="text-xs sm:text-sm text-carob-600">Support</div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-content-right relative mt-6 sm:mt-8 lg:mt-0">
                                <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                         alt="Membership" class="w-full h-48 sm:h-64 md:h-80 lg:h-96 object-cover">
                                    <div class="absolute top-4 right-4 bg-white rounded-full p-3 shadow-lg">
                                        <div class="flex items-center text-chai-500">
                                            <span class="text-sm font-bold mr-1">4.9/5</span>
                                            <span>⭐</span>
                                        </div>
                                        <div class="text-xs text-carob-500 text-center">Rating</div>
                                    </div>
                                    <div class="absolute bottom-4 left-4 bg-chai-600 text-white px-4 py-2 rounded-lg">
                                        <div class="flex items-center">
                                            <span class="mr-2">👑</span>
                                            <div>
                                                <div class="font-semibold text-sm">VIP Member</div>
                                                <div class="text-xs opacity-90">Exclusive perks & priority</div>
                                                <div class="bg-white/20 text-xs px-2 py-1 rounded mt-1 inline-block">Join 1000+ happy members</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            
            <!-- Slider Progress Bar & Navigation -->
            <div class="absolute bottom-8 sm:bottom-10 md:bottom-12 left-1/2 transform -translate-x-1/2 z-20 pb-4 sm:pb-0">
                <div class="flex flex-col items-center space-y-3 sm:space-y-4">
                    <!-- Progress Bar -->
                    <div class="flex space-x-1 sm:space-x-2">
                        <div class="progress-indicator active" data-slide="0">
                            <div class="w-12 sm:w-16 h-1 bg-white/30 rounded-full overflow-hidden">
                                <div class="progress-bar-fill h-full w-0 rounded-full transition-all duration-300"></div>
                            </div>
                        </div>
                        <div class="progress-indicator" data-slide="1">
                            <div class="w-12 sm:w-16 h-1 bg-white/30 rounded-full overflow-hidden">
                                <div class="progress-bar-fill h-full w-0 rounded-full transition-all duration-300"></div>
                            </div>
                        </div>
                        <div class="progress-indicator" data-slide="2">
                            <div class="w-12 sm:w-16 h-1 bg-white/30 rounded-full overflow-hidden">
                                <div class="progress-bar-fill h-full w-0 rounded-full transition-all duration-300"></div>
                            </div>
                        </div>
                        <div class="progress-indicator" data-slide="3">
                            <div class="w-12 sm:w-16 h-1 bg-white/30 rounded-full overflow-hidden">
                                <div class="progress-bar-fill h-full w-0 rounded-full transition-all duration-300"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <div class="flex space-x-2 sm:space-x-3">
                        <button class="slide-nav-btn" data-slide="0" aria-label="Go to slide 1">
                            <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 hover:scale-125"></div>
                        </button>
                        <button class="slide-nav-btn" data-slide="1" aria-label="Go to slide 2">
                            <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 hover:scale-125"></div>
                        </button>
                        <button class="slide-nav-btn" data-slide="2" aria-label="Go to slide 3">
                            <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 hover:scale-125"></div>
                        </button>
                        <button class="slide-nav-btn" data-slide="3" aria-label="Go to slide 4">
                            <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 hover:scale-125"></div>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Layanan Section -->
        <section id="layanan" class="py-16 md:py-24 lg:py-32 bg-gradient-to-br from-almond-50 via-vanilla-50 to-chai-50">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16 lg:mb-20">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-carob-900 mb-6 font-heading leading-tight tracking-tight">Layanan
                        Kami</h2>
                    <p class="text-lg lg:text-xl text-carob-600 max-w-3xl mx-auto leading-relaxed">
                        Kami menyediakan berbagai layanan kesehatan hewan dengan standar internasional dan teknologi
                        terdepan.
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-matcha-200 transform will-change-transform hover:-translate-y-1">
                        <div class="w-12 h-12 bg-matcha-500 rounded-lg flex items-center justify-center mb-4 transition-transform duration-300 hover:rotate-6 hover:scale-110">
                            <span class="text-white text-xl">🩺</span>
                        </div>
                        <h3 class="text-lg font-semibold text-carob-900 mb-3">Pemeriksaan Umum</h3>
                        <p class="text-carob-600 text-sm leading-relaxed">Pemeriksaan kesehatan rutin dan diagnosis
                            komprehensif untuk menjaga kesehatan hewan peliharaan Anda.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-pistache-200 hover:-translate-y-1">
                        <div class="w-12 h-12 bg-pistache-500 rounded-lg flex items-center justify-center mb-4 transition-transform duration-300 hover:rotate-6 hover:scale-110">
                            <span class="text-white text-xl">💉</span>
                        </div>
                        <h3 class="text-lg font-semibold text-carob-900 mb-3">Vaksinasi</h3>
                        <p class="text-carob-600 text-sm leading-relaxed">Program vaksinasi lengkap untuk melindungi
                            hewan peliharaan dari berbagai penyakit berbahaya.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-chai-200 hover:-translate-y-1">
                        <div class="w-12 h-12 bg-chai-500 rounded-lg flex items-center justify-center mb-4 transition-transform duration-300 hover:rotate-6 hover:scale-110">
                            <span class="text-white text-xl">🏥</span>
                        </div>
                        <h3 class="text-lg font-semibold text-carob-900 mb-3">Operasi</h3>
                        <p class="text-carob-600 text-sm leading-relaxed">Layanan bedah dengan teknologi modern dan tim
                            dokter berpengalaman untuk berbagai kondisi medis.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-matcha-200 hover:-translate-y-1">
                        <div class="w-12 h-12 bg-matcha-500 rounded-lg flex items-center justify-center mb-4 transition-transform duration-300 hover:rotate-6 hover:scale-110">
                            <span class="text-white text-xl">🦷</span>
                        </div>
                        <h3 class="text-lg font-semibold text-carob-900 mb-3">Perawatan Gigi</h3>
                        <p class="text-carob-600 text-sm leading-relaxed">Pembersihan gigi, scaling, dan perawatan
                            dental untuk menjaga kesehatan mulut hewan peliharaan.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-pistache-200 hover:-translate-y-1">
                        <div class="w-12 h-12 bg-pistache-500 rounded-lg flex items-center justify-center mb-4 transition-transform duration-300 hover:rotate-6 hover:scale-110">
                            <span class="text-white text-xl">🛁</span>
                        </div>
                        <h3 class="text-lg font-semibold text-carob-900 mb-3">Grooming</h3>
                        <p class="text-carob-600 text-sm leading-relaxed">Layanan perawatan bulu, kuku, dan kebersihan
                            untuk menjaga penampilan dan kesehatan hewan.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-chai-200 hover:-translate-y-1">
                        <div class="w-12 h-12 bg-chai-600 rounded-lg flex items-center justify-center mb-4 transition-transform duration-300 hover:rotate-6 hover:scale-110">
                            <span class="text-white text-xl">🚨</span>
                        </div>
                        <h3 class="text-lg font-semibold text-carob-900 mb-3">Emergency 24/7</h3>
                        <p class="text-carob-600 text-sm leading-relaxed">Layanan darurat 24 jam dengan tim siaga untuk
                            menangani kondisi kritis hewan peliharaan Anda.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Daftar Harga Section -->
        <section id="harga" class="py-16 md:py-24 lg:py-32 bg-gradient-to-br from-gray-50 to-blue-50">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-carob-900 mb-6 tracking-tight">Daftar
                        Harga</h2>
                    <p class="text-lg lg:text-xl text-carob-600 max-w-3xl mx-auto leading-relaxed">
                        Paket layanan dengan harga terjangkau dan kualitas terbaik
                    </p>
                </div>
                <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
                    <!-- Konsultasi Umum -->
                    <div
                        class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-matcha-200 flex-shrink-0 w-48 hover:-translate-y-1">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-matcha-100 rounded-lg flex items-center justify-center mb-3 mx-auto">
                                <span class="text-matcha-600 text-lg">🩺</span>
                            </div>
                            <h3 class="text-sm font-semibold text-carob-900 mb-2">Konsultasi Umum</h3>
                            <div class="text-lg font-bold text-matcha-600 mb-1">Rp 150K</div>
                            <p class="text-xs text-carob-500">30 menit</p>
                        </div>
                    </div>

                    <!-- Vaksinasi Dasar -->
                    <div
                        class="bg-pistache-50 p-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-pistache-200 hover:border-pistache-300 flex-shrink-0 w-48 hover:scale-105">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-pistache-100 rounded-lg flex items-center justify-center mb-3 mx-auto">
                                <span class="text-pistache-600 text-lg">💉</span>
                            </div>
                            <h3 class="text-sm font-semibold text-carob-900 mb-2">Vaksinasi Dasar</h3>
                            <div class="text-lg font-bold text-pistache-600 mb-1">Rp 200K</div>
                            <p class="text-xs text-carob-500">15 menit</p>
                        </div>
                    </div>

                    <!-- Sterilisasi Kucing -->
                    <div
                        class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-vanilla-200 flex-shrink-0 w-48 hover:-translate-y-1">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-pistache-100 rounded-lg flex items-center justify-center mb-3 mx-auto">
                                <span class="text-pistache-600 text-lg">🐱</span>
                            </div>
                            <h3 class="text-sm font-semibold text-carob-900 mb-2">Sterilisasi Kucing</h3>
                            <div class="text-lg font-bold text-pistache-600 mb-1">Rp 800K</div>
                            <p class="text-xs text-carob-500">2-3 jam</p>
                        </div>
                    </div>

                    <!-- Sterilisasi Anjing -->
                    <div
                        class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-100 hover:border-chai-200 flex-shrink-0 w-48 hover:-translate-y-1">
                        <div class="text-center">
                            <div class="w-10 h-10 bg-chai-100 rounded-lg flex items-center justify-center mb-3 mx-auto">
                                <span class="text-chai-600 text-lg">🐕</span>
                            </div>
                            <h3 class="text-sm font-semibold text-carob-900 mb-2">Sterilisasi Anjing</h3>
                            <div class="text-lg font-bold text-chai-600 mb-1">Rp 1.2M</div>
                            <p class="text-xs text-carob-500">3-4 jam</p>
                        </div>
                    </div>

                    <!-- Grooming Basic -->
                    <div
                        class="bg-matcha-50 p-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-matcha-200 hover:border-matcha-300 flex-shrink-0 w-48 hover:scale-105">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-matcha-100 rounded-lg flex items-center justify-center mb-3 mx-auto">
                                <span class="text-matcha-600 text-lg">✂️</span>
                            </div>
                            <h3 class="text-sm font-semibold text-carob-900 mb-2">Grooming Basic</h3>
                            <div class="text-lg font-bold text-matcha-600 mb-1">Rp 100K</div>
                            <p class="text-xs text-carob-500">1 jam</p>
                        </div>
                    </div>

                    <!-- Grooming Premium -->
                    <div
                        class="bg-vanilla-50 p-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-vanilla-200 hover:border-vanilla-300 flex-shrink-0 w-48 hover:scale-105">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-vanilla-100 rounded-lg flex items-center justify-center mb-3 mx-auto">
                                <span class="text-vanilla-600 text-lg">💎</span>
                            </div>
                            <h3 class="text-sm font-semibold text-carob-900 mb-2">Grooming Premium</h3>
                            <div class="text-lg font-bold text-vanilla-600 mb-1">Rp 250K</div>
                            <p class="text-xs text-carob-500">2 jam</p>
                        </div>
                    </div>
                </div>
                <div class="bg-almond-50 rounded-xl p-4 mt-6 shadow-md hover:shadow-lg transition-all duration-300">
                    <p class="text-sm text-carob-600 text-center">*Harga dapat berubah sewaktu-waktu. Untuk informasi
                        lebih lanjut, silakan hubungi kami.</p>
                </div>
                <div class="text-center mt-8">
                    <a href="#"
                        class="bg-matcha-500 text-white px-8 py-3 rounded-lg hover:bg-matcha-600 transition-colors font-semibold">
                        Konsultasi Gratis
                    </a>
                </div>
            </div>
        </section>

        <!-- Keanggotaan Section -->
        <section id="keanggotaan" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-carob-800 mb-4">Program Keanggotaan</h2>
                    <p class="text-lg text-carob-600 max-w-2xl mx-auto">
                        Bergabunglah dengan program keanggotaan kami dan nikmati berbagai keuntungan eksklusif.
                    </p>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Basic Plan -->
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-200 hover:-translate-y-1">
                        <div class="text-center mb-6">
                            <h3 class="text-xl font-semibold text-carob-900 mb-2">Basic</h3>
                            <div class="text-3xl font-bold text-matcha-600 mb-1">Rp 500K</div>
                            <p class="text-carob-600 text-sm">per tahun</p>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center space-x-2">
                                <span class="text-matcha-500 text-sm">✓</span>
                                <span class="text-sm">Diskon 10% semua layanan</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-matcha-500 text-sm">✓</span>
                                <span class="text-sm">Konsultasi gratis 2x/tahun</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-matcha-500 text-sm">✓</span>
                                <span class="text-sm">Reminder vaksinasi</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-matcha-500 text-sm">✓</span>
                                <span class="text-sm">Prioritas booking</span>
                            </li>
                        </ul>
                        <button
                            class="w-full bg-matcha-500 text-white py-2.5 rounded-lg hover:bg-matcha-600 transition-colors font-medium text-sm">
                            Pilih Basic
                        </button>
                    </div>

                    <!-- Premium Plan -->
                    <div
                        class="bg-chai-500 p-6 rounded-lg shadow-lg transform scale-105 relative border-2 border-chai-600">
                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                            <span
                                class="bg-vanilla-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-md">Populer</span>
                        </div>
                        <div class="text-center mb-6 text-white">
                            <h3 class="text-xl font-semibold mb-2">Premium</h3>
                            <div class="text-3xl font-bold mb-1">Rp 1.2M</div>
                            <p class="text-sm opacity-80">per tahun</p>
                        </div>
                        <ul class="space-y-3 mb-6 text-white">
                            <li class="flex items-center space-x-2">
                                <span class="text-sm">✓</span>
                                <span class="text-sm">Diskon 20% semua layanan</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-sm">✓</span>
                                <span class="text-sm">Konsultasi gratis 6x/tahun</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-sm">✓</span>
                                <span class="text-sm">Grooming gratis 2x/tahun</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-sm">✓</span>
                                <span class="text-sm">Emergency call 24/7</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-sm">✓</span>
                                <span class="text-sm">Health record digital</span>
                            </li>
                        </ul>
                        <button
                            class="w-full bg-white text-chai-600 py-2.5 rounded-lg hover:bg-almond-50 transition-all duration-300 font-medium text-sm shadow-lg hover:shadow-xl hover:scale-105">
                            Pilih Premium
                        </button>
                    </div>

                    <!-- VIP Plan -->
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-almond-200 hover:-translate-y-1">
                        <div class="text-center mb-6">
                            <h3 class="text-xl font-semibold text-carob-900 mb-2">VIP</h3>
                            <div class="text-3xl font-bold text-pistache-600 mb-1">Rp 2.5M</div>
                            <p class="text-carob-600 text-sm">per tahun</p>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center space-x-2">
                                <span class="text-pistache-500 text-sm">✓</span>
                                <span class="text-sm">Diskon 30% semua layanan</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-pistache-500 text-sm">✓</span>
                                <span class="text-sm">Konsultasi unlimited</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-pistache-500 text-sm">✓</span>
                                <span class="text-sm">Grooming unlimited</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-pistache-500 text-sm">✓</span>
                                <span class="text-sm">Home visit service</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="text-pistache-500 text-sm">✓</span>
                                <span class="text-sm">Personal vet assistant</span>
                            </li>
                        </ul>
                        <button
                            class="w-full bg-pistache-500 text-white py-2.5 rounded-lg hover:bg-pistache-600 transition-all duration-300 font-medium text-sm shadow-lg hover:shadow-xl hover:scale-105">
                            Pilih VIP
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoni Section -->
        <section id="testimoni" class="py-20 bg-almond-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-carob-800 mb-4">Testimoni Pelanggan</h2>
                    <p class="text-lg text-carob-600 max-w-2xl mx-auto">
                        Dengarkan pengalaman pelanggan kami yang telah mempercayakan kesehatan hewan peliharaan mereka
                        kepada kami.
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                alt="Sarah" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-carob-800">Sarah Wijaya</h4>
                                <div class="flex text-chai-400">
                                    <span>⭐⭐⭐⭐⭐</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-carob-600 italic">"Pelayanan yang sangat memuaskan! Dokternya ramah dan
                            profesional. Kucing saya Luna sekarang sehat dan aktif kembali setelah operasi di sini."</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                alt="Budi" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-carob-800">Budi Santoso</h4>
                                <div class="flex text-chai-400">
                                    <span>⭐⭐⭐⭐⭐</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-carob-600 italic">"Fasilitas modern dan bersih. Tim medis sangat berpengalaman.
                            Anjing saya Max mendapat perawatan terbaik di sini. Highly recommended!"</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                alt="Maya" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-carob-800">Maya Putri</h4>
                                <div class="flex text-chai-400">
                                    <span>⭐⭐⭐⭐⭐</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-carob-600 italic">"Layanan emergency 24 jam sangat membantu. Ketika hamster saya
                            sakit tengah malam, mereka langsung siap membantu. Terima kasih PetWellness Hub!"</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Lokasi Section -->
        <section id="lokasi" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-carob-800 mb-4">Lokasi Kami</h2>
                    <p class="text-lg text-carob-600 max-w-2xl mx-auto">
                        Kunjungi klinik kami yang strategis dan mudah dijangkau di pusat kota Jakarta.
                    </p>
                </div>
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="bg-matcha-50 p-8 rounded-lg">
                            <h3 class="text-2xl font-bold text-carob-800 mb-6">Informasi Kontak</h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-4">
                                    <span class="text-matcha-500 text-xl">📍</span>
                                    <div>
                                        <h4 class="font-semibold text-carob-800">Alamat</h4>
                                        <p class="text-carob-600">Jl. Sudirman No. 123, Menteng<br>Jakarta Pusat 10310
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <span class="text-matcha-500 text-xl">📞</span>
                                    <div>
                                        <h4 class="font-semibold text-carob-800">Telepon</h4>
                                        <p class="text-carob-600">+62 812 3456 7890</p>
                                        <p class="text-carob-600">Emergency: 162 21 1234 9999</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <span class="text-matcha-500 text-xl">✉️</span>
                                    <div>
                                        <h4 class="font-semibold text-carob-800">Email</h4>
                                        <p class="text-carob-600">info@petwellnesshub.com</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <span class="text-matcha-500 text-xl">🕒</span>
                                    <div>
                                        <h4 class="font-semibold text-carob-800">Jam Operasional</h4>
                                        <p class="text-carob-600">Senin - Jumat: 08:00 - 20:00</p>
                                        <p class="text-carob-600">Sabtu - Minggu: 09:00 - 18:00</p>
                                        <p class="text-carob-600 font-semibold">Emergency: 24/7</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-almond-200 rounded-lg h-96 flex items-center justify-center">
                            <div class="text-center">
                                <span class="text-6xl mb-4 block">🗺️</span>
                                <p class="text-carob-600">Interactive Map</p>
                                <p class="text-sm text-carob-500">Google Maps integration would be here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer with Parallax -->
    <footer class="bg-carob-900 text-white py-12 relative overflow-hidden">
        <!-- Parallax Background Elements -->
        <div class="absolute inset-0 parallax-element parallax-slow" data-parallax-speed="0.3">
            <div class="absolute top-10 left-10 w-32 h-32 bg-matcha-500/10 rounded-full blur-xl"></div>
            <div class="absolute top-20 right-20 w-24 h-24 bg-vanilla-500/10 rounded-full blur-lg"></div>
            <div class="absolute bottom-10 left-1/4 w-40 h-40 bg-carob-700/20 rounded-full blur-2xl"></div>
        </div>
        <div class="absolute inset-0 parallax-element parallax-medium" data-parallax-speed="0.5">
            <div class="absolute top-1/3 right-10 w-16 h-16 bg-matcha-400/15 rounded-full blur-md"></div>
            <div class="absolute bottom-1/4 right-1/3 w-28 h-28 bg-vanilla-400/10 rounded-full blur-lg"></div>
        </div>
        <div class="relative z-10 max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-6">
                <div>
                    <div class="flex items-center space-x-2.5 mb-4">
                        <div class="w-10 h-10 bg-matcha-500 rounded-lg shadow-md flex items-center justify-center">
                            <span class="text-white text-lg font-bold">🐾</span>
                        </div>
                        <span class="text-xl font-bold font-heading">Zow Zow</span>
                    </div>
                    <p class="text-almond-400 mb-4 text-sm leading-relaxed">
                        Klinik hewan terpercaya dengan layanan terbaik untuk sahabat berbulu Anda.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-8 h-8 bg-carob-800 rounded-lg flex items-center justify-center hover:bg-matcha-500 transition-all duration-200 hover:scale-105">
                            <span class="text-white text-sm">📘</span>
                        </a>
                        <a href="#"
                            class="w-8 h-8 bg-carob-800 rounded-lg flex items-center justify-center hover:bg-matcha-500 transition-all duration-200 hover:scale-105">
                            <span class="text-white text-sm">📷</span>
                        </a>
                        <a href="#"
                            class="w-8 h-8 bg-carob-800 rounded-lg flex items-center justify-center hover:bg-matcha-500 transition-all duration-200 hover:scale-105">
                            <span class="text-white text-sm">🐦</span>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-almond-300">
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Pemeriksaan
                                Umum</a></li>
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Vaksinasi</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Operasi</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Grooming</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Emergency</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Informasi</h4>
                    <ul class="space-y-2 text-almond-300">
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Tentang
                                Kami</a></li>
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Tim
                                Dokter</a></li>
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Karir</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">Blog</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-matcha-400 transition-all duration-200 hover:translate-x-1">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-almond-300">
                        <li>📍 Jl. Sudirman No. 123, Jakarta</li>
                        <li>📞 +62 812 3456 7890</li>
                        <li>✉️ info@petwellnesshub.com</li>
                        <li class="text-chai-400 font-semibold">🚨 Emergency: 162 21 1234 9999</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-carob-700 mt-8 pt-8 text-center text-almond-300">
                <p>&copy; 2024 PetWellness Hub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Language switcher now uses direct links, no JavaScript needed

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        // Header scroll effect & Progress bar (Optimized with throttling)
        let headerScrollTicking = false;
        const header = document.querySelector('header');
        const headerDiv = header.querySelector('div');
        const scrollProgress = document.getElementById('scrollProgress');
        
        function updateHeaderAndProgress() {
            try {
                const scrollY = window.scrollY;
                
                // Header scale effect
                if (scrollY > 100) {
                    header.classList.add('scale-95');
                    headerDiv.classList.add('shadow-xl');
                    headerDiv.classList.remove('shadow-lg');
                } else {
                    header.classList.remove('scale-95');
                    headerDiv.classList.add('shadow-lg');
                    headerDiv.classList.remove('shadow-xl');
                }

                // Progress bar animation (optimized calculation)
                const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                
                if (scrollHeight > 0) {
                    const scrollPercentage = Math.min(100, Math.max(0, (scrollY / scrollHeight) * 100));
                    const scaleValue = scrollPercentage / 100;
                    
                    // Use transform instead of width for better performance
                    if (scrollProgress) {
                        scrollProgress.style.transform = `scaleX(${scaleValue})`;
                    }
                }
            } catch (error) {
                console.warn('Progress bar update error:', error);
            } finally {
                headerScrollTicking = false;
            }
        }
        
        function requestHeaderScrollTick() {
            if (!headerScrollTicking) {
                requestAnimationFrame(updateHeaderAndProgress);
                headerScrollTicking = true;
            }
        }
        
        window.addEventListener('scroll', requestHeaderScrollTick, { passive: true });

        // Hero Slider Functionality
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.slide');

            let currentSlide = 0;
            let slideInterval;
            const slideDuration = 5000; // 5 seconds per slide

            function updateSlide(index) {
                // Add exiting class to current slide for exit animation
                if (slides[currentSlide]) {
                    slides[currentSlide].classList.add('exiting');
                }

                // Wait for exit animation to complete, then switch slides
                setTimeout(() => {
                    // Remove active and exiting class from all slides
                    slides.forEach((slide, i) => {
                        slide.classList.remove('active', 'prev', 'exiting');
                        if (i < index) {
                            slide.classList.add('prev');
                        }
                    });
                    // Add active class to new slide
                    slides[index].classList.add('active');

                    // Update progress indicators
                    updateProgressIndicators(index);

                    // Update navigation buttons
                    updateNavigationButtons(index);

                    currentSlide = index;
                }, 600); // Wait for exit animation to complete (0.5s + buffer)
            }

            function updateProgressIndicators(activeIndex) {
                const progressIndicators = document.querySelectorAll('.progress-indicator');
                
                progressIndicators.forEach((indicator, index) => {
                    const progressFill = indicator.querySelector('.progress-bar-fill');
                    
                    if (index === activeIndex) {
                        indicator.classList.add('active');
                        if (progressFill) {
                            // Reset progress bar immediately without transition
                            progressFill.style.transition = 'none';
                            progressFill.style.width = '0%';
                            progressFill.offsetHeight; // Trigger reflow
                            
                            // Start animation after a small delay
                            setTimeout(() => {
                                progressFill.style.transition = 'width 5s linear';
                                progressFill.style.width = '100%';
                            }, 50);
                        }
                    } else {
                        indicator.classList.remove('active');
                        if (progressFill) {
                            // Reset non-active progress bars immediately
                            progressFill.style.transition = 'none';
                            progressFill.style.width = '0%';
                        }
                    }
                });
            }

            function updateNavigationButtons(activeIndex) {
                const navButtons = document.querySelectorAll('.slide-nav-btn');
                
                navButtons.forEach((button, index) => {
                    if (index === activeIndex) {
                        button.classList.add('active');
                    } else {
                        button.classList.remove('active');
                    }
                });
            }

            function goToSlide(index) {
                if (index !== currentSlide && index >= 0 && index < slides.length) {
                    updateSlide(index);
                    restartSlider();
                }
            }

            function nextSlide() {
                const next = (currentSlide + 1) % slides.length;
                updateSlide(next);
                restartSlider();
            }



            function startSlider() {
                slideInterval = setInterval(() => {
                    nextSlide();
                }, slideDuration);
            }

            function stopSlider() {
                clearInterval(slideInterval);
            }

            function restartSlider() {
                stopSlider();
                startSlider();
            }

            // Initialize slider
            updateSlide(0);
            startSlider();

            // Add event listeners for navigation buttons
            const navButtons = document.querySelectorAll('.slide-nav-btn');
            navButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    goToSlide(index);
                });
            });

            // Initialize progress indicators
            updateProgressIndicators(0);
            updateNavigationButtons(0);

            // Pause slider on hover
            const heroSlider = document.querySelector('.hero-slider');
            if (heroSlider) {
                heroSlider.addEventListener('mouseenter', () => {
                    stopSlider();
                });

                heroSlider.addEventListener('mouseleave', () => {
                    startSlider();
                });
            }
        });

        // Initialize progress bar on page load (optimized)
        document.addEventListener('DOMContentLoaded', () => {
            const scrollProgress = document.getElementById('scrollProgress');
            scrollProgress.style.transform = 'scaleX(0)';
            scrollProgress.style.transformOrigin = 'left';
            
            // Initial call to set proper state
            updateHeaderAndProgress();
        });

        // Parallax Scrolling Effect
        function initParallax() {
            const parallaxElements = document.querySelectorAll('.parallax-element');
            
            function updateParallax() {
                const scrollTop = window.pageYOffset;
                const windowHeight = window.innerHeight;
                
                parallaxElements.forEach(element => {
                    const rect = element.getBoundingClientRect();
                    const elementTop = rect.top + scrollTop;
                    const elementHeight = rect.height;
                    
                    // Check if element is in viewport
                    if (rect.bottom >= 0 && rect.top <= windowHeight) {
                        const speed = element.dataset.parallaxSpeed || 0.5;
                        const yPos = -(scrollTop - elementTop) * speed;
                        
                        if (element.classList.contains('parallax-slow')) {
                            element.style.setProperty('--parallax-offset-slow', `${yPos * 0.3}px`);
                        } else if (element.classList.contains('parallax-medium')) {
                            element.style.setProperty('--parallax-offset-medium', `${yPos * 0.5}px`);
                        } else if (element.classList.contains('parallax-fast')) {
                            element.style.setProperty('--parallax-offset-fast', `${yPos * 0.8}px`);
                        }
                    }
                });
            }
            
            // Throttle scroll events for better performance
            let ticking = false;
            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                    setTimeout(() => { ticking = false; }, 16);
                }
            }
            
            window.addEventListener('scroll', requestTick);
            updateParallax(); // Initial call
        }
        
        // Initialize parallax when DOM is loaded
        document.addEventListener('DOMContentLoaded', initParallax);
    </script>
</body>

</html>