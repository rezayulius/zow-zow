<!-- Pricing & Lifestyle Section -->
<section id="harga" class="relative py-20 overflow-hidden bg-transparent">
    <!-- Background Elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-transparent via-vanilla-50/50 to-transparent opacity-50"></div>
        <div class="absolute -top-10 -left-10 rotate-12 opacity-10 animate-float-slow">
            <x-animal-icon name="cow" class="w-48 h-48 text-forest-moss-green-200" />
        </div>
        <div class="absolute bottom-20 right-10 -rotate-12 opacity-10 animate-float-medium">
            <x-animal-icon name="hamster" class="w-56 h-56 text-chai-200" />
        </div>
        <div class="absolute top-1/3 right-1/4 opacity-5 animate-pulse-slow">
            <x-animal-icon name="cat" class="w-32 h-32 text-soft-blush-pink-200" />
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center bg-vanilla-100 text-chai-800 px-6 py-2 rounded-full text-sm font-medium mb-6 shadow-sm border border-vanilla-200">
                <div class="mr-2 flex items-center">
                    <x-animal-icon name="bear" class="w-5 h-5 text-chai-600" />
                </div>
                {{ __('pricing.badge') }}
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 leading-tight">
                {{ __('pricing.title_line1') }} <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-chai-500 to-forest-moss-green-600">{{ __('pricing.title_line2') }}</span>
            </h2>
            <p class="text-carob-600 max-w-2xl mx-auto text-lg leading-relaxed">
                {{ __('pricing.subtitle') }}
            </p>
        </div>

        <!-- Pricing Cards Grid -->
        @if($pricing && $pricing->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
                @foreach($pricing as $index => $package)
                    @php
                        // Define warm, homey color schemes
                        $colorSchemes = [
                            ['bg' => 'bg-white', 'border' => 'border-chai-200', 'header_bg' => 'bg-chai-50', 'price' => 'text-chai-700', 'button' => 'bg-chai-500 hover:bg-chai-600', 'icon' => 'text-chai-500', 'ring' => 'ring-chai-100'],
                            ['bg' => 'bg-white', 'border' => 'border-forest-moss-green-200', 'header_bg' => 'bg-forest-moss-green-50', 'price' => 'text-forest-moss-green-700', 'button' => 'bg-forest-moss-green-600 hover:bg-forest-moss-green-700', 'icon' => 'text-forest-moss-green-600', 'ring' => 'ring-forest-moss-green-100'],
                            ['bg' => 'bg-white', 'border' => 'border-vanilla-300', 'header_bg' => 'bg-vanilla-50', 'price' => 'text-carob-800', 'button' => 'bg-carob-600 hover:bg-carob-700', 'icon' => 'text-vanilla-500', 'ring' => 'ring-vanilla-200'],
                            ['bg' => 'bg-white', 'border' => 'border-carob-200', 'header_bg' => 'bg-carob-50', 'price' => 'text-carob-800', 'button' => 'bg-carob-800 hover:bg-carob-900', 'icon' => 'text-carob-600', 'ring' => 'ring-carob-100'],
                        ];
                        $colors = $colorSchemes[$index % count($colorSchemes)];
                    @endphp
                    
                    <div class="group relative flex flex-col h-full bg-white rounded-[2.5rem] border {{ $colors['border'] }} shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                        @if($package->is_popular)
                            <div class="absolute top-0 right-0 bg-gradient-to-bl from-chai-400 to-chai-600 text-white text-xs font-bold px-6 py-2 rounded-bl-2xl z-20 shadow-md">
                                {{ __('pricing.most_loved') }}
                            </div>
                        @endif
                        
                        <!-- Card Header -->
                        <div class="p-8 {{ $colors['header_bg'] }} border-b border-dashed {{ $colors['border'] }} relative">
                             <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center mb-4 {{ $colors['ring'] }} ring-4">
                                <i data-lucide="{{ $index == 0 ? 'home' : ($index == 1 ? 'heart' : ($index == 2 ? 'sparkles' : 'crown')) }}" class="w-6 h-6 {{ $colors['icon'] }}"></i>
                             </div>
                            <h3 class="text-xl font-bold text-carob-900 mb-2">{{ $package->name }}</h3>
                            <p class="text-carob-600 text-sm leading-relaxed">{{ $package->description }}</p>
                        </div>

                        <!-- Card Body -->
                        <div class="p-8 flex-1 flex flex-col bg-white">
                            <div class="mb-6">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl font-bold {{ $colors['price'] }}">{{ $package->formatted_price }}</span>
                                </div>
                                @if($package->duration)
                                    <div class="flex items-center text-carob-500 text-sm mt-2 font-medium">
                                        <i data-lucide="clock" class="w-4 h-4 mr-1.5"></i>
                                        {{ $package->duration }}
                                    </div>
                                @endif
                            </div>

                            @if($package->features && is_array($package->features))
                                <div class="space-y-4 mb-8 flex-1" data-features-container>
                                    @foreach(array_slice($package->features, 0, 3) as $feature)
                                        <div class="flex items-start text-sm text-carob-700 group-hover:text-carob-900 transition-colors">
                                            <div class="min-w-[1.25rem] mt-0.5 mr-3">
                                                <i data-lucide="check-circle-2" class="w-5 h-5 {{ $colors['icon'] }} fill-current opacity-20"></i>
                                            </div>
                                            {{ $feature }}
                                        </div>
                                    @endforeach
                                    
                                    @if(count($package->features) > 3)
                                        <!-- Hidden features -->
                                        <div class="hidden-features space-y-4" style="display: none;">
                                            @foreach(array_slice($package->features, 3) as $feature)
                                                <div class="flex items-start text-sm text-carob-700 group-hover:text-carob-900 transition-colors">
                                                    <div class="min-w-[1.25rem] mt-0.5 mr-3">
                                                        <i data-lucide="check-circle-2" class="w-5 h-5 {{ $colors['icon'] }} fill-current opacity-20"></i>
                                                    </div>
                                                    {{ $feature }}
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <!-- Toggle button -->
                                        <button class="expand-toggle w-full text-center py-2 text-sm font-medium {{ $colors['icon'] }} hover:bg-gray-50 rounded-lg transition-colors mt-2"
                                            data-expanded="false"
                                            data-more-text="{{ __('pricing.view_all_benefits') }}"
                                            data-less-text="{{ __('pricing.show_less') }}">
                                            {{ __('pricing.view_all_benefits') }}
                                        </button>
                                    @endif
                                </div>
                            @endif

                            <a href="#booking"
                               class="w-full {{ $colors['button'] }} text-white py-4 rounded-xl transition-all duration-300 font-bold text-center block shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98]">
                                {{ __('pricing.join_family') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Fallback content -->
            <div class="text-center py-12">
                <div class="bg-white rounded-3xl p-10 shadow-xl border border-vanilla-200 max-w-lg mx-auto relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-chai-400 to-forest-moss-green-500"></div>
                    <i data-lucide="coffee" class="w-16 h-16 text-chai-300 mx-auto mb-6"></i>
                    <h3 class="text-2xl font-bold text-carob-900 mb-3">{{ __('pricing.empty.title') }}</h3>
                    <p class="text-carob-600">{{ __('pricing.empty.subtitle') }}</p>
                </div>
            </div>
        @endif

        <!-- Ecosystem Vision Section -->
        <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-xl border border-carob-100 relative overflow-hidden mb-24">
            <div class="absolute top-0 right-0 w-64 h-64 bg-vanilla-100 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-forest-moss-green-50 rounded-full blur-3xl opacity-50 translate-y-1/2 -translate-x-1/2"></div>
            
            <div class="relative z-10">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-carob-900 mb-4">{{ __('pricing.ecosystem.title') }}</h3>
                    <p class="text-carob-700 max-w-3xl mx-auto text-lg">
                        {{ __('pricing.ecosystem.subtitle') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Wellness -->
                    <div class="bg-gradient-to-br from-forest-moss-green-50 to-white p-8 rounded-3xl border border-forest-moss-green-100 hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-forest-moss-green-100 rounded-2xl flex items-center justify-center mb-6">
                            <i data-lucide="leaf" class="w-7 h-7 text-forest-moss-green-600"></i>
                        </div>
                        <h4 class="text-xl font-bold text-carob-900 mb-3">{{ __('pricing.ecosystem.wellness.title') }}</h4>
                        <p class="text-carob-600">{{ __('pricing.ecosystem.wellness.desc') }}</p>
                    </div>

                    <!-- Joy -->
                    <div class="bg-gradient-to-br from-chai-50 to-white p-8 rounded-3xl border border-chai-100 hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-chai-100 rounded-2xl flex items-center justify-center mb-6">
                            <i data-lucide="smile" class="w-7 h-7 text-chai-600"></i>
                        </div>
                        <h4 class="text-xl font-bold text-carob-900 mb-3">{{ __('pricing.ecosystem.joy.title') }}</h4>
                        <p class="text-carob-600">{{ __('pricing.ecosystem.joy.desc') }}</p>
                    </div>

                    <!-- Community -->
                    <div class="bg-gradient-to-br from-vanilla-50 to-white p-8 rounded-3xl border border-vanilla-200 hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-vanilla-100 rounded-2xl flex items-center justify-center mb-6">
                            <i data-lucide="users" class="w-7 h-7 text-vanilla-600"></i>
                        </div>
                        <h4 class="text-xl font-bold text-carob-900 mb-3">{{ __('pricing.ecosystem.community.title') }}</h4>
                        <p class="text-carob-600">{{ __('pricing.ecosystem.community.desc') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technology Section (Integrated) -->
        <div class="relative">
             <!-- Header -->
             <div class="text-center mb-16">
                <div class="inline-flex items-center bg-vanilla-100 text-chai-800 px-6 py-2 rounded-full text-sm font-medium mb-6">
                    <i data-lucide="sparkles" class="w-4 h-4 mr-2"></i>
                    {{ __('pricing.technology.badge') }}
                </div>
                <h3 class="text-3xl md:text-4xl font-bold text-carob-900 mb-6">{{ __('pricing.technology.title') }}</h3>
                <p class="text-carob-600 max-w-2xl mx-auto text-lg">
                    {{ __('pricing.technology.subtitle') }}
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <!-- Smart Scheduling -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-carob-100 hover:border-forest-moss-green-200 transition-colors group">
                    <div class="flex items-start gap-6">
                        <div class="bg-forest-moss-green-100 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="calendar-heart" class="w-8 h-8 text-forest-moss-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-carob-900 mb-2 group-hover:text-forest-moss-green-700 transition-colors">{{ __('pricing.technology.scheduling.title') }}</h3>
                            <p class="text-carob-600 mb-4">{{ __('pricing.technology.scheduling.desc') }}</p>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm text-carob-700">
                                    <i data-lucide="check" class="w-4 h-4 text-forest-moss-green-500 mr-2"></i>
                                    {{ __('pricing.technology.scheduling.point1') }}
                                </li>
                                <li class="flex items-center text-sm text-carob-700">
                                    <i data-lucide="check" class="w-4 h-4 text-forest-moss-green-500 mr-2"></i>
                                    {{ __('pricing.technology.scheduling.point2') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- AI Companion -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-carob-100 hover:border-chai-200 transition-colors group">
                    <div class="flex items-start gap-6">
                        <div class="bg-chai-100 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="bot" class="w-8 h-8 text-chai-600"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-carob-900 mb-2 group-hover:text-chai-700 transition-colors">{{ __('pricing.technology.ai.title') }}</h3>
                            <p class="text-carob-600 mb-4">{{ __('pricing.technology.ai.desc') }}</p>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm text-carob-700">
                                    <i data-lucide="check" class="w-4 h-4 text-chai-500 mr-2"></i>
                                    {{ __('pricing.technology.ai.point1') }}
                                </li>
                                <li class="flex items-center text-sm text-carob-700">
                                    <i data-lucide="check" class="w-4 h-4 text-chai-500 mr-2"></i>
                                    {{ __('pricing.technology.ai.point2') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Secure Transactions -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-carob-100 hover:border-vanilla-300 transition-colors group">
                    <div class="flex items-start gap-6">
                        <div class="bg-vanilla-100 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="shield-check" class="w-8 h-8 text-vanilla-600"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-carob-900 mb-2 group-hover:text-vanilla-700 transition-colors">{{ __('pricing.technology.payment.title') }}</h3>
                            <p class="text-carob-600 mb-4">{{ __('pricing.technology.payment.desc') }}</p>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm text-carob-700">
                                    <i data-lucide="check" class="w-4 h-4 text-vanilla-500 mr-2"></i>
                                    {{ __('pricing.technology.payment.point1') }}
                                </li>
                                <li class="flex items-center text-sm text-carob-700">
                                    <i data-lucide="check" class="w-4 h-4 text-vanilla-500 mr-2"></i>
                                    {{ __('pricing.technology.payment.point2') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Peace of Mind -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-carob-100 hover:border-forest-moss-green-200 transition-colors group">
                    <div class="flex items-start gap-6">
                        <div class="bg-forest-moss-green-50 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="bell-ring" class="w-8 h-8 text-forest-moss-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-carob-900 mb-2 group-hover:text-forest-moss-green-700 transition-colors">{{ __('pricing.technology.notification.title') }}</h3>
                            <p class="text-carob-600 mb-4">{{ __('pricing.technology.notification.desc') }}</p>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm text-carob-700">
                                    <i data-lucide="check" class="w-4 h-4 text-forest-moss-green-500 mr-2"></i>
                                    {{ __('pricing.technology.notification.point1') }}
                                </li>
                                <li class="flex items-center text-sm text-carob-700">
                                    <i data-lucide="check" class="w-4 h-4 text-forest-moss-green-500 mr-2"></i>
                                    {{ __('pricing.technology.notification.point2') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="relative mt-20">
            <div class="absolute inset-0 bg-gradient-to-r from-forest-moss-green-500 to-chai-600 rounded-[3rem] transform -rotate-1 opacity-20 blur-lg"></div>
            <div class="bg-gradient-to-r from-forest-moss-green-600 to-chai-700 rounded-[3rem] p-12 text-center relative overflow-hidden shadow-2xl">
                <!-- Decorative Circles -->
                <div class="absolute top-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-48 h-48 bg-white opacity-10 rounded-full translate-x-1/2 translate-y-1/2"></div>
                
                <div class="relative z-10">
                    <h3 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ __('pricing.cta.title') }}</h3>
                    <p class="text-white/90 mb-8 max-w-2xl mx-auto text-lg">
                        {{ __('pricing.cta.subtitle') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#booking"
                            class="bg-white text-carob-900 px-10 py-4 rounded-xl hover:bg-vanilla-50 transition-colors font-bold flex items-center justify-center shadow-lg hover:shadow-white/20">
                            <i data-lucide="calendar" class="w-5 h-5 mr-2"></i>
                            {{ __('pricing.cta.start_journey') }}
                        </a>
                        <button
                            class="bg-transparent border-2 border-white/30 text-white px-10 py-4 rounded-xl hover:bg-white/10 transition-colors font-bold flex items-center justify-center backdrop-blur-sm">
                            <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                            {{ __('pricing.cta.chat_with_us') }}
                        </button>
                    </div>
                </div>
            </div>
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
