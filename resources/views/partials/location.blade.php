{{-- Location Section --}}
<section id="lokasi" class="relative z-20 py-24 overflow-hidden bg-gradient-to-b from-soft-linen-100 via-vanilla-100/50 to-white">
    <!-- Animated Background Blobs -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-20 right-0 w-96 h-96 bg-forest-moss-green-100/30 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-chai-100/30 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-soft-blush-pink-100/30 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob animation-delay-4000"></div>
        
        <!-- Floating Icon -->
        <div class="absolute top-10 left-10 opacity-20 animate-float-slow">
            <x-animal-icon name="cow" class="w-40 h-40 text-forest-moss-green-300" />
        </div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-forest-moss-green-50 text-forest-moss-green-700 text-xs font-bold uppercase tracking-wider mb-6 border border-forest-moss-green-100 shadow-sm">
                <div class="flex items-center">
                    <x-animal-icon name="bird" class="w-4 h-4 text-forest-moss-green-600" />
                </div>
                Location
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading leading-tight">
                Visit Your <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-forest-moss-green-600 to-chai-600">Second Home</span>
            </h2>
            <p class="text-lg text-carob-600 leading-relaxed">
                A safe, comfortable, and warm environment in the heart of Kemang. Drop by for a check-up, a grooming session, or just to say hi!
            </p>
            
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="https://maps.app.goo.gl/va69apSq9NWWaDG16?g_st=iw" target="_blank" class="group inline-flex items-center bg-white text-carob-800 px-6 py-3 rounded-full border border-gray-200 shadow-sm hover:shadow-md hover:border-forest-moss-green-300 transition-all duration-300">
                    <div class="w-8 h-8 bg-forest-moss-green-50 rounded-full flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                        <i data-lucide="map-pin" class="w-4 h-4 text-forest-moss-green-600"></i>
                    </div>
                    <span class="font-bold text-sm">Open in Maps</span>
                </a>
                <a href="https://wa.me/6281299990000" class="group inline-flex items-center bg-forest-moss-green-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-forest-moss-green-600 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i>
                    <span class="font-bold text-sm">Chat on WhatsApp</span>
                </a>
            </div>
        </div>

        {{-- Main Grid --}}
        <div class="grid lg:grid-cols-12 gap-8 mb-16 items-start">
            
            {{-- Left Column: Map & Facilities --}}
            <div class="lg:col-span-8 space-y-8">
                <!-- Map Card -->
                <div class="bg-white rounded-[2.5rem] p-4 shadow-xl border border-gray-100 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-forest-moss-green-50 to-transparent opacity-50 pointer-events-none"></div>
                    <div class="relative rounded-[2rem] overflow-hidden aspect-video shadow-inner border border-gray-100">
                        <!-- Interactive Map Placeholder / Iframe -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.059432696683!2d106.8157773147693!3d-6.255903995471649!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f17d72740263%3A0xc3c544837851613b!2sKemang%20Village!5e0!3m2!1sen!2sid!4v1625642845678!5m2!1sen!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            class="grayscale hover:grayscale-0 transition-all duration-700 ease-in-out"
                        ></iframe>
                        
                        <!-- Floating Location Card -->
                        <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-gray-100 max-w-xs hidden sm:block animate-bounce-in">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-forest-moss-green-100 rounded-full flex items-center justify-center shrink-0">
                                    <span class="text-xl">🏥</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-carob-900 text-sm">Zow Vetique</h4>
                                    <p class="text-xs text-carob-500">Jl. Prapanca Raya No.25A</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facilities Grid -->
                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach([
                        ['icon' => 'parking-circle', 'label' => 'Free Parking', 'color' => 'bg-chai-50 text-chai-600'],
                        ['icon' => 'wifi', 'label' => 'Free WiFi', 'color' => 'bg-forest-moss-green-50 text-forest-moss-green-600'],
                        ['icon' => 'coffee', 'label' => 'Pet Cafe', 'color' => 'bg-old-mustard-yellow-50 text-old-mustard-yellow-600'],
                        ['icon' => 'snowflake', 'label' => 'Full AC', 'color' => 'bg-soft-blush-pink-50 text-soft-blush-pink-600'],
                    ] as $facility)
                        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm flex items-center gap-3 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                            <div class="w-10 h-10 rounded-full {{ $facility['color'] }} flex items-center justify-center">
                                <i data-lucide="{{ $facility['icon'] }}" class="w-5 h-5"></i>
                            </div>
                            <span class="font-bold text-sm text-carob-700">{{ $facility['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column: Info & Hours --}}
            <div class="lg:col-span-4 space-y-6">
                <!-- Info Card -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-gray-100 relative overflow-hidden group hover:border-forest-moss-green-200 transition-colors duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-forest-moss-green-50 to-transparent rounded-bl-[100px] opacity-60"></div>
                    
                    <h3 class="text-2xl font-bold text-carob-900 mb-8 font-heading flex items-center gap-2">
                        <i data-lucide="info" class="w-6 h-6 text-forest-moss-green-500"></i>
                        Clinic Info
                    </h3>

                    <div class="space-y-8 relative z-10">
                        <!-- Address -->
                        <div class="flex gap-4 group/item">
                            <div class="w-12 h-12 bg-soft-linen-50 rounded-2xl flex items-center justify-center text-carob-400 group-hover/item:bg-forest-moss-green-50 group-hover/item:text-forest-moss-green-600 transition-colors duration-300 shrink-0">
                                <i data-lucide="map-pin" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-carob-900 mb-1">Visit Us</h4>
                                <p class="text-sm text-carob-600 leading-relaxed">Jl. Prapanca Raya No.25A, Pulo, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12160</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex gap-4 group/item">
                            <div class="w-12 h-12 bg-soft-linen-50 rounded-2xl flex items-center justify-center text-carob-400 group-hover/item:bg-chai-50 group-hover/item:text-chai-600 transition-colors duration-300 shrink-0">
                                <i data-lucide="phone" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-carob-900 mb-1">Call Us</h4>
                                <p class="text-sm text-carob-600 mb-2">0812-9591-1911</p>
                                <a href="tel:+6281295911911" class="inline-flex items-center gap-1 text-xs font-bold text-white bg-forest-moss-green-500 hover:bg-forest-moss-green-600 px-3 py-1.5 rounded-full shadow-sm transition-all duration-300 group/link">
                                    <i data-lucide="phone" class="w-3 h-3"></i>
                                    Call Now
                                </a>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="flex gap-4 group/item">
                            <div class="w-12 h-12 bg-soft-linen-50 rounded-2xl flex items-center justify-center text-carob-400 group-hover/item:bg-old-mustard-yellow-50 group-hover/item:text-old-mustard-yellow-600 transition-colors duration-300 shrink-0">
                                <i data-lucide="clock" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-carob-900 mb-1">Opening Hours</h4>
                                <div class="space-y-1">
                                    <div class="flex justify-between text-sm w-full gap-8">
                                        <span class="text-carob-500">Every Day</span>
                                        <span class="font-bold text-carob-800">09:00 - 21:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Card (Small) -->
                <div class="bg-gradient-to-br from-red-50 to-white rounded-[2rem] p-6 border border-red-100 shadow-sm flex items-center justify-between gap-4">
                    <div>
                        <h4 class="font-bold text-red-900 text-sm uppercase tracking-wide mb-1">Emergency 24/7</h4>
                        <p class="text-xs text-red-700/80">Urgent care when you need it.</p>
                    </div>
                    <button id="btnEmergencyLocation" class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-red-200 hover:scale-110 hover:bg-red-600 transition-all duration-300 animate-pulse">
                        <i data-lucide="phone-call" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Animal Parade (Bottom Decoration) -->
    <div class="absolute bottom-0 left-0 right-0 h-16 z-20 flex justify-center items-end pb-4 gap-4 sm:gap-8 md:gap-12 overflow-hidden pointer-events-none">
        <x-animal-icon name="dog" class="w-8 h-8 sm:w-10 sm:h-10 text-forest-moss-green-200 opacity-60 -rotate-6 animate-bounce-slow" />
        <x-animal-icon name="cat" class="w-8 h-8 sm:w-10 sm:h-10 text-chai-200 opacity-60 rotate-6 animate-pulse-slow" />
        <x-animal-icon name="rabbit" class="w-8 h-8 sm:w-10 sm:h-10 text-soft-blush-pink-200 opacity-60 -rotate-3 animate-bounce-slow" />
        <x-animal-icon name="bird" class="w-8 h-8 sm:w-10 sm:h-10 text-forest-moss-green-200 opacity-60 rotate-12 animate-pulse-slow" />
        <x-animal-icon name="hamster" class="w-8 h-8 sm:w-10 sm:h-10 text-chai-200 opacity-60 -rotate-6 animate-bounce-slow" />
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Re-initialize icons just in case
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        // Bind Emergency Button in Location Section
        const btnEmergency = document.getElementById('btnEmergencyLocation');
        if(btnEmergency) {
            btnEmergency.addEventListener('click', function() {
                const mainBtn = document.getElementById('btnEmergencyCall');
                if(mainBtn) mainBtn.click();
            });
        }
    });
</script>