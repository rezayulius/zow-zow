<!-- Footer (Fresh & Joyful Redesign) -->
<footer class="bg-deep-cocoa-brown-900 text-white pt-24 pb-12 relative z-10 -mt-2 overflow-hidden">
    <!-- Animated Background Blobs -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-forest-moss-green-900/40 rounded-full mix-blend-overlay filter blur-3xl opacity-40 animate-blob"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-chai-900/40 rounded-full mix-blend-overlay filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Decorative Top Curve (Simple Inward) -->
    <div class="absolute top-0 left-0 right-0 h-8 sm:h-12 md:h-16 bg-white rounded-b-[100%] z-10"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-12 gap-12 mb-16">
            
            <!-- Brand Column -->
            <div class="lg:col-span-4 space-y-6">
                <div class="mb-4">
                    <img src="{{ asset('images/logo/zow-vet-logo-white-footer.webp') }}" alt="Zow Vetique" width="251" height="112" loading="lazy" class="h-14 w-auto object-contain">
                </div>
                <p class="text-soft-linen-300 leading-relaxed font-medium">
                    {{ __('footer.tagline') }}
                </p>
                <p class="text-soft-linen-400 text-sm leading-relaxed">
                    {{ __('footer.description') }}
                </p>
                
                <!-- Social Media Pills -->
                <div class="flex flex-wrap gap-3">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/zowvetclinic?igsh=aXUzZXZnc3JrYTFs"
                        target="_blank" rel="noopener noreferrer"
                        class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <img
                            src="https://cdn.simpleicons.org/instagram/E4405F"
                            alt="Instagram"
                            width="16" height="16" loading="lazy"
                            class="w-4 h-4 group-hover:scale-110 transition-transform">
                        <span class="text-xs font-bold text-soft-linen-200">Instagram</span>
                    </a>

                    <!-- Facebook -->
                    <a href="#"
                        class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <img
                            src="https://cdn.simpleicons.org/facebook/1877F2"
                            alt="Facebook"
                            width="16" height="16" loading="lazy"
                            class="w-4 h-4 group-hover:scale-110 transition-transform">
                        <span class="text-xs font-bold text-soft-linen-200">Facebook</span>
                    </a>

                    <!-- YouTube -->
                    <a href="#"
                        class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <img
                            src="https://cdn.simpleicons.org/youtube/FF0000"
                            alt="YouTube"
                            width="16" height="16" loading="lazy"
                            class="w-4 h-4 group-hover:scale-110 transition-transform">
                        <span class="text-xs font-bold text-soft-linen-200">YouTube</span>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="lg:col-span-2">
                <h4 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-forest-moss-green-400"></span>
                    {{ __('footer.menu') }}
                </h4>
                <ul class="space-y-3">
                    @foreach([
                        ['label' => __('footer.links.home'), 'url' => '#beranda'],
                        ['label' => __('footer.links.services'), 'url' => '#health'],
                        ['label' => __('footer.links.booking'), 'url' => '#booking'],
                        ['label' => __('footer.links.articles'), 'url' => '#testimoni'],
                        ['label' => __('footer.links.contact'), 'url' => '#lokasi']
                    ] as $link)
                        <li>
                            <a href="{{ $link['url'] }}" class="text-soft-linen-400 hover:text-forest-moss-green-300 transition-colors flex items-center gap-2 group text-sm">
                                <i data-lucide="chevron-right" class="w-3 h-3 opacity-0 group-hover:opacity-100 -ml-4 group-hover:ml-0 transition-all duration-300"></i>
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Services -->
            <div class="lg:col-span-3">
                <h4 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-chai-400"></span>
                    {{ __('footer.services_heading') }}
                </h4>
                <ul class="space-y-3">
                    @foreach(__('footer.services') as $service)
                        <li class="flex items-start gap-2 text-soft-linen-400 text-sm">
                            <i data-lucide="paw-print" class="w-3 h-3 mt-1 text-chai-500"></i>
                            {{ $service }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="lg:col-span-3">
                <h4 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-soft-blush-pink-400"></span>
                    {{ __('footer.contact_us') }}
                </h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-soft-linen-400 text-sm">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center shrink-0">
                            <i data-lucide="map-pin" class="w-4 h-4 text-soft-blush-pink-400"></i>
                        </div>
                        <span class="mt-1">Jl. Prapanca Raya No.25A, RT.2/RW.3, Pulo, Kec. Kby. Baru, Kota Jakarta Selatan, DKI Jakarta 12160</span>
                    </li>
                    <li class="flex items-start gap-3 text-soft-linen-400 text-sm">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center shrink-0">
                            <i data-lucide="phone" class="w-4 h-4 text-soft-blush-pink-400"></i>
                        </div>
                        <span class="mt-1">+62 812 1908 8899</span>
                    </li>
                    <li class="flex items-start gap-3 text-soft-linen-400 text-sm">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center shrink-0">
                            <i data-lucide="mail" class="w-4 h-4 text-soft-blush-pink-400"></i>
                        </div>
                        @php
                            $supportEmail = 'support@zowvetique.com';
                            $supportEmailEntities = collect(str_split($supportEmail))->map(fn($c) => '&#' . ord($c) . ';')->implode('');
                        @endphp
                        <a href="{!! 'mailto:' . $supportEmailEntities !!}" class="mt-1 hover:text-white transition-colors">{!! $supportEmailEntities !!}</a>
                    </li>
                    <li class="flex items-start gap-3 text-soft-linen-400 text-sm">
                        <div class="w-8 h-8 rounded-full bg-red-500/20 flex items-center justify-center shrink-0 animate-pulse">
                            <i data-lucide="phone-call" class="w-4 h-4 text-red-400"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-red-400 uppercase tracking-wide">{{ __('footer.emergency_24_7') }}</span>
                            <span class="font-bold text-white">+62 812 9591 1911</span>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-soft-linen-500">
            <p>{!! __('footer.copyright', ['year' => date('Y')]) !!}</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">{{ __('footer.privacy_policy') }}</a>
                <a href="#" class="hover:text-white transition-colors">{{ __('footer.terms_of_service') }}</a>
                <a href="#" class="hover:text-white transition-colors">{{ __('footer.sitemap') }}</a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
