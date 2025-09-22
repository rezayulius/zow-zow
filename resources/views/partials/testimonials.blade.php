{{-- Testimonials Section --}}
<section id="testimoni" class="relative py-20 overflow-hidden">
    
    {{-- Background with blur effect --}}
    <div class="absolute inset-0 bg-gradient-to-br from-matcha-50/30 via-chai-50/20 to-almond-50/30"></div>
    <div class="absolute inset-0 backdrop-blur-sm"></div>
    
    {{-- Decorative elements --}}
    <div class="absolute top-10 left-10 w-32 h-32 bg-matcha-200/20 rounded-full blur-xl"></div>
    <div class="absolute bottom-10 right-10 w-40 h-40 bg-chai-200/20 rounded-full blur-xl"></div>
    <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-almond-200/20 rounded-full blur-lg"></div>
    
    <div class="relative max-w-7xl mx-auto px-6 z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-matcha-800 mb-4">
                What Our Clients Say
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Don't just take our word for it. Here's what pet parents have to say about their 
                experience with PetWellness Hub.
            </p>
        </div>

        {{-- Statistics Section --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
            {{-- Happy Clients --}}
            <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                <div class="text-3xl md:text-4xl font-bold text-matcha-600 mb-2">500+</div>
                <div class="text-gray-600 font-medium">Happy Clients</div>
            </div>
            
            {{-- Pets Served --}}
            <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                <div class="text-3xl md:text-4xl font-bold text-matcha-600 mb-2">1,200+</div>
                <div class="text-gray-600 font-medium">Pets Served</div>
            </div>
            
            {{-- Average Rating --}}
            <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                <div class="text-3xl md:text-4xl font-bold text-matcha-600 mb-2">4.9/5</div>
                <div class="text-gray-600 font-medium">Average Rating</div>
            </div>
            
            {{-- Years Experience --}}
            <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                <div class="text-3xl md:text-4xl font-bold text-matcha-600 mb-2">5+</div>
                <div class="text-gray-600 font-medium">Years Experience</div>
            </div>
        </div>

        {{-- Testimonials Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Testimonial 1 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                {{-- Star Rating --}}
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>
                
                <p class="text-gray-700 mb-6 leading-relaxed">
                    "PetWellness Hub has been amazing for my cat Whiskers. The veterinary care is top-notch, and the staff truly cares about each pet. The grooming service made Whiskers look absolutely gorgeous!"
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-matcha-200 rounded-full flex items-center justify-center text-matcha-800 font-bold text-lg mr-4">
                        SJ
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Sarah Johnson</div>
                        <div class="text-sm text-gray-600">Cat Owner</div>
                        <div class="text-xs text-matcha-600">Whiskers (Persian Cat)</div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 2 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                {{-- Star Rating --}}
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>
                
                <p class="text-gray-700 mb-6 leading-relaxed">
                    "I love the comprehensive services here. From regular checkups to the pet hotel when I travel, everything is perfect. My dog Max always comes home happy and healthy."
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-chai-200 rounded-full flex items-center justify-center text-chai-800 font-bold text-lg mr-4">
                        MC
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Michael Chen</div>
                        <div class="text-sm text-gray-600">Dog Owner</div>
                        <div class="text-xs text-chai-600">Max (Golden Retriever)</div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 3 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                {{-- Star Rating --}}
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>
                
                <p class="text-gray-700 mb-6 leading-relaxed">
                    "The membership program is fantastic! The discounts really add up and the priority booking is so convenient. Both my dogs and cats receive excellent care here."
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-almond-200 rounded-full flex items-center justify-center text-almond-800 font-bold text-lg mr-4">
                        ER
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Emily Rodriguez</div>
                        <div class="text-sm text-gray-600">Multi-Pet Owner</div>
                        <div class="text-xs text-almond-600">Bella & Luna (Mixed Breeds)</div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 4 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                {{-- Star Rating --}}
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>
                
                <p class="text-gray-700 mb-6 leading-relaxed">
                    "Finding a vet that understands rabbits can be challenging, but the team here is incredibly knowledgeable. The open space area is perfect for exercise time too!"
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-vanilla-200 rounded-full flex items-center justify-center text-vanilla-800 font-bold text-lg mr-4">
                        DL
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">David Lee</div>
                        <div class="text-sm text-gray-600">Rabbit Owner</div>
                        <div class="text-xs text-vanilla-600">Cocoa (Holland Lop)</div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 5 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                {{-- Star Rating --}}
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>
                
                <p class="text-gray-700 mb-6 leading-relaxed">
                    "The cafe is such a unique touch! I can relax with a coffee while my parrot socializes in a safe environment. The staff is well-trained with all types of pets."
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-matcha-200 rounded-full flex items-center justify-center text-matcha-800 font-bold text-lg mr-4">
                        AL
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Anna Liu</div>
                        <div class="text-sm text-gray-600">Bird Owner</div>
                        <div class="text-xs text-matcha-600">Kiwi (African Grey)</div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 6 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                {{-- Star Rating --}}
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>
                
                <p class="text-gray-700 mb-6 leading-relaxed">
                    "Emergency services here saved my dog's life. The 24/7 support and quick response time were incredible. I can't thank the team enough for their dedication."
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-chai-200 rounded-full flex items-center justify-center text-chai-800 font-bold text-lg mr-4">
                        RT
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Robert Taylor</div>
                        <div class="text-sm text-gray-600">Dog Owner</div>
                        <div class="text-xs text-chai-600">Rocky (German Shepherd)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>