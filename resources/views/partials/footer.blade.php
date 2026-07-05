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
                    <img src="{{ asset('images/logo/zow-vet-logo-white.png') }}" alt="Zow Vetique" class="h-14 w-auto object-contain">
                </div>
                <p class="text-soft-linen-300 leading-relaxed font-medium">
                    ZOW Vet — Stem Cell Therapy & Advanced Lab.
                </p>
                <p class="text-soft-linen-400 text-sm leading-relaxed">
                    Perawatan modern untuk pets, dengan pendekatan medis yang presisi, penuh empati, dan didukung komunikasi yang hangat untuk setiap pawrent.
                </p>
                
                <!-- Social Media Pills -->
                <div class="flex flex-wrap gap-3">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/zowvetclinic?igsh=aXUzZXZnc3JrYTFs"
                        target="_blank"
                        class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <img
                            src="https://cdn.simpleicons.org/instagram/E4405F"
                            alt="Instagram"
                            class="w-4 h-4 group-hover:scale-110 transition-transform">
                        <span class="text-xs font-bold text-soft-linen-200">Instagram</span>
                    </a>

                    <!-- Facebook -->
                    <a href="#"
                        class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <img
                            src="https://cdn.simpleicons.org/facebook/1877F2"
                            alt="Facebook"
                            class="w-4 h-4 group-hover:scale-110 transition-transform">
                        <span class="text-xs font-bold text-soft-linen-200">Facebook</span>
                    </a>

                    <!-- YouTube -->
                    <a href="#"
                        class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <img
                            src="https://cdn.simpleicons.org/youtube/FF0000"
                            alt="YouTube"
                            class="w-4 h-4 group-hover:scale-110 transition-transform">
                        <span class="text-xs font-bold text-soft-linen-200">YouTube</span>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="lg:col-span-2">
                <h4 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-forest-moss-green-400"></span>
                    Menu
                </h4>
                <ul class="space-y-3">
                    @foreach([
                        ['label' => 'Beranda', 'url' => '#beranda'],
                        ['label' => 'Layanan', 'url' => '#health'],
                        ['label' => 'Booking', 'url' => '#booking'],
                        ['label' => 'Artikel', 'url' => '#testimoni'],
                        ['label' => 'Kontak', 'url' => '#lokasi']
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
                    Layanan
                </h4>
                <ul class="space-y-3">
                    @foreach([
                        'Pemeriksaan Umum', 'Vaksinasi & Steril', 'Grooming Spa', 'Pet Hotel', 'UGD 24 Jam'
                    ] as $service)
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
                    Hubungi Kami
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
                        <span class="mt-1">support@zowvetique.com</span>
                    </li>
                    <li class="flex items-start gap-3 text-soft-linen-400 text-sm">
                        <div class="w-8 h-8 rounded-full bg-red-500/20 flex items-center justify-center shrink-0 animate-pulse">
                            <i data-lucide="phone-call" class="w-4 h-4 text-red-400"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-red-400 uppercase tracking-wide">Emergency 24/7</span>
                            <span class="font-bold text-white">+62 812 9591 1911</span>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-soft-linen-500">
            <p>&copy; 2025 Zow Vetique. Dibuat dengan ❤️ untuk pecinta hewan.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Sitemap</a>
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
