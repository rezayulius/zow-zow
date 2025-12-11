<!-- Footer (Fresh & Joyful Redesign) -->
<footer class="bg-deep-cocoa-brown-900 text-white pt-24 pb-12 relative overflow-hidden">
    <!-- Animated Background Blobs -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-forest-moss-green-900/40 rounded-full mix-blend-overlay filter blur-3xl opacity-40 animate-blob"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-chai-900/40 rounded-full mix-blend-overlay filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Decorative Top Curve -->
    <div class="absolute top-0 left-0 right-0 h-16 bg-white rounded-b-[50%] transform -translate-y-8 scale-x-110"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-12 gap-12 mb-16">
            
            <!-- Brand Column -->
            <div class="lg:col-span-4 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-gradient-to-br from-forest-moss-green-400 to-forest-moss-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-forest-moss-green-900/50">
                        <i data-lucide="heart" class="text-white w-6 h-6 fill-current"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold font-heading leading-none">Zow Vetique</h2>
                        <span class="text-xs font-medium text-forest-moss-green-400 uppercase tracking-widest">Pet Wellness Hub</span>
                    </div>
                </div>
                <p class="text-soft-linen-300 leading-relaxed">
                    Lebih dari sekadar klinik, kami adalah rumah kedua bagi sahabat berbulu Anda. Layanan penuh cinta dengan standar medis terbaik.
                </p>
                
                <!-- Social Media Pills -->
                <div class="flex flex-wrap gap-3">
                    <a href="#" class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <i data-lucide="instagram" class="w-4 h-4 text-pink-400 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-bold text-soft-linen-200">Instagram</span>
                    </a>
                    <a href="#" class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <i data-lucide="facebook" class="w-4 h-4 text-blue-400 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-bold text-soft-linen-200">Facebook</span>
                    </a>
                    <a href="#" class="group flex items-center gap-2 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-full transition-all duration-300 border border-white/10 hover:border-white/20">
                        <i data-lucide="youtube" class="w-4 h-4 text-red-400 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-bold text-soft-linen-200">Youtube</span>
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
                        <span class="mt-1">Jl. Raya Kemang No. 88, Jakarta Selatan</span>
                    </li>
                    <li class="flex items-start gap-3 text-soft-linen-400 text-sm">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center shrink-0">
                            <i data-lucide="phone" class="w-4 h-4 text-soft-blush-pink-400"></i>
                        </div>
                        <span class="mt-1">0812-9591-1911</span>
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
                            <span class="font-bold text-white">+62 812 9999 0000</span>
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
