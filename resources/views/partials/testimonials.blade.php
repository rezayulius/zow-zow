{{-- Testimonials, Articles, News & Promo Section --}}
<section id="testimoni" class="relative py-20 overflow-hidden">
    
    {{-- Background with blur effect --}}
    <div class="absolute inset-0 bg-gradient-to-br from-matcha-50/30 via-chai-50/20 to-almond-50/30"></div>
    <div class="absolute inset-0 backdrop-blur-sm"></div>
    
    {{-- Decorative elements --}}
    <div class="absolute top-10 left-10 w-32 h-32 bg-matcha-200/20 rounded-full blur-xl"></div>
    <div class="absolute bottom-10 right-10 w-40 h-40 bg-chai-200/20 rounded-full blur-xl"></div>
    <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-almond-200/20 rounded-full blur-lg"></div>
    
    <div class="relative max-w-7xl mx-auto px-6 z-10">
        
        {{-- Navigation Tabs --}}
        <div class="flex justify-center mb-12">
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-2 shadow-lg border border-white/20">
                <button class="tab-btn active px-6 py-3 rounded-xl font-semibold transition-all duration-300" data-tab="testimonials">
                    Testimonials
                </button>
                <button class="tab-btn px-6 py-3 rounded-xl font-semibold transition-all duration-300" data-tab="articles">
                    Articles
                </button>
                <button class="tab-btn px-6 py-3 rounded-xl font-semibold transition-all duration-300" data-tab="news">
                    News
                </button>
                <button class="tab-btn px-6 py-3 rounded-xl font-semibold transition-all duration-300" data-tab="promo">
                    Promo
                </button>
            </div>
        </div>

        {{-- Testimonials Tab Content --}}
        <div id="testimonials-content" class="tab-content active">
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

            {{-- Testimonials Carousel --}}
            <div class="relative">
                <div class="testimonial-carousel overflow-hidden rounded-2xl">
                    <div class="testimonial-track flex transition-transform duration-500 ease-in-out">
                        {{-- Testimonial Slide 1 --}}
                        <div class="testimonial-slide w-full flex-shrink-0">
                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                {{-- Testimonial 1 --}}
                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                                    <div class="flex mb-4">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 mb-6 leading-relaxed">
                                        "PetWellness Hub has been amazing for my cat Whiskers. The veterinary care is top-notch, and the staff truly cares about each pet."
                                    </p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-matcha-200 rounded-full flex items-center justify-center text-matcha-800 font-bold text-lg mr-4">SJ</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Sarah Johnson</div>
                                            <div class="text-sm text-gray-600">Cat Owner</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Testimonial 2 --}}
                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                                    <div class="flex mb-4">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 mb-6 leading-relaxed">
                                        "I love the comprehensive services here. From regular checkups to the pet hotel when I travel, everything is perfect."
                                    </p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-chai-200 rounded-full flex items-center justify-center text-chai-800 font-bold text-lg mr-4">MC</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Michael Chen</div>
                                            <div class="text-sm text-gray-600">Dog Owner</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Testimonial 3 --}}
                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                                    <div class="flex mb-4">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 mb-6 leading-relaxed">
                                        "The membership program is fantastic! The discounts really add up and the priority booking is so convenient."
                                    </p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-almond-200 rounded-full flex items-center justify-center text-almond-800 font-bold text-lg mr-4">ER</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Emily Rodriguez</div>
                                            <div class="text-sm text-gray-600">Multi-Pet Owner</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial Slide 2 --}}
                        <div class="testimonial-slide w-full flex-shrink-0">
                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                {{-- Testimonial 4 --}}
                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                                    <div class="flex mb-4">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 mb-6 leading-relaxed">
                                        "Finding a vet that understands rabbits can be challenging, but the team here is incredibly knowledgeable."
                                    </p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-vanilla-200 rounded-full flex items-center justify-center text-vanilla-800 font-bold text-lg mr-4">DL</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">David Lee</div>
                                            <div class="text-sm text-gray-600">Rabbit Owner</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Testimonial 5 --}}
                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                                    <div class="flex mb-4">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 mb-6 leading-relaxed">
                                        "The cafe is such a unique touch! I can relax with a coffee while my parrot socializes in a safe environment."
                                    </p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-matcha-200 rounded-full flex items-center justify-center text-matcha-800 font-bold text-lg mr-4">AL</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Anna Liu</div>
                                            <div class="text-sm text-gray-600">Bird Owner</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Testimonial 6 --}}
                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                                    <div class="flex mb-4">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 mb-6 leading-relaxed">
                                        "Emergency services here saved my dog's life. The 24/7 support and quick response time were incredible."
                                    </p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-chai-200 rounded-full flex items-center justify-center text-chai-800 font-bold text-lg mr-4">RT</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Robert Taylor</div>
                                            <div class="text-sm text-gray-600">Dog Owner</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Carousel Navigation --}}
                <div class="flex justify-center mt-8 space-x-4">
                    <button class="testimonial-prev bg-white/60 backdrop-blur-sm hover:bg-white/80 rounded-full p-3 shadow-lg border border-white/20 transition-all duration-300">
                        <svg class="w-6 h-6 text-matcha-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <div class="flex space-x-2 items-center">
                        <div class="testimonial-indicator w-3 h-3 rounded-full bg-matcha-600 transition-all duration-300"></div>
                        <div class="testimonial-indicator w-3 h-3 rounded-full bg-matcha-300 transition-all duration-300"></div>
                    </div>
                    <button class="testimonial-next bg-white/60 backdrop-blur-sm hover:bg-white/80 rounded-full p-3 shadow-lg border border-white/20 transition-all duration-300">
                        <svg class="w-6 h-6 text-matcha-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Articles Tab Content --}}
        <div id="articles-content" class="tab-content hidden">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-matcha-800 mb-4">
                    Pet Care Articles
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Expert advice and insights to help you provide the best care for your beloved pets.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Article 1 --}}
                <article class="bg-white/70 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300 group">
                    <div class="h-48 bg-gradient-to-br from-matcha-200 to-matcha-300 relative overflow-hidden">
                        <div class="absolute inset-0 bg-matcha-600/20 group-hover:bg-matcha-600/30 transition-all duration-300"></div>
                        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium text-matcha-700">
                            Pet Health
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-matcha-700 transition-colors">
                            10 Essential Tips for Pet Nutrition
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Learn about the fundamental principles of pet nutrition and how to choose the right diet for your furry friend.
                        </p>
                        <div class="flex items-center justify-between">
                             <span class="text-sm text-gray-500">Dec 15, 2024</span>
                             <button onclick="openModal('article-1')" class="text-matcha-600 hover:text-matcha-700 font-medium text-sm transition-colors">Read More →</button>
                         </div>
                    </div>
                </article>

                {{-- Article 2 --}}
                <article class="bg-white/70 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300 group">
                    <div class="h-48 bg-gradient-to-br from-chai-200 to-chai-300 relative overflow-hidden">
                        <div class="absolute inset-0 bg-chai-600/20 group-hover:bg-chai-600/30 transition-all duration-300"></div>
                        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium text-chai-700">
                            Grooming
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-chai-700 transition-colors">
                            Seasonal Grooming Guide
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Discover how to adapt your pet's grooming routine throughout the year for optimal health and comfort.
                        </p>
                        <div class="flex items-center justify-between">
                             <span class="text-sm text-gray-500">Dec 12, 2024</span>
                             <button onclick="openModal('article-2')" class="text-chai-600 hover:text-chai-700 font-medium text-sm transition-colors">Read More →</button>
                         </div>
                    </div>
                </article>

                {{-- Article 3 --}}
                <article class="bg-white/70 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300 group">
                    <div class="h-48 bg-gradient-to-br from-almond-200 to-almond-300 relative overflow-hidden">
                        <div class="absolute inset-0 bg-almond-600/20 group-hover:bg-almond-600/30 transition-all duration-300"></div>
                        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium text-almond-700">
                            Training
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-almond-700 transition-colors">
                            Positive Reinforcement Training
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Master the art of positive reinforcement to build a stronger bond with your pet while teaching essential skills.
                        </p>
                        <div class="flex items-center justify-between">
                             <span class="text-sm text-gray-500">Dec 10, 2024</span>
                             <button onclick="openModal('article-3')" class="text-almond-600 hover:text-almond-700 font-medium text-sm transition-colors">Read More →</button>
                         </div>
                    </div>
                </article>
            </div>
        </div>

        {{-- News Tab Content --}}
        <div id="news-content" class="tab-content hidden">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-matcha-800 mb-4">
                    Latest News
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Stay updated with the latest developments in pet care and our clinic updates.
                </p>
            </div>

            <div class="space-y-8">
                {{-- News Item 1 --}}
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/3">
                            <div class="h-48 bg-gradient-to-br from-matcha-200 to-matcha-400 rounded-xl relative overflow-hidden">
                                <div class="absolute inset-0 bg-matcha-600/20"></div>
                                <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    Breaking
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <div class="flex items-center gap-4 mb-3">
                                <span class="bg-matcha-100 text-matcha-700 px-3 py-1 rounded-full text-sm font-medium">Clinic Update</span>
                                <span class="text-sm text-gray-500">Dec 18, 2024</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                New Advanced Surgery Suite Now Open
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                We're excited to announce the opening of our state-of-the-art surgery suite, equipped with the latest technology to provide even better care for your pets. The new facility includes advanced monitoring systems and minimally invasive surgical equipment.
                            </p>
                            <button onclick="openModal('news-1')" class="text-matcha-600 hover:text-matcha-700 font-medium transition-colors">Read Full Story →</button>
                        </div>
                    </div>
                </div>

                {{-- News Item 2 --}}
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/3">
                            <div class="h-48 bg-gradient-to-br from-chai-200 to-chai-400 rounded-xl relative overflow-hidden">
                                <div class="absolute inset-0 bg-chai-600/20"></div>
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <div class="flex items-center gap-4 mb-3">
                                <span class="bg-chai-100 text-chai-700 px-3 py-1 rounded-full text-sm font-medium">Community</span>
                                <span class="text-sm text-gray-500">Dec 15, 2024</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                Free Pet Health Checkup Campaign
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                Join our community health initiative! We're offering free basic health checkups for pets in need throughout December. This program aims to ensure every pet in our community has access to essential healthcare.
                            </p>
                            <button onclick="openModal('news-2')" class="text-chai-600 hover:text-chai-700 font-medium text-sm transition-colors">Learn More →</button>
                        </div>
                    </div>
                </div>

                {{-- News Item 3 --}}
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/3">
                            <div class="h-48 bg-gradient-to-br from-almond-200 to-almond-400 rounded-xl relative overflow-hidden">
                                <div class="absolute inset-0 bg-almond-600/20"></div>
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <div class="flex items-center gap-4 mb-3">
                                <span class="bg-almond-100 text-almond-700 px-3 py-1 rounded-full text-sm font-medium">Achievement</span>
                                <span class="text-sm text-gray-500">Dec 12, 2024</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                PetWellness Hub Receives Excellence Award
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                We're honored to receive the "Excellence in Pet Care" award from the Regional Veterinary Association. This recognition reflects our commitment to providing exceptional care and service to our community.
                            </p>
                            <button onclick="openModal('news-3')" class="text-almond-600 hover:text-almond-700 font-medium text-sm transition-colors">Read More →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Promo Tab Content --}}
        <div id="promo-content" class="tab-content hidden">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-matcha-800 mb-4">
                    Special Offers
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Take advantage of our exclusive promotions and save on premium pet care services.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Promo 1 --}}
                <div class="bg-gradient-to-br from-matcha-100 to-matcha-200 rounded-2xl p-6 shadow-lg border border-matcha-300/30 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                        30% OFF
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-matcha-800 mb-3">
                            New Client Package
                        </h3>
                        <p class="text-matcha-700 leading-relaxed">
                            Complete health checkup, vaccination, and grooming session for new clients. Perfect way to start your pet's wellness journey with us.
                        </p>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-matcha-700">
                            <svg class="w-5 h-5 mr-3 text-matcha-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Full Health Examination
                        </div>
                        <div class="flex items-center text-matcha-700">
                            <svg class="w-5 h-5 mr-3 text-matcha-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Core Vaccinations
                        </div>
                        <div class="flex items-center text-matcha-700">
                            <svg class="w-5 h-5 mr-3 text-matcha-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Premium Grooming
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-matcha-800 mb-2">$99 <span class="text-lg line-through text-matcha-600">$140</span></div>
                        <button class="w-full bg-matcha-600 hover:bg-matcha-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                            Claim Offer
                        </button>
                    </div>
                </div>

                {{-- Promo 2 --}}
                <div class="bg-gradient-to-br from-chai-100 to-chai-200 rounded-2xl p-6 shadow-lg border border-chai-300/30 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                        25% OFF
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-chai-800 mb-3">
                            Holiday Grooming Special
                        </h3>
                        <p class="text-chai-700 leading-relaxed">
                            Get your pet ready for the holidays with our premium grooming package. Includes nail trimming, ear cleaning, and festive accessories.
                        </p>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-chai-700">
                            <svg class="w-5 h-5 mr-3 text-chai-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Full Grooming Service
                        </div>
                        <div class="flex items-center text-chai-700">
                            <svg class="w-5 h-5 mr-3 text-chai-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Nail & Ear Care
                        </div>
                        <div class="flex items-center text-chai-700">
                            <svg class="w-5 h-5 mr-3 text-chai-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Holiday Accessories
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-chai-800 mb-2">$60 <span class="text-lg line-through text-chai-600">$80</span></div>
                        <button class="w-full bg-chai-600 hover:bg-chai-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                            Book Now
                        </button>
                    </div>
                </div>

                {{-- Promo 3 --}}
                <div class="bg-gradient-to-br from-almond-100 to-almond-200 rounded-2xl p-6 shadow-lg border border-almond-300/30 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                        FREE
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-almond-800 mb-3">
                            Membership Upgrade
                        </h3>
                        <p class="text-almond-700 leading-relaxed">
                            Upgrade to Premium Membership and get your first month free. Enjoy priority booking, exclusive discounts, and 24/7 support.
                        </p>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-almond-700">
                            <svg class="w-5 h-5 mr-3 text-almond-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Priority Booking
                        </div>
                        <div class="flex items-center text-almond-700">
                            <svg class="w-5 h-5 mr-3 text-almond-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            20% Service Discount
                        </div>
                        <div class="flex items-center text-almond-700">
                            <svg class="w-5 h-5 mr-3 text-almond-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            24/7 Emergency Support
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-almond-800 mb-2">First Month FREE</div>
                        <button class="w-full bg-almond-600 hover:bg-almond-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                            Upgrade Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>

 <!-- Modal Structure - Tailwind Best Practice -->
 <div id="modal-overlay" class="fixed inset-0 z-50 bg-black/50 opacity-0 invisible transition-all duration-300 flex items-center justify-center p-4">
     <div id="modal-content" class="bg-white rounded-2xl shadow-2xl transform scale-95 transition-all duration-300 w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
         <!-- Modal Header -->
         <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
             <h2 id="modal-title" class="text-2xl font-bold text-gray-900"></h2>
             <button id="modal-close" onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-1 rounded-full hover:bg-gray-100">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                 </svg>
             </button>
         </div>
         
         <!-- Modal Body -->
         <div class="flex-1 overflow-y-auto p-6">
             <div id="modal-meta" class="mb-4 text-sm text-gray-500"></div>
             <div id="modal-image" class="mb-6"></div>
             <div id="modal-body" class="prose prose-gray max-w-none"></div>
         </div>
     </div>
 </div>



<script>
     // Modal content data - Clean API format (no HTML in data)
     // This structure matches what you'll send from your API
     const modalContent = {
         'article-1': {
             title: 'Understanding Pet Nutrition: A Complete Guide',
             published_date: 'Dec 15, 2024',
             read_time: '5 min read',
             image_url: null, // Will use placeholder if null
             image_alt: 'Pet Nutrition Guide',
             theme_color: 'matcha', // for gradient background
             introduction: 'Proper nutrition is the foundation of your pet\'s health and wellbeing. Understanding what your furry friend needs can help them live a longer, happier life.',
             sections: [
                 {
                     title: 'Essential Nutrients for Pets',
                     content: 'Just like humans, pets require a balanced diet containing proteins, carbohydrates, fats, vitamins, and minerals. Each nutrient plays a crucial role in maintaining optimal health.',
                     subsections: [
                         {
                             title: 'Proteins',
                             content: 'Proteins are essential for muscle development, tissue repair, and immune function. High-quality animal proteins should make up the majority of your pet\'s diet.'
                         },
                         {
                             title: 'Carbohydrates', 
                             content: 'While not essential, carbohydrates provide energy and fiber. Choose complex carbohydrates like sweet potatoes and brown rice over simple sugars.'
                         },
                         {
                             title: 'Healthy Fats',
                             content: 'Omega-3 and omega-6 fatty acids support skin health, coat shine, and brain function. Fish oil and flaxseed are excellent sources.'
                         }
                     ]
                 },
                 {
                     title: 'Age-Specific Nutrition',
                     content: 'Nutritional needs change throughout your pet\'s life. Puppies and kittens require more calories and protein for growth, while senior pets may need specialized diets for joint health and easier digestion.'
                 },
                 {
                     title: 'Common Nutritional Mistakes',
                     content: null,
                     list_items: [
                         'Overfeeding treats and table scraps',
                         'Not adjusting portions based on activity level', 
                         'Switching foods too quickly',
                         'Ignoring food allergies and sensitivities'
                     ]
                 }
             ],
             conclusion: 'Remember, every pet is unique. Consult with our veterinary team to develop a nutrition plan tailored to your pet\'s specific needs, age, and health conditions.'
         },
         'article-2': {
             title: 'Seasonal Pet Care: Winter Safety Tips',
             published_date: 'Dec 12, 2024',
             read_time: '4 min read',
             image_url: null,
             image_alt: 'Winter Pet Safety',
             theme_color: 'chai',
             introduction: 'Winter brings unique challenges for pet owners. From cold temperatures to holiday hazards, here\'s how to keep your pets safe and comfortable during the colder months.',
             sections: [
                 {
                     title: 'Cold Weather Protection',
                     content: 'Not all pets are built for cold weather. Short-haired breeds, senior pets, and those with health conditions are particularly vulnerable to temperature drops.',
                     subsections: [
                         {
                             title: 'Indoor Comfort',
                             list_items: [
                                 'Provide warm, draft-free sleeping areas',
                                 'Consider pet-safe heating pads for older animals',
                                 'Maintain consistent indoor temperatures',
                                 'Ensure fresh water is always available (check for freezing)'
                             ]
                         },
                         {
                             title: 'Outdoor Safety',
                             list_items: [
                                 'Limit outdoor time during extreme cold',
                                 'Use pet sweaters or coats for vulnerable breeds',
                                 'Protect paws with booties or paw balm',
                                 'Check for ice buildup between toes'
                             ]
                         }
                     ]
                 },
                 {
                     title: 'Holiday Hazards',
                     content: 'The holiday season brings additional risks that pet owners should be aware of:',
                     list_items: [
                         'Toxic foods: Chocolate, xylitol, grapes, onions, and garlic',
                         'Decorations: Tinsel, ornaments, and electrical cords',
                         'Plants: Poinsettias, mistletoe, and holly',
                         'Candles: Fire hazards and hot wax burns'
                     ]
                 },
                 {
                     title: 'Winter Exercise Tips',
                     content: 'Maintaining exercise routines during winter is crucial for your pet\'s physical and mental health. Consider indoor activities like puzzle toys, training sessions, and interactive games when outdoor conditions are harsh.'
                 }
             ],
             conclusion: 'If you notice any signs of discomfort, lethargy, or unusual behavior during winter months, don\'t hesitate to contact our clinic for guidance.'
         },
         'article-3': {
             title: 'The Importance of Regular Veterinary Checkups',
             published_date: 'Dec 10, 2024',
             read_time: '6 min read',
             image_url: null,
             image_alt: 'Veterinary Checkups',
             theme_color: 'almond',
             introduction: 'Regular veterinary checkups are one of the most important things you can do for your pet\'s health. Early detection and prevention are key to ensuring your furry friend lives a long, healthy life.',
             sections: [
                 {
                     title: 'Why Regular Checkups Matter',
                     content: 'Pets age much faster than humans, and health issues can develop quickly. What might seem like a minor change in behavior could indicate a serious underlying condition.',
                     subsections: [
                         {
                             title: 'Early Disease Detection',
                             content: 'Many diseases, including cancer, kidney disease, and diabetes, can be present long before symptoms become obvious. Regular blood work and examinations can catch these conditions early when treatment is most effective.'
                         },
                         {
                             title: 'Preventive Care',
                             list_items: [
                                 'Vaccinations to prevent serious diseases',
                                 'Parasite prevention and control',
                                 'Dental care and oral health maintenance',
                                 'Weight management and nutrition counseling'
                             ]
                         }
                     ]
                 },
                 {
                     title: 'What to Expect During a Checkup',
                     content: 'A comprehensive veterinary examination includes:',
                     list_items: [
                         'Physical examination: Heart, lungs, abdomen, eyes, ears, and mouth',
                         'Weight and body condition assessment',
                         'Discussion of behavior and lifestyle changes',
                         'Review of vaccination status',
                         'Parasite screening',
                         'Blood work (as recommended by age and health status)'
                     ]
                 },
                 {
                     title: 'Recommended Checkup Frequency',
                     list_items: [
                         'Puppies/Kittens: Every 3-4 weeks until 16 weeks old',
                         'Adult pets (1-7 years): Annually',
                         'Senior pets (7+ years): Every 6 months',
                         'Pets with chronic conditions: As recommended by your veterinarian'
                     ]
                 },
                 {
                     title: 'Preparing for Your Visit',
                     content: 'To make the most of your appointment:',
                     list_items: [
                         'Bring a list of any concerns or questions',
                         'Note any changes in eating, drinking, or bathroom habits',
                         'Bring current medications and supplements',
                         'Consider bringing a fresh stool sample if requested'
                     ]
                 }
             ],
             conclusion: 'Remember, you know your pet best. If something seems "off," trust your instincts and schedule an appointment. Early intervention can make all the difference in your pet\'s health outcomes.'
         },
         'news-1': {
             title: 'New Advanced Surgery Suite Now Open',
             published_date: 'Dec 14, 2024',
             source: 'ZowZow Veterinary Clinic',
             image_url: null,
             image_alt: 'Advanced Surgery Suite',
             theme_color: 'pistache',
             introduction: 'We\'re thrilled to announce the opening of our state-of-the-art surgery suite, representing a significant milestone in our commitment to providing exceptional veterinary care.',
             sections: [
                 {
                     title: 'Cutting-Edge Technology',
                     content: 'Our new surgery suite features the latest in veterinary surgical technology, designed to improve patient outcomes and enhance the safety of all procedures.',
                     subsections: [
                         {
                             title: 'Advanced Equipment Features',
                             list_items: [
                                 'Digital monitoring systems: Real-time vital sign tracking with advanced alerts',
                                 'Minimally invasive surgical tools: Laparoscopic and arthroscopic equipment',
                                 'Enhanced anesthesia delivery: Precise gas monitoring and delivery systems',
                                 'Surgical microscopes: For delicate procedures requiring enhanced visualization',
                                 'Advanced electrosurgery units: For precise tissue cutting and coagulation'
                             ]
                         }
                     ]
                 },
                 {
                     title: 'Improved Patient Care',
                     content: 'The new facility allows us to perform more complex procedures with greater precision and safety. Benefits include:',
                     list_items: [
                         'Reduced surgical time and anesthesia exposure',
                         'Smaller incisions leading to faster recovery',
                         'Enhanced sterile environment reducing infection risk',
                         'Improved post-operative monitoring capabilities'
                     ]
                 },
                 {
                     title: 'Expanded Surgical Services',
                     content: 'With our new capabilities, we can now offer:',
                     list_items: [
                         'Advanced orthopedic procedures',
                         'Minimally invasive abdominal surgery',
                         'Complex soft tissue procedures',
                         'Emergency surgical interventions',
                         'Specialized procedures previously requiring referral'
                     ]
                 },
                 {
                     title: 'Our Commitment to Excellence',
                     content: 'This investment reflects our ongoing dedication to providing the highest standard of veterinary care. Our surgical team has undergone extensive training on all new equipment to ensure optimal outcomes for every patient.'
                 }
             ],
             conclusion: 'We invite you to schedule a tour of our new facilities. Contact us to learn more about how these advancements can benefit your pet\'s health and wellbeing.'
         },
         'news-2': {
             title: 'Free Community Pet Health Checkups This December',
             published_date: 'Dec 11, 2024',
             source: 'Community Outreach Program',
             image_url: null,
             image_alt: 'Community Health Initiative',
             theme_color: 'carob',
             introduction: 'We believe every pet deserves access to quality healthcare. That\'s why we\'re launching our Community Pet Health Initiative, offering free basic health checkups throughout December.',
             sections: [
                 {
                     title: 'Program Details',
                     content: 'Our community outreach program is designed to help pet owners who may be facing financial hardships ensure their pets receive essential healthcare.',
                     subsections: [
                         {
                             title: 'What\'s Included',
                             list_items: [
                                 'Complete physical examination',
                                 'Basic health assessment and consultation',
                                 'Weight and body condition evaluation',
                                 'Nutritional guidance and recommendations',
                                 'Parasite screening (visual examination)',
                                 'Vaccination status review',
                                 'Health education materials'
                             ]
                         }
                     ]
                 },
                 {
                     title: 'Eligibility and Registration',
                     content: 'This program is available to families in our community who demonstrate financial need. Priority will be given to:',
                     list_items: [
                         'Senior citizens on fixed incomes',
                         'Families receiving government assistance',
                         'Unemployed or underemployed individuals',
                         'Students and young families',
                         'Rescue organizations and foster families'
                     ],
                     subsections: [
                         {
                             title: 'How to Register',
                             content: 'Registration is required and spaces are limited. To register:',
                             list_items: [
                                 'Call our clinic at (555) 123-4567',
                                 'Provide basic information about your pet and household',
                                 'Schedule your appointment for a convenient time',
                                 'Bring proof of financial need (optional but helpful)'
                             ]
                         }
                     ]
                 },
                 {
                     title: 'Schedule and Locations',
                     content: 'Free checkups will be available:',
                     list_items: [
                         'Weekdays: 2:00 PM - 4:00 PM',
                         'Saturdays: 9:00 AM - 12:00 PM',
                         'Location: ZowZow Veterinary Clinic main facility',
                         'Duration: Throughout December 2024'
                     ]
                 },
                 {
                     title: 'Additional Resources',
                     content: 'Beyond free checkups, we\'re also providing:',
                     list_items: [
                         'Discounted vaccination packages',
                         'Low-cost spay/neuter referrals',
                         'Pet food bank connections',
                         'Educational workshops on pet care'
                     ]
                 }
             ],
             conclusion: 'This initiative is part of our commitment to the community that has supported us for years. Together, we can ensure that financial constraints don\'t prevent pets from receiving the care they need.'
         },
         'news-3': {
             title: 'ZowZow Clinic Receives Excellence in Pet Care Award',
             published_date: 'Dec 8, 2024',
             source: 'Award Recognition',
             image_url: null,
             image_alt: 'Excellence Award',
             theme_color: 'vanilla',
             introduction: 'We are deeply honored to announce that ZowZow Veterinary Clinic has been awarded the prestigious "Excellence in Pet Care" award by the Regional Veterinary Association.',
             sections: [
                 {
                     title: 'Recognition of Our Commitment',
                     content: 'This award recognizes veterinary practices that demonstrate exceptional standards in patient care, client service, and community involvement. We are proud to be among the select few clinics chosen for this honor.',
                     subsections: [
                         {
                             title: 'Award Criteria',
                             content: 'The Regional Veterinary Association evaluated clinics based on:',
                             list_items: [
                                 'Quality of medical care and treatment outcomes',
                                 'Client satisfaction and communication',
                                 'Continuing education and professional development',
                                 'Community outreach and involvement',
                                 'Facility standards and equipment',
                                 'Team expertise and compassionate care'
                             ]
                         }
                     ]
                 },
                 {
                     title: 'What This Means for Our Clients',
                     content: 'This recognition validates what our clients have known all along - that ZowZow Veterinary Clinic provides exceptional care. It also means:',
                     list_items: [
                         'Continued commitment to the highest standards of care',
                         'Access to cutting-edge treatments and technologies',
                         'Ongoing professional development for our entire team',
                         'Enhanced partnerships with specialist veterinarians',
                         'Participation in advanced veterinary research initiatives'
                     ]
                 },
                 {
                     title: 'Our Journey to Excellence',
                     content: 'This award is the result of years of dedication from our entire team:',
                     subsections: [
                         {
                             title: 'Team Achievements',
                             list_items: [
                                 'Over 500 hours of continuing education completed by our staff this year',
                                 'Implementation of advanced diagnostic equipment',
                                 'Development of specialized treatment protocols',
                                 'Launch of our community outreach programs',
                                 'Achievement of 98% client satisfaction rating'
                             ]
                         }
                     ]
                 },
                 {
                     title: 'Looking Forward',
                     content: 'While we celebrate this achievement, we remain focused on continuous improvement. Our upcoming initiatives include:',
                     list_items: [
                         'Expansion of our surgical capabilities',
                         'Introduction of new diagnostic services',
                         'Enhanced client education programs',
                         'Increased community health initiatives',
                         'Partnerships with local animal welfare organizations'
                     ]
                 },
                 {
                     title: 'Thank You to Our Community',
                     content: 'This award belongs not just to our team, but to our entire community. The trust you place in us, the feedback you provide, and the love you show your pets inspire us to be better every day.'
                 }
             ],
             conclusion: 'We look forward to continuing to serve you and your beloved pets with the same dedication and excellence that earned us this recognition. Thank you for being part of the ZowZow family.'
         }
     };

     // Helper functions for API integration
     // These functions can be easily modified to work with API data
     
     /**
      * Load modal content from API (future implementation)
      * @param {string} contentId - The ID of the content to load
      * @returns {Promise<Object>} - Promise that resolves to content data
      */
     async function loadModalContentFromAPI(contentId) {
         // TODO: Replace with actual API call
         // Example: const response = await fetch(`/api/modal-content/${contentId}`);
         // return await response.json();
         
         // For now, return static data
         return modalContent[contentId] || null;
     }

     /**
      * Render modal content with proper Tailwind styling
      * @param {Object} content - Content object with clean API format
      */
     function renderModalContent(content) {
         if (!content) return;
         
         // Set title
         document.getElementById('modal-title').innerHTML = content.title || '';
         
         // Generate meta information
         let metaHtml = '';
         if (content.published_date) {
             metaHtml += `<span class="text-sm text-gray-500">Published on ${content.published_date}`;
             if (content.source) {
                 metaHtml += ` • ${content.source}`;
             }
             if (content.read_time) {
                 metaHtml += ` • ${content.read_time}`;
             }
             metaHtml += '</span>';
         }
         document.getElementById('modal-meta').innerHTML = metaHtml;
         
         // Generate image
         let imageHtml = '';
         if (content.image_url) {
             imageHtml = `<img src="${content.image_url}" alt="${content.image_alt || ''}" class="w-full h-64 object-cover rounded-lg">`;
         } else if (content.image_alt && content.theme_color) {
             const colorClass = content.theme_color === 'vanilla' ? 'from-vanilla-100 to-vanilla-200' : 
                               content.theme_color === 'blue' ? 'from-blue-100 to-blue-200' : 
                               'from-gray-100 to-gray-200';
             const textColorClass = content.theme_color === 'vanilla' ? 'text-vanilla-600' : 
                                   content.theme_color === 'blue' ? 'text-blue-600' : 
                                   'text-gray-600';
             imageHtml = `<div class="w-full h-64 bg-gradient-to-r ${colorClass} rounded-lg flex items-center justify-center"><span class="${textColorClass} font-semibold">${content.image_alt}</span></div>`;
         }
         document.getElementById('modal-image').innerHTML = imageHtml;
         
         // Generate body content
         let bodyHtml = '';
         
         // Add introduction
         if (content.introduction) {
             bodyHtml += `<p class="text-lg text-gray-700 mb-6">${content.introduction}</p>`;
         }
         
         // Add sections
         if (content.sections && Array.isArray(content.sections)) {
             content.sections.forEach(section => {
                 if (section.title) {
                     bodyHtml += `<h3 class="text-xl font-semibold text-gray-900 mb-4">${section.title}</h3>`;
                 }
                 
                 if (section.content) {
                     bodyHtml += `<p class="mb-4">${section.content}</p>`;
                 }
                 
                 // Add list items for section
                 if (section.list_items && Array.isArray(section.list_items)) {
                     bodyHtml += '<ul class="list-disc pl-6 mb-4">';
                     section.list_items.forEach(item => {
                         bodyHtml += `<li>${item}</li>`;
                     });
                     bodyHtml += '</ul>';
                 }
                 
                 // Add subsections
                 if (section.subsections && Array.isArray(section.subsections)) {
                     section.subsections.forEach(subsection => {
                         if (subsection.title) {
                             bodyHtml += `<h4 class="text-lg font-semibold text-gray-800 mb-3">${subsection.title}</h4>`;
                         }
                         
                         if (subsection.content) {
                             bodyHtml += `<p class="mb-4">${subsection.content}</p>`;
                         }
                         
                         if (subsection.list_items && Array.isArray(subsection.list_items)) {
                             bodyHtml += '<ul class="list-disc pl-6 mb-4">';
                             subsection.list_items.forEach(item => {
                                 bodyHtml += `<li>${item}</li>`;
                             });
                             bodyHtml += '</ul>';
                         }
                     });
                 }
             });
         }
         
         // Add conclusion
         if (content.conclusion) {
             bodyHtml += `<p class="text-gray-700">${content.conclusion}</p>`;
         }
         
         document.getElementById('modal-body').innerHTML = bodyHtml;
     }

     /**
      * Show modal with Tailwind animations
      */
     function showModal() {
         const overlay = document.getElementById('modal-overlay');
         const modalContentEl = document.getElementById('modal-content');
         
         if (!overlay || !modalContentEl) {
             console.error('Modal elements not found');
             return;
         }
         
         // Show modal with Tailwind classes
         overlay.classList.remove('invisible', 'opacity-0');
         overlay.classList.add('visible', 'opacity-100');
         
         setTimeout(() => {
             modalContentEl.classList.remove('scale-95');
             modalContentEl.classList.add('scale-100');
         }, 10);
         
         // Prevent body scroll
         document.body.classList.add('overflow-hidden');
     }

     /**
      * Hide modal with Tailwind animations
      */
     function hideModal() {
         const overlay = document.getElementById('modal-overlay');
         const modalContentEl = document.getElementById('modal-content');
         
         if (!overlay || !modalContentEl) {
             console.error('Modal elements not found');
             return;
         }
         
         // Hide modal with Tailwind classes
         overlay.classList.remove('visible', 'opacity-100');
         overlay.classList.add('invisible', 'opacity-0');
         
         modalContentEl.classList.remove('scale-100');
         modalContentEl.classList.add('scale-95');
         
         setTimeout(() => {
             // Restore body scroll
             document.body.classList.remove('overflow-hidden');
         }, 300);
     }

     // Main modal functions (compatible with existing implementation)
     async function openModal(contentId) {
         console.log('Opening modal for:', contentId);
         
         try {
             // Load content (ready for API integration)
             const content = await loadModalContentFromAPI(contentId);
             
             if (!content) {
                 console.log('Content not found for:', contentId);
                 return;
             }

             // Render content using helper function
             renderModalContent(content);
             
             // Show modal using helper function
             showModal();
             
         } catch (error) {
             console.error('Error opening modal:', error);
         }
     }

     function closeModal() {
         console.log('Closing modal');
         
         try {
             // Hide modal using helper function
             hideModal();
         } catch (error) {
             console.error('Error closing modal:', error);
         }
     }

     // Make functions globally available for backward compatibility
     window.openModal = openModal;
     window.closeModal = closeModal;

     // Event listeners for modal
     document.addEventListener('DOMContentLoaded', function() {
         console.log('Setting up modal event listeners');
         
         // Close modal when clicking outside
         const overlay = document.getElementById('modal-overlay');
         if (overlay) {
             overlay.addEventListener('click', function(e) {
                 if (e.target === this) {
                     closeModal();
                 }
             });
         }

         // Close modal with Escape key
         document.addEventListener('keydown', function(e) {
             if (e.key === 'Escape') {
                 closeModal();
             }
         });

         // Close button
         const closeBtn = document.getElementById('modal-close');
         if (closeBtn) {
             closeBtn.addEventListener('click', closeModal);
         }
     });
 </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetTab = btn.getAttribute('data-tab');
            
            // Remove active class from all tabs and contents
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            
            // Add active class to clicked tab and show corresponding content
            btn.classList.add('active');
            const targetContent = document.getElementById(targetTab + '-content');
            if (targetContent) {
                targetContent.classList.remove('hidden');
                targetContent.classList.add('active');
            }
        });
    });
    
    // Testimonial carousel functionality
    const track = document.querySelector('.testimonial-track');
    const slides = document.querySelectorAll('.testimonial-slide');
    const prevBtn = document.querySelector('.testimonial-prev');
    const nextBtn = document.querySelector('.testimonial-next');
    const indicators = document.querySelectorAll('.testimonial-indicator');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    
    function updateCarousel() {
        const translateX = -currentSlide * 100;
        track.style.transform = `translateX(${translateX}%)`;
        
        // Update indicators
        indicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.remove('bg-matcha-300');
                indicator.classList.add('bg-matcha-600');
            } else {
                indicator.classList.remove('bg-matcha-600');
                indicator.classList.add('bg-matcha-300');
            }
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    }
    
    // Event listeners
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    
    // Indicator click functionality
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            currentSlide = index;
            updateCarousel();
        });
    });
    
    // Auto-play carousel (optional)
    setInterval(nextSlide, 5000);
    
    // Tab button styling
    const style = document.createElement('style');
    style.textContent = `
        .tab-btn.active {
            background: linear-gradient(135deg, #809671, #7BA05B);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(128, 150, 113, 0.3);
        }
        
        .tab-btn:not(.active) {
            color: #6d8c4f;
            background: transparent;
        }
        
        .tab-btn:not(.active):hover {
            background: rgba(128, 150, 113, 0.1);
            color: #5a7342;
        }
    `;
    document.head.appendChild(style);
});
</script>

<!--
API Response Format Documentation
================================

The modal system now accepts clean, structured data without embedded HTML.
Here's the expected API response format:

Example API Response for Articles:
{
    "title": "Article Title",
    "published_date": "Dec 15, 2024",
    "read_time": "5 min read",
    "image_url": "https://example.com/image.jpg", // or null for placeholder
    "image_alt": "Image description",
    "theme_color": "vanilla", // "vanilla", "blue", or "gray"
    "introduction": "Opening paragraph text",
    "sections": [
        {
            "title": "Section Title",
            "content": "Section content text",
            "list_items": ["Item 1", "Item 2"], // optional
            "subsections": [ // optional
                {
                    "title": "Subsection Title",
                    "content": "Subsection content",
                    "list_items": ["Sub item 1", "Sub item 2"]
                }
            ]
        }
    ],
    "conclusion": "Closing paragraph text"
}

Example API Response for News:
{
    "title": "News Title",
    "published_date": "Dec 15, 2024",
    "source": "News Source",
    "image_url": null,
    "image_alt": "Placeholder text",
    "theme_color": "blue",
    "introduction": "News introduction",
    "sections": [
        {
            "title": "Section Title",
            "content": "Section content",
            "list_items": ["Point 1", "Point 2"]
        }
    ],
    "conclusion": "News conclusion"
}

Benefits of this format:
- No HTML embedded in data
- Clean separation of content and presentation
- Easy to validate and sanitize
- Flexible structure for different content types
- API-friendly and database-friendly
- Supports nested sections and lists
- Consistent styling through Tailwind classes
-->