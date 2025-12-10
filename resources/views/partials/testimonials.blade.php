{{-- Testimonials, Articles, News & Promo Section --}}
<section id="testimoni" class="relative py-20 overflow-hidden bg-transparent">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-6 left-6 rotate-6 opacity-10">
            <svg class="w-16 h-6 text-forest-moss-green-200" viewBox="0 0 100 40" fill="currentColor">
                <circle cx="10" cy="10" r="8"></circle>
                <circle cx="10" cy="30" r="8"></circle>
                <circle cx="90" cy="10" r="8"></circle>
                <circle cx="90" cy="30" r="8"></circle>
                <rect x="18" y="12" width="64" height="16" rx="8" ry="8"></rect>
            </svg>
        </div>
        <div class="absolute bottom-8 right-8 -rotate-6 opacity-10">
            <svg class="w-16 h-6 text-chai-200" viewBox="0 0 100 40" fill="currentColor">
                <circle cx="10" cy="10" r="8"></circle>
                <circle cx="10" cy="30" r="8"></circle>
                <circle cx="90" cy="10" r="8"></circle>
                <circle cx="90" cy="30" r="8"></circle>
                <rect x="18" y="12" width="64" height="16" rx="8" ry="8"></rect>
            </svg>
        </div>
    </div>
    
    {{-- Background with blur effect --}}
    <div class="absolute inset-0 bg-gradient-to-b from-soft-linen-50/20 via-vanilla-50/20 to-forest-moss-green-50/30"></div>
    <div class="absolute inset-0 backdrop-blur-sm"></div>
    
    {{-- Decorative elements --}}
    <div class="absolute top-10 left-10 w-32 h-32 bg-forest-moss-green-200/20 rounded-full blur-xl"></div>
    <div class="absolute bottom-10 right-10 w-40 h-40 bg-chai-200/20 rounded-full blur-xl"></div>
    <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-soft-linen-200/20 rounded-full blur-lg"></div>
    
    <div class="relative max-w-7xl mx-auto px-6 z-10">
        
        {{-- Navigation Tabs --}}
        <div class="flex justify-center mb-8 md:mb-12 px-4">
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-1.5 md:p-2 shadow-lg border border-white/20 w-full max-w-2xl">
                <div class="grid grid-cols-2 md:flex md:justify-center gap-1 md:gap-0">
                    <button class="tab-btn active px-3 py-2.5 md:px-6 md:py-3 rounded-lg md:rounded-xl font-medium md:font-semibold text-sm md:text-base transition-all duration-300 text-center" data-tab="testimonials">
                        Testimonials
                    </button>
                    <button class="tab-btn px-3 py-2.5 md:px-6 md:py-3 rounded-lg md:rounded-xl font-medium md:font-semibold text-sm md:text-base transition-all duration-300 text-center" data-tab="articles">
                        Articles
                    </button>
                    <button class="tab-btn px-3 py-2.5 md:px-6 md:py-3 rounded-lg md:rounded-xl font-medium md:font-semibold text-sm md:text-base transition-all duration-300 text-center" data-tab="news">
                        News
                    </button>
                    <button class="tab-btn px-3 py-2.5 md:px-6 md:py-3 rounded-lg md:rounded-xl font-medium md:font-semibold text-sm md:text-base transition-all duration-300 text-center" data-tab="promo">
                        Promo
                    </button>
                </div>
            </div>
        </div>

        {{-- Testimonials Tab Content --}}
        <div id="testimonials-content" class="tab-content active">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-forest-moss-green-800 mb-4">
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
                    <div class="text-3xl md:text-4xl font-bold text-forest-moss-green-600 mb-2">500+</div>
                    <div class="text-gray-600 font-medium">Happy Clients</div>
                </div>
                
                {{-- Pets Served --}}
                <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-forest-moss-green-600 mb-2">1,200+</div>
                    <div class="text-gray-600 font-medium">Pets Served</div>
                </div>
                
                {{-- Average Rating --}}
                <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-forest-moss-green-600 mb-2">4.9/5</div>
                    <div class="text-gray-600 font-medium">Average Rating</div>
                </div>
                
                {{-- Years Experience --}}
                <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-forest-moss-green-600 mb-2">5+</div>
                    <div class="text-gray-600 font-medium">Years Experience</div>
                </div>
            </div>

            {{-- Testimonials Carousel --}}
            <div class="relative">
                <div class="testimonial-carousel overflow-hidden rounded-2xl">
                    <div class="testimonial-track flex transition-transform duration-500 ease-in-out">
                        @if($testimonials->count() > 0)
                            @php
                                $chunks = $testimonials->chunk(3);
                                $colors = ['forest-moss-green', 'chai', 'soft-linen', 'vanilla'];
                            @endphp
                            @foreach($chunks as $chunkIndex => $testimonialChunk)
                                <div class="testimonial-slide w-full flex-shrink-0">
                                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                                        @foreach($testimonialChunk as $index => $testimonial)
                                            @php
                                                $color = $colors[$index % 4];
                                                $initials = strtoupper(substr($testimonial->name, 0, 1) . (strpos($testimonial->name, ' ') ? substr($testimonial->name, strpos($testimonial->name, ' ') + 1, 1) : ''));
                                            @endphp
                                            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                                                <div class="flex mb-4">
                                                    @for($i = 0; $i < $testimonial->rating; $i++)
                                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    @endfor
                                                    @for($i = $testimonial->rating; $i < 5; $i++)
                                                        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <p class="text-gray-700 mb-6 leading-relaxed">
                                                    "{{ $testimonial->content }}"
                                                </p>
                                                <div class="flex items-center">
                                                    @if($testimonial->avatar)
                                                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full mr-4 object-cover">
                                                    @else
                                                        <div class="w-12 h-12 bg-{{ $color }}-200 rounded-full flex items-center justify-center text-{{ $color }}-800 font-bold text-lg mr-4">{{ $initials }}</div>
                                                    @endif
                                                    <div>
                                                        <div class="font-semibold text-gray-800">{{ $testimonial->name }}</div>
                                                        <div class="text-sm text-gray-600">
                                                            @if($testimonial->pet_name && $testimonial->pet_type)
                                                                {{ ucfirst($testimonial->pet_type) }} Owner
                                                                @if($testimonial->pet_name)
                                                                    ({{ $testimonial->pet_name }})
                                                                @endif
                                                            @elseif($testimonial->position && $testimonial->company)
                                                                {{ $testimonial->position }} at {{ $testimonial->company }}
                                                            @else
                                                                Pet Owner
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{-- Fallback content if no testimonials --}}
                            <div class="testimonial-slide w-full flex-shrink-0">
                                <div class="text-center py-8">
                                    <p class="text-gray-600">Belum ada testimonial tersedia.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Carousel Navigation --}}
                @if($testimonials->count() > 3)
                <div class="flex justify-center mt-8 space-x-4">
                    <button class="testimonial-prev bg-white/60 backdrop-blur-sm hover:bg-white/80 rounded-full p-3 shadow-lg border border-white/20 transition-all duration-300">
                        <svg class="w-6 h-6 text-forest-moss-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <div class="flex space-x-2 items-center">
                        @php
                            $totalSlides = ceil($testimonials->count() / 3);
                        @endphp
                        @for($i = 0; $i < $totalSlides; $i++)
                            <div class="testimonial-indicator w-3 h-3 rounded-full {{ $i === 0 ? 'bg-forest-moss-green-600' : 'bg-forest-moss-green-300' }} transition-all duration-300" data-slide="{{ $i }}"></div>
                        @endfor
                    </div>
                    <button class="testimonial-next bg-white/60 backdrop-blur-sm hover:bg-white/80 rounded-full p-3 shadow-lg border border-white/20 transition-all duration-300">
                        <svg class="w-6 h-6 text-forest-moss-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
                @endif
            </div>
        </div>

        {{-- Articles Tab Content --}}
        <div id="articles-content" class="tab-content hidden">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-forest-moss-green-800 mb-4">
                    Pet Care Articles
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Expert advice and insights to help you provide the best care for your beloved pets.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($articles->count() > 0)
                    @php
                        $colors = ['forest-moss-green', 'chai', 'soft-linen', 'vanilla'];
                        $categories = ['Pet Health', 'Grooming', 'Training', 'Nutrition', 'Behavior', 'Care'];
                    @endphp
                    @foreach($articles as $index => $article)
                        @php
                            $color = $colors[$index % 4];
                            $category = $categories[$index % 6];
                        @endphp
                        <article class="bg-white/70 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300 group">
                            <div class="h-48 bg-gradient-to-br from-{{ $color }}-200 to-{{ $color }}-300 relative overflow-hidden">
                                @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-{{ $color }}-600/20 group-hover:bg-{{ $color }}-600/30 transition-all duration-300"></div>
                                @else
                                    <div class="absolute inset-0 bg-{{ $color }}-600/20 group-hover:bg-{{ $color }}-600/30 transition-all duration-300"></div>
                                @endif
                                <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium text-{{ $color }}-700">
                                    @if($article->tags && count($article->tags) > 0)
                                         {{ ucfirst($article->tags[0]) }}
                                    @else
                                        {{ $category }}
                                    @endif
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-{{ $color }}-700 transition-colors">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 120) }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}
                                    </span>
                                    <a href="#" onclick="openModal('modal-article-{{ $article->id }}')" class="text-{{ $color }}-600 hover:text-{{ $color }}-700 font-medium text-sm transition-colors">Read More →</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-600">Belum ada artikel tersedia.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- News Tab Content --}}
        <div id="news-content" class="tab-content hidden">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-forest-moss-green-800 mb-4">
                    Latest News
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Stay updated with the latest developments in pet care and our clinic updates.
                </p>
            </div>

            <div class="space-y-8">
                @if($news->count() > 0)
                    @php
                        $colors = ['forest-moss-green', 'chai', 'soft-linen', 'vanilla'];
                        $categories = ['Clinic Update', 'Community', 'Achievement', 'Health', 'Service', 'Event'];
                    @endphp
                    @foreach($news as $index => $newsItem)
                        @php
                            $color = $colors[$index % 4];
                            $category = $categories[$index % 6];
                        @endphp
                        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/30 hover:shadow-xl transition-all duration-300">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="md:w-1/3">
                                    <div class="h-48 bg-gradient-to-br from-{{ $color }}-200 to-{{ $color }}-400 rounded-xl relative overflow-hidden">
                                        @if($newsItem->featured_image)
                                    <img src="{{ asset('storage/' . $newsItem->featured_image) }}" alt="{{ $newsItem->title }}" class="w-full h-full object-cover rounded-xl">
                                        @endif
                                        <div class="absolute inset-0 bg-{{ $color }}-600/20"></div>
                                        @if($newsItem->is_breaking)
                                            <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                Breaking
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="md:w-2/3">
                                    <div class="flex items-center gap-4 mb-3">
                                        <span class="bg-{{ $color }}-100 text-{{ $color }}-700 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $newsItem->category ?: $category }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ $newsItem->published_at ? $newsItem->published_at->format('M d, Y') : $newsItem->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                        {{ $newsItem->title }}
                                    </h3>
                                    <p class="text-gray-600 mb-4 leading-relaxed">
                                        {{ $newsItem->excerpt ?: Str::limit(strip_tags($newsItem->content), 200) }}
                                    </p>
                                    <a href="#" onclick="openModal('modal-news-{{ $newsItem->id }}')" class="text-{{ $color }}-600 hover:text-{{ $color }}-700 font-medium transition-colors">Read Full Story →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-600">Belum ada berita tersedia.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Promo Tab Content --}}
        <div id="promo-content" class="tab-content hidden">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-forest-moss-green-800 mb-4">
                    Special Offers
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Take advantage of our exclusive promotions and save on premium pet care services.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($promos->count() > 0)
                    @php
                        $colors = ['forest-moss-green', 'chai', 'soft-linen', 'vanilla'];
                        $badgeColors = ['red', 'orange', 'green', 'blue', 'purple'];
                    @endphp
                    @foreach($promos as $index => $promo)
                        @php
                            $color = $colors[$index % 4];
                            $badgeColor = $badgeColors[$index % 5];
                            $features = $promo->features ? json_decode($promo->features, true) : [];
                        @endphp
                        <div class="bg-gradient-to-br from-{{ $color }}-50 to-{{ $color }}-100 rounded-2xl p-6 shadow-lg border border-{{ $color }}-200/50 hover:shadow-xl hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                            <!-- Decorative background pattern -->
                            <div class="absolute inset-0 opacity-5">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $color }}-600 rounded-full -translate-y-16 translate-x-16"></div>
                                <div class="absolute bottom-0 left-0 w-24 h-24 bg-{{ $color }}-400 rounded-full translate-y-12 -translate-x-12"></div>
                            </div>
                            
                            @if($promo->discount_value)
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-{{ $badgeColor }}-500 to-{{ $badgeColor }}-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg transform rotate-3 group-hover:rotate-0 transition-transform duration-300">
                                    @if($promo->discount_type === 'percentage')
                                        {{ $promo->discount_value }}% OFF
                                    @elseif($promo->discount_type === 'fixed')
                                        Rp{{ number_format($promo->discount_value, 0, ',', '.') }} OFF
                                    @else
                                        SPECIAL
                                    @endif
                                </div>
                            @endif
                            
                            @if($promo->featured_image)
                                <div class="mb-6 relative">
                                    <img src="{{ asset('storage/' . $promo->featured_image) }}" alt="{{ $promo->title }}" class="w-full h-48 object-cover rounded-xl shadow-md group-hover:shadow-lg transition-shadow duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl"></div>
                                </div>
                            @endif
                            
                            <div class="relative z-10 mb-6">
                                <h3 class="text-2xl font-bold text-{{ $color }}-900 mb-3 group-hover:text-{{ $color }}-800 transition-colors duration-300">
                                    {{ $promo->title }}
                                </h3>
                                <p class="text-{{ $color }}-700 leading-relaxed mb-4 text-sm">
                                    {{ $promo->description }}
                                </p>
                                
                                @if($promo->promo_code)
                                    <div class="bg-white/80 backdrop-blur-sm border-2 border-dashed border-{{ $color }}-400 rounded-lg p-4 mb-4 shadow-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-{{ $color }}-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-sm text-{{ $color }}-700 font-medium">Kode Promo:</span>
                                            </div>
                                            <span class="text-lg font-bold text-{{ $color }}-900 bg-{{ $color }}-100 px-3 py-1 rounded-lg border border-{{ $color }}-300">{{ $promo->promo_code }}</span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($promo->min_purchase)
                                    <div class="flex items-center text-sm text-{{ $color }}-600 mb-3 bg-{{ $color }}-50 p-2 rounded-lg">
                                        <svg class="w-4 h-4 mr-2 text-{{ $color }}-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-medium">Min. transaksi:</span> 
                                        <span class="ml-1 font-bold text-{{ $color }}-800">Rp{{ number_format($promo->min_purchase, 0, ',', '.') }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            @if($promo->terms_conditions)
                                @php
                                    // Handle both string and array data types
                                    if (is_string($promo->terms_conditions)) {
                                        $terms = json_decode($promo->terms_conditions, true) ?: [];
                                    } else {
                                        $terms = is_array($promo->terms_conditions) ? $promo->terms_conditions : [];
                                    }
                                @endphp
                                @if(!empty($terms))
                                    <div class="bg-{{ $color }}-50/50 rounded-lg p-4 mb-6 border border-{{ $color }}-200/50">
                                        <h4 class="text-sm font-semibold text-{{ $color }}-800 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                            Syarat & Ketentuan:
                                        </h4>
                                        <div class="space-y-2">
                                            @foreach($terms as $term)
                                                <div class="flex items-start text-{{ $color }}-700 text-xs">
                                                    <svg class="w-3 h-3 mr-2 mt-1 text-{{ $color }}-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="leading-relaxed">{{ $term }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif
                            
                            <div class="relative z-10">
                                @if($promo->start_date && $promo->end_date)
                                    <div class="flex items-center justify-center text-xs text-{{ $color }}-600 mb-3 bg-{{ $color }}-50 p-2 rounded-lg">
                                        <svg class="w-4 h-4 mr-2 text-{{ $color }}-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-medium">Berlaku:</span> 
                                        <span class="ml-1">{{ \Carbon\Carbon::parse($promo->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}</span>
                                    </div>
                                @endif
                                
                                @if($promo->usage_limit)
                                    <div class="flex items-center justify-center text-xs text-{{ $color }}-600 mb-4 bg-{{ $color }}-50 p-2 rounded-lg">
                                        <svg class="w-4 h-4 mr-2 text-{{ $color }}-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-medium">Tersisa:</span> 
                                        <span class="ml-1 font-bold text-{{ $color }}-800">{{ $promo->usage_limit - $promo->used_count }}</span> 
                                        <span class="text-{{ $color }}-500"> &nbsp; dari {{ $promo->usage_limit }} kuota</span>
                                    </div>
                                @endif
                                
                                <!-- <button class="w-full bg-gradient-to-r from-{{ $color }}-600 to-{{ $color }}-700 hover:from-{{ $color }}-700 hover:to-{{ $color }}-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center group">
                                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                                    </svg>
                                    Gunakan Promo
                                </button> -->
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-600">Belum ada promo tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
 </section>



<!-- Article Modals -->
@if(isset($articles) && $articles->count() > 0)
    @php
        $modalColors = ['forest-moss-green', 'chai', 'soft-linen', 'vanilla'];
    @endphp
    @foreach($articles as $index => $article)
        @php
            $color = $modalColors[$index % 4];
        @endphp
        <div id="modal-article-{{ $article->id }}" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white/95 backdrop-blur-md rounded-3xl max-w-5xl w-full max-h-[95vh] overflow-hidden shadow-2xl border border-white/20">
                <!-- Modal Header -->
                <div class="sticky top-0 bg-gradient-to-r from-{{ $color }}-100 via-{{ $color }}-50 to-white/90 backdrop-blur-md border-b border-{{ $color }}-200/50 p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-2 h-2 bg-{{ $color }}-500 rounded-full"></div>
                                <span class="text-{{ $color }}-700 font-medium text-sm uppercase tracking-wide">Article</span>
                                @if($article->is_featured)
                                    <span class="bg-{{ $color }}-500 text-white px-2 py-1 rounded-full text-xs font-medium">Featured</span>
                                @endif
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $article->title }}</h2>
                            <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>{{ $article->author ?? 'ZowZow Team' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span>{{ number_format($article->views ?? 0) }} views</span>
                                </div>
                            </div>
                        </div>
                        <button onclick="closeModal('modal-article-{{ $article->id }}')" class="bg-white/80 hover:bg-white rounded-full p-2 shadow-lg border border-{{ $color }}-200/50 transition-all duration-300 hover:scale-110">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Modal Content -->
                <div class="overflow-y-auto max-h-[calc(95vh-200px)]">
                    <div class="p-6 md:p-8">
                        <!-- Article Excerpt -->
                        @if($article->excerpt)
                            <div class="bg-gradient-to-r from-{{ $color }}-50 to-{{ $color }}-25 rounded-2xl p-6 mb-8 border-l-4 border-{{ $color }}-400">
                                <p class="text-lg md:text-xl text-gray-700 leading-relaxed font-medium italic">
                                    "{{ $article->excerpt }}"
                                </p>
                            </div>
                        @endif
                        
                        <!-- Article Content -->
                        <div class="prose prose-lg max-w-none">
                            <div class="text-gray-800 leading-relaxed space-y-6">
                                {!! $article->content !!}
                            </div>
                        </div>
                        
                        <!-- Article Footer -->
                        <div class="mt-12 pt-8 border-t border-{{ $color }}-200">
                            <div class="bg-gradient-to-br from-{{ $color }}-50 to-{{ $color }}-25 rounded-2xl p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-{{ $color }}-200 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-{{ $color }}-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $article->author ?? 'ZowZow Team' }}</div>
                                            <div class="text-sm text-gray-600">Pet Care Expert</div>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <button class="bg-{{ $color }}-500 hover:bg-{{ $color }}-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105">
                                            Share Article
                                        </button>
                                        <button class="bg-white hover:bg-{{ $color }}-50 text-{{ $color }}-700 border border-{{ $color }}-300 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105">
                                            Save for Later
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- News Modals -->
@if(isset($news) && $news->count() > 0)
    @php
        $newsColors = ['chai', 'forest-moss-green', 'vanilla', 'soft-linen'];
    @endphp
    @foreach($news as $index => $newsItem)
        @php
            $color = $newsColors[$index % 4];
        @endphp
        <div id="modal-news-{{ $newsItem->id }}" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white/95 backdrop-blur-md rounded-3xl max-w-5xl w-full max-h-[95vh] overflow-hidden shadow-2xl border border-white/20">
                <!-- Modal Header -->
                <div class="sticky top-0 bg-gradient-to-r from-{{ $color }}-100 via-{{ $color }}-50 to-white/90 backdrop-blur-md border-b border-{{ $color }}-200/50 p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-2 h-2 bg-{{ $color }}-500 rounded-full animate-pulse"></div>
                                <span class="text-{{ $color }}-700 font-medium text-sm uppercase tracking-wide">Breaking News</span>
                                @if($newsItem->is_breaking)
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium animate-pulse">Live</span>
                                @endif
                                @if($newsItem->category)
                                    <span class="bg-{{ $color }}-500 text-white px-2 py-1 rounded-full text-xs font-medium">{{ $newsItem->category }}</span>
                                @endif
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $newsItem->title }}</h2>
                            <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $newsItem->published_at ? $newsItem->published_at->format('M d, Y • H:i') : $newsItem->created_at->format('M d, Y • H:i') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                    <span>{{ $newsItem->author ?? 'ZowZow News Team' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span>{{ number_format($newsItem->views ?? 0) }} views</span>
                                </div>
                            </div>
                        </div>
                        <button onclick="closeModal('modal-news-{{ $newsItem->id }}')" class="bg-white/80 hover:bg-white rounded-full p-2 shadow-lg border border-{{ $color }}-200/50 transition-all duration-300 hover:scale-110">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Modal Content -->
                <div class="overflow-y-auto max-h-[calc(95vh-200px)]">
                    <div class="p-6 md:p-8">
                        <!-- News Lead/Excerpt -->
                        @if($newsItem->excerpt)
                            <div class="bg-gradient-to-r from-{{ $color }}-50 to-{{ $color }}-25 rounded-2xl p-6 mb-8 border-l-4 border-{{ $color }}-400">
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 bg-{{ $color }}-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed font-medium">
                                        {{ $newsItem->excerpt }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- News Content -->
                        <div class="prose prose-lg max-w-none">
                            <div class="text-gray-800 leading-relaxed space-y-6">
                                {!! $newsItem->content !!}
                            </div>
                        </div>
                        
                        <!-- News Footer -->
                        <div class="mt-12 pt-8 border-t border-{{ $color }}-200">
                            <div class="bg-gradient-to-br from-{{ $color }}-50 to-{{ $color }}-25 rounded-2xl p-6">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-{{ $color }}-200 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-{{ $color }}-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $newsItem->author ?? 'ZowZow News Team' }}</div>
                                            <div class="text-sm text-gray-600">News Reporter</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <button class="bg-{{ $color }}-500 hover:bg-{{ $color }}-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105">
                                            Share News
                                        </button>
                                        <button class="bg-white hover:bg-{{ $color }}-50 text-{{ $color }}-700 border border-{{ $color }}-300 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105">
                                            Follow Updates
                                        </button>
                                        <button class="bg-white hover:bg-{{ $color }}-50 text-{{ $color }}-700 border border-{{ $color }}-300 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105">
                                            Related News
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- News Tags/Categories -->
                                @if($newsItem->category || $newsItem->slug)
                                    <div class="mt-4 pt-4 border-t border-{{ $color }}-200/50">
                                        <div class="flex flex-wrap gap-2">
                                            @if($newsItem->category)
                                                <span class="bg-{{ $color }}-100 text-{{ $color }}-700 px-3 py-1 rounded-full text-xs font-medium">
                                                    #{{ strtolower(str_replace(' ', '', $newsItem->category)) }}
                                                </span>
                                            @endif
                                            <span class="bg-{{ $color }}-100 text-{{ $color }}-700 px-3 py-1 rounded-full text-xs font-medium">
                                                #zowzow
                                            </span>
                                            <span class="bg-{{ $color }}-100 text-{{ $color }}-700 px-3 py-1 rounded-full text-xs font-medium">
                                                #veterinary
                                            </span>
                                            <span class="bg-{{ $color }}-100 text-{{ $color }}-700 px-3 py-1 rounded-full text-xs font-medium">
                                                #petcare
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

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
                indicator.classList.remove('bg-forest-moss-green-300');
                indicator.classList.add('bg-forest-moss-green-600');
            } else {
                indicator.classList.remove('bg-forest-moss-green-600');
                indicator.classList.add('bg-forest-moss-green-300');
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

// Modal functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
}

function closeModal(modalId) {
    if (modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    } else {
        // Close all modals if no specific ID provided
        const modals = document.querySelectorAll('[id^="modal-"]');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.classList.remove('overflow-hidden');
    }
}

// Make functions globally available
window.openModal = openModal;
window.closeModal = closeModal;

// Event listeners for modal
document.addEventListener('DOMContentLoaded', function() {
    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('backdrop-blur-md') && e.target.classList.contains('bg-white/10')) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
});
</script>
