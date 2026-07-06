{{-- Testimonials, Articles, News & Promo Section --}}
<section id="testimoni" class="relative py-24 overflow-hidden bg-gradient-to-b from-white via-vanilla-50/30 to-white">
    <!-- Animated Background Blobs -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-20 left-10 w-72 h-72 bg-forest-moss-green-100/40 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-chai-100/40 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-20 left-1/3 w-96 h-96 bg-soft-blush-pink-100/40 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob animation-delay-4000"></div>
        
        <!-- Floating Elements (Joyful Touch) -->
        <div class="absolute top-1/4 right-20 opacity-20 animate-float-slow text-forest-moss-green-300">
            <x-animal-icon name="cat" class="w-32 h-32 rotate-12" />
        </div>
        <div class="absolute bottom-1/3 left-10 opacity-20 animate-float-medium text-chai-300">
            <x-animal-icon name="dog" class="w-24 h-24 -rotate-12" />
        </div>
        <div class="absolute top-1/2 left-1/4 opacity-10 animate-float-fast text-soft-blush-pink-400">
            <x-animal-icon name="rabbit" class="w-20 h-20" />
        </div>
        <div class="absolute bottom-10 right-1/3 opacity-20 animate-float-slow text-old-mustard-yellow-400">
            <x-animal-icon name="bird" class="w-28 h-28 -rotate-6" />
        </div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 z-10">
        
        {{-- Navigation Tabs --}}
        <div class="flex justify-center mb-16 px-4">
            <div class="bg-white/80 backdrop-blur-md rounded-2xl md:rounded-full p-1.5 shadow-lg border border-white/50 flex flex-col md:flex-row w-full md:w-auto gap-2 md:gap-0">
                @foreach(['testimonials' => 'Stories', 'articles' => 'Tips & Tricks', 'news' => 'Clinic News', 'promo' => 'Hot Deals', 'faqs' => 'FAQs'] as $key => $label)
                    <button class="tab-btn px-6 py-3 rounded-xl md:rounded-full font-bold text-sm transition-all duration-300 relative overflow-hidden group {{ $loop->first ? 'active text-white shadow-md' : 'text-carob-600 hover:text-carob-800 bg-white md:bg-transparent' }} flex-1 md:flex-initial shadow-sm md:shadow-none" 
                            data-tab="{{ $key }}">
                        <span class="relative z-10 flex items-center justify-start md:justify-center gap-3 md:gap-2">
                            <span class="p-1.5 rounded-lg {{ $loop->first ? 'bg-white/20' : 'bg-soft-linen-100 group-hover:bg-white' }} transition-colors">
                                @if($key == 'testimonials') <i data-lucide="message-circle-heart" class="w-4 h-4"></i>
                                @elseif($key == 'articles') <i data-lucide="book-open" class="w-4 h-4"></i>
                                @elseif($key == 'news') <i data-lucide="newspaper" class="w-4 h-4"></i>
                                @elseif($key == 'promo') <i data-lucide="tag" class="w-4 h-4"></i>
                                @else <i data-lucide="help-circle" class="w-4 h-4"></i>
                                @endif
                            </span>
                            <span class="whitespace-nowrap">{{ $label }}</span>
                            
                            <!-- Mobile Arrow Indicator -->
                            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto md:hidden opacity-50"></i>
                        </span>
                        @if($loop->first)
                            <div class="absolute inset-0 tab-active-bg bg-gradient-to-r from-forest-moss-green-500 to-forest-moss-green-600"></div>
                        @else
                            <div class="absolute inset-0 bg-carob-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Testimonials Tab Content --}}
        <div id="testimonials-content" class="tab-content active transition-opacity duration-500">
            {{-- Header --}}
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-chai-50 text-chai-700 text-xs font-bold uppercase tracking-wider mb-6 border border-chai-100">
                <x-animal-icon name="bear" class="w-4 h-4 text-chai-600" />
                Trusted by 500+ Pet Parents
            </div>
                <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading leading-tight">
                    Happy Pets,<br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-forest-moss-green-600 to-chai-600">Happier Parents</span>
                </h2>
                <p class="text-lg text-carob-600 leading-relaxed">
                    Real stories from our community. Discover why Zow is the second home for so many furry friends.
                </p>
            </div>

            {{-- Community Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20">
                @foreach([
                    ['icon' => 'users', 'val' => '500+', 'label' => 'Happy Clients', 'color' => 'forest-moss-green'],
                    ['icon' => 'paw-print', 'val' => '1.2k+', 'label' => 'Pets Served', 'color' => 'chai'],
                    ['icon' => 'star', 'val' => '4.9', 'label' => 'Average Rating', 'color' => 'old-mustard-yellow'],
                    ['icon' => 'award', 'val' => '5+', 'label' => 'Years Caring', 'color' => 'soft-blush-pink']
                ] as $stat)
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition-transform duration-300">
                        <div class="w-12 h-12 mx-auto bg-{{ $stat['color'] }}-50 rounded-2xl flex items-center justify-center mb-4 text-{{ $stat['color'] }}-600">
                            <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <div class="text-3xl font-bold text-carob-900 mb-1">{{ $stat['val'] }}</div>
                        <div class="text-xs font-medium text-carob-500 uppercase tracking-wide">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Testimonials Animated Columns --}}
            @if($testimonials->count() > 0)
                @php
                    $testimonialColumns = [[], [], []];
                    foreach($testimonials as $i => $t) {
                        $testimonialColumns[$i % 3][] = ['item' => $t, 'index' => $i];
                    }
                    $columnDurations = [28, 34, 31];
                    $columnVisibility = ['', 'hidden md:block', 'hidden lg:block'];
                @endphp
                <div class="relative h-[600px] md:h-[760px] overflow-hidden">
                    {{-- Fade masks top & bottom --}}
                    <div class="pointer-events-none absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white to-transparent z-10"></div>
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-white to-transparent z-10"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 h-full">
                        @foreach($testimonialColumns as $colIndex => $colItems)
                            @continue(empty($colItems))
                            <div class="testimonial-column {{ $columnVisibility[$colIndex] ?? '' }} overflow-hidden">
                                <div class="testimonial-track flex flex-col gap-6 {{ $colIndex === 1 ? 'testimonial-track-reverse' : '' }}" style="--duration: {{ $columnDurations[$colIndex] ?? 30 }}s;">
                                    @for($rep = 0; $rep < 2; $rep++)
                                        @foreach($colItems as $entry)
                                            @php
                                                $testimonial = $entry['item'];
                                                $index = $entry['index'];
                                                $colors = ['bg-forest-moss-green-50', 'bg-chai-50', 'bg-soft-blush-pink-50', 'bg-white'];
                                                $bg = $colors[$index % 4];
                                                $border = $bg === 'bg-white' ? 'border-gray-100' : 'border-transparent';
                                            @endphp
                                            <div class="{{ $bg }} rounded-[2rem] p-8 shadow-sm border {{ $border }} hover:shadow-md transition-shadow duration-300" aria-hidden="{{ $rep === 1 ? 'true' : 'false' }}">
                                                <!-- Rating -->
                                                <div class="flex gap-1 mb-6">
                                                    @for($i = 0; $i < 5; $i++)
                                                        <i data-lucide="star" class="w-4 h-4 {{ $i < $testimonial->rating ? 'text-old-mustard-yellow-500 fill-current' : 'text-gray-200' }}"></i>
                                                    @endfor
                                                </div>

                                                <!-- Content -->
                                                <p class="text-carob-700 leading-relaxed mb-8 text-lg font-medium">
                                                    "{{ $testimonial->content }}"
                                                </p>

                                                <!-- User Info -->
                                                <div class="flex items-center gap-4">
                                                    <div class="relative">
                                                        @if($testimonial->avatar)
                                                            <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" loading="lazy" class="w-12 h-12 rounded-full object-cover ring-2 ring-white shadow-sm">
                                                        @else
                                                            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-carob-400 font-bold text-lg ring-2 ring-white shadow-sm">
                                                                {{ substr($testimonial->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                        <!-- Pet Badge -->
                                                        @if($testimonial->pet_type)
                                                            <div class="absolute -bottom-1 -right-1 bg-white rounded-full p-1 shadow-sm text-xs">
                                                                @if(strtolower($testimonial->pet_type) == 'dog') 🐶
                                                                @elseif(strtolower($testimonial->pet_type) == 'cat') 🐱
                                                                @else 🐾 @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h4 class="font-bold text-carob-900 text-sm">{{ $testimonial->name }}</h4>
                                                        <p class="text-xs text-carob-500">
                                                            @if($testimonial->pet_name)
                                                                Parent of <span class="text-forest-moss-green-600 font-medium">{{ $testimonial->pet_name }}</span>
                                                            @else
                                                                Pet Parent
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-3xl border border-dashed border-carob-200">
                    <div class="text-4xl mb-4">💬</div>
                    <p class="text-carob-600">No stories shared yet. Be the first!</p>
                </div>
            @endif

            {{-- Google Reviews --}}
            @if(!empty($googleReviews['reviews']))
                <div class="mt-20">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-8">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            <div>
                                <h3 class="text-xl font-bold text-carob-900">Google Reviews</h3>
                                @if($googleReviews['rating'])
                                    <p class="text-sm text-carob-500">
                                        <span class="font-bold text-carob-800">{{ $googleReviews['rating'] }}</span> ★ from {{ $googleReviews['user_ratings_total'] }} reviews
                                    </p>
                                @endif
                            </div>
                        </div>
                        @if($googleReviews['url'])
                            <a href="{{ $googleReviews['url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-bold text-forest-moss-green-600 hover:text-forest-moss-green-700 transition-colors">
                                See all reviews on Google
                                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($googleReviews['reviews'] as $review)
                            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 flex flex-col h-full">
                                <div class="flex gap-1 mb-4">
                                    @for($i = 0; $i < 5; $i++)
                                        <i data-lucide="star" class="w-4 h-4 {{ $i < $review['rating'] ? 'text-old-mustard-yellow-500 fill-current' : 'text-gray-200' }}"></i>
                                    @endfor
                                </div>
                                <p class="google-review-text text-carob-700 leading-relaxed text-sm line-clamp-5">
                                    "{{ $review['text'] }}"
                                </p>
                                <button type="button" class="google-review-toggle hidden text-xs font-bold text-forest-moss-green-600 hover:text-forest-moss-green-700 mt-2 text-left" onclick="toggleGoogleReview(this)">
                                    Baca selengkapnya
                                </button>
                                <div class="flex items-center gap-3 mt-auto pt-6">
                                    @if($review['profile_photo_url'])
                                        <img src="{{ $review['profile_photo_url'] }}" alt="{{ $review['author_name'] }}" loading="lazy" class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow-sm" referrerpolicy="no-referrer">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-soft-linen-100 flex items-center justify-center text-carob-400 font-bold ring-2 ring-white shadow-sm">
                                            {{ substr($review['author_name'], 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="font-bold text-carob-900 text-sm">{{ $review['author_name'] }}</h4>
                                        <p class="text-xs text-carob-400">{{ $review['relative_time_description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Articles Tab Content --}}
        <div id="articles-content" class="tab-content hidden transition-opacity duration-500">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-soft-blush-pink-50 text-soft-blush-pink-700 text-xs font-bold uppercase tracking-wider mb-6 border border-soft-blush-pink-100">
                    <span>💡</span> Expert Knowledge
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading">
                    Pet Care <span class="italic text-soft-blush-pink-600">Wisdom</span>
                </h2>
                <p class="text-lg text-carob-600 leading-relaxed">
                    Tips, tricks, and deep dives into pet health from our veterinary experts.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <article class="group bg-white rounded-[2rem] overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                        <!-- Image -->
                        <div class="relative h-56 overflow-hidden">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-soft-linen-100 flex items-center justify-center text-soft-linen-400">
                                    <i data-lucide="image" class="w-12 h-12"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 backdrop-blur-md text-carob-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                    {{ $article->tags[0] ?? 'General' }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 text-xs font-medium text-carob-400 mb-4">
                                <i data-lucide="calendar" class="w-3 h-3"></i>
                                {{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}
                                <span class="w-1 h-1 bg-carob-300 rounded-full"></span>
                                <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read</span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-carob-900 mb-3 leading-tight group-hover:text-forest-moss-green-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                            
                            <p class="text-carob-600 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                                {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            
                            <a href="#" onclick="openModal('modal-article-{{ $article->id }}')" 
                               class="inline-flex items-center text-sm font-bold text-forest-moss-green-600 hover:text-forest-moss-green-700 transition-colors group/link">
                                Read Article 
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-carob-500">No articles available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- News Tab Content --}}
        <div id="news-content" class="tab-content hidden transition-opacity duration-500">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading">Clinic Updates</h2>
                <p class="text-lg text-carob-600">What's happening at Zow.</p>
            </div>
            
            <div class="max-w-4xl mx-auto space-y-6">
                @forelse($news as $newsItem)
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border-y border-r border-gray-100 border-l-4 border-l-chai-400 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col md:flex-row gap-8 items-start group">
                        <!-- Date Box -->
                        <div class="hidden md:flex flex-col items-center justify-center bg-soft-linen-50 rounded-2xl w-20 h-20 flex-shrink-0 text-carob-800 border border-soft-linen-100">
                            <span class="text-xs font-bold uppercase">{{ $newsItem->created_at->format('M') }}</span>
                            <span class="text-2xl font-bold">{{ $newsItem->created_at->format('d') }}</span>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                @if($newsItem->is_breaking)
                                    <span class="bg-red-50 text-red-600 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wide flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span> Breaking
                                    </span>
                                @endif
                                <span class="text-xs font-medium text-carob-400 md:hidden">{{ $newsItem->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-carob-900 mb-3 group-hover:text-forest-moss-green-600 transition-colors">
                                {{ $newsItem->title }}
                            </h3>
                            <p class="text-carob-600 text-sm leading-relaxed mb-4">
                                {{ $newsItem->excerpt ?: Str::limit(strip_tags($newsItem->content), 150) }}
                            </p>
                            <button onclick="openModal('modal-news-{{ $newsItem->id }}')" class="text-sm font-bold text-chai-600 hover:text-chai-700 underline decoration-2 decoration-chai-200 hover:decoration-chai-500 underline-offset-4 transition-all">
                                Read Update
                            </button>
                        </div>
                        
                        @if($newsItem->featured_image)
                            <div class="w-full md:w-32 h-32 rounded-2xl overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/' . $newsItem->featured_image) }}" alt="{{ $newsItem->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-12 text-carob-500">No news yet.</div>
                @endforelse
            </div>
        </div>

        {{-- Promo Tab Content --}}
        <div id="promo-content" class="tab-content hidden transition-opacity duration-500">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading">Hot Deals</h2>
                <p class="text-lg text-carob-600">Exclusive offers for our beloved community.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                @forelse($promos as $promo)
                    <div class="relative bg-white rounded-[2.5rem] overflow-hidden shadow-xl border border-gray-100 group hover:-translate-y-1 transition-all duration-300">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-5 pointer-events-none bg-[radial-gradient(#364E2C_1px,transparent_1px)] [background-size:16px_16px]"></div>
                        
                        <div class="flex flex-col md:flex-row h-full">
                            <!-- Left: Image & Discount -->
                            <div class="md:w-2/5 relative h-48 md:h-auto overflow-hidden">
                                @if($promo->featured_image)
                                    <img src="{{ asset('storage/' . $promo->featured_image) }}" alt="{{ $promo->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-forest-moss-green-50"></div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent md:bg-gradient-to-r"></div>
                                
                                <div class="absolute bottom-6 left-6 text-white">
                                    <div class="text-xs font-bold uppercase tracking-wider opacity-80 mb-1">Save Up To</div>
                                    <div class="text-4xl font-extrabold tracking-tight">
                                        @if($promo->discount_type === 'percentage')
                                            {{ $promo->discount_value }}%
                                        @else
                                            Rp{{ number_format($promo->discount_value / 1000, 0) }}k
                                        @endif
                                    </div>
                                    <div class="text-sm font-bold opacity-90">OFF</div>
                                </div>
                            </div>
                            
                            <!-- Right: Details -->
                            <div class="p-8 md:w-3/5 flex flex-col justify-center relative z-10">
                                <h3 class="text-2xl font-bold text-carob-900 mb-3 leading-tight">{{ $promo->title }}</h3>
                                <p class="text-carob-600 text-sm mb-6 flex-1">{{ $promo->description }}</p>
                                
                                <div class="bg-soft-linen-50 border-2 border-dashed border-soft-linen-200 rounded-xl p-4 flex items-center justify-between mb-4">
                                    <div class="text-xs font-bold text-carob-400 uppercase tracking-wide">Code</div>
                                    <div class="font-mono font-bold text-lg text-carob-800 tracking-wider select-all">{{ $promo->promo_code }}</div>
                                    <button class="text-carob-400 hover:text-forest-moss-green-600 transition-colors" title="Copy">
                                        <i data-lucide="copy" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                
                                <div class="flex items-center justify-between text-xs font-medium text-carob-400">
                                    <div class="flex items-center gap-1.5">
                                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                        Ends {{ \Carbon\Carbon::parse($promo->end_date)->format('M d') }}
                                    </div>
                                    @if($promo->usage_limit)
                                        <div class="text-orange-500">{{ $promo->usage_limit - $promo->used_count }} left</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-carob-500">No active promos right now. Check back later!</div>
                @endforelse
            </div>
        </div>
        
        {{-- FAQs Tab Content --}}
        <div id="faqs-content" class="tab-content hidden transition-opacity duration-500">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading">Frequently Asked Questions</h2>
                <p class="text-lg text-carob-600">Common questions about our services and care.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                @forelse($faqs as $faq)
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm group">
                        <button class="faq-btn w-full px-6 py-5 text-left flex items-center justify-between gap-4 bg-white hover:bg-soft-linen-50 transition-colors" onclick="toggleFaq(this)">
                            <span class="font-bold text-lg text-carob-900">{{ $faq->question }}</span>
                            <span class="w-8 h-8 rounded-full bg-soft-linen-100 flex items-center justify-center text-carob-500 transition-transform duration-300 group-[.active]:rotate-180">
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </span>
                        </button>
                        <div class="faq-content hidden px-6 pb-6 text-carob-600 leading-relaxed border-t border-dashed border-gray-100 bg-soft-linen-50/30 transition-all duration-300 ease-in-out overflow-hidden" style="max-height: 0; opacity: 0;">
                            <div class="pt-4 article-content">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-carob-500">No FAQs available yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@if($faqs->count() > 0)
    @push('json-ld')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "FAQPage",
        "mainEntity": [
            @foreach($faqs as $faq)
            {
                "@@type": "Question",
                "name": {!! json_encode(strip_tags($faq->question)) !!},
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": {!! json_encode(strip_tags($faq->answer)) !!}
                }
            }@if(!$loop->last),@endif
            @endforeach
        ]
    }
    </script>
    @endpush
@endif

<!-- Modals (Header, Body, Footer Layout - Joyful Edition) -->
@foreach(['article' => $articles, 'news' => $news] as $type => $items)
    @if(isset($items) && $items->count() > 0)
        @foreach($items as $item)
            <div id="modal-{{ $type }}-{{ $item->id }}" class="fixed inset-0 bg-carob-900/80 backdrop-blur-md hidden z-50 transition-opacity duration-300 flex items-center justify-center p-4">
                
                <!-- Modal Container -->
                <div class="bg-white rounded-[2.5rem] max-w-3xl w-full max-h-[90vh] shadow-2xl relative animate-scale-in flex flex-col overflow-hidden border-4 border-white ring-1 ring-gray-200">
                    
                    <!-- Header -->
                    <div class="relative bg-gradient-to-r from-soft-linen-50 to-vanilla-50 p-6 md:p-8 shrink-0 border-b border-gray-100 flex items-start justify-between gap-4 overflow-hidden">
                        <!-- Decorative Header Blobs -->
                        <div class="absolute -top-10 -left-10 w-32 h-32 bg-forest-moss-green-200/20 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="absolute top-0 right-0 w-40 h-40 bg-chai-200/20 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="relative z-10 flex-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-gray-100 shadow-sm text-xs font-bold uppercase tracking-wider text-forest-moss-green-600 mb-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-forest-moss-green-500 animate-pulse"></span>
                                {{ $item->category ?? ucfirst($type) }}
                            </span>
                            <h2 class="text-2xl md:text-3xl font-bold text-carob-900 font-heading leading-tight line-clamp-2">
                                {{ $item->title }}
                            </h2>
                        </div>

                        <!-- Close Button -->
                        <button onclick="closeModal('modal-{{ $type }}-{{ $item->id }}')" class="relative z-10 w-10 h-10 bg-white hover:bg-red-50 text-carob-400 hover:text-red-500 rounded-full flex items-center justify-center transition-all duration-300 shadow-sm border border-gray-100 group flex-shrink-0">
                            <i data-lucide="x" class="w-5 h-5 group-hover:rotate-90 transition-transform"></i>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="flex-1 overflow-y-auto custom-scrollbar p-6 md:p-8 bg-white relative">
                        
                        <!-- Meta Info Bar -->
                        <div class="flex flex-wrap items-center gap-4 md:gap-6 mb-8 text-sm text-carob-500 pb-6 border-b border-dashed border-gray-200">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-soft-linen-100 flex items-center justify-center text-carob-600">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                </div>
                                <span class="font-medium">{{ $item->author ?? 'Zow Team' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-soft-linen-100 flex items-center justify-center text-carob-600">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <span class="font-medium">{{ $item->created_at->format('d F Y') }}</span>
                            </div>
                            @if(isset($item->views))
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-soft-linen-100 flex items-center justify-center text-carob-600">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </div>
                                    <span class="font-medium" id="views-count-{{ $type }}-{{ $item->id }}">{{ $item->views }} views</span>
                                </div>
                            @endif
                        </div>

                        <!-- Featured Image -->
                        @if($item->featured_image)
                            <div class="rounded-[2rem] overflow-hidden shadow-md mb-8 ring-4 ring-soft-linen-50">
                                <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" loading="lazy" class="w-full h-auto object-cover max-h-[400px]">
                            </div>
                        @endif

                        <!-- Article Content -->
                        <div class="article-content text-carob-700 leading-relaxed">
                            {!! $item->content !!}
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-soft-linen-50/50 p-4 md:px-8 border-t border-gray-100 shrink-0 flex flex-col md:flex-row items-center justify-between gap-4 backdrop-blur-sm">
                        <div class="text-xs font-bold text-carob-400 uppercase tracking-wider">
                            Share Joy
                        </div>
                        <div class="flex gap-3"
                             data-share-url="{{ url('/') }}/#modal-{{ $type }}-{{ $item->id }}"
                             data-share-title="{{ $item->title }}">
                            <!-- Facebook -->
                            <button type="button" onclick="shareToFacebook(this)" class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-100 text-carob-600 text-xs font-bold hover:bg-[#1877F2] hover:text-white hover:border-transparent transition-all shadow-sm group">
                                <img src="https://cdn.simpleicons.org/facebook/currentColor"
                                    alt="Facebook"
                                    class="w-3.5 h-3.5 group-hover:scale-110 transition-transform">
                                Facebook
                            </button>

                            <!-- X (Twitter) -->
                            <button type="button" onclick="shareToX(this)" class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-100 text-carob-600 text-xs font-bold hover:bg-black hover:text-white hover:border-transparent transition-all shadow-sm group">
                                <img src="https://cdn.simpleicons.org/x/currentColor"
                                    alt="X"
                                    class="w-3.5 h-3.5 group-hover:scale-110 transition-transform">
                                X
                            </button>

                            <!-- Copy Link -->
                            <button type="button" onclick="copyShareLink(this)" class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-100 text-carob-600 text-xs font-bold hover:bg-forest-moss-green-500 hover:text-white hover:border-transparent transition-all shadow-sm group">
                                <i data-lucide="link" class="w-3.5 h-3.5 group-hover:scale-110 transition-transform"></i>
                                <span class="copy-link-label">Copy Link</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    @endif
@endforeach

<script>
function toggleGoogleReview(button) {
    const text = button.previousElementSibling;
    const expanded = text.classList.toggle('line-clamp-5');
    text.classList.toggle('line-clamp-none');
    button.textContent = expanded ? 'Baca selengkapnya' : 'Sembunyikan';
}

document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Show "Baca selengkapnya" only for Google review texts that are actually truncated
    document.querySelectorAll('.google-review-text').forEach(function (el) {
        if (el.scrollHeight > el.clientHeight + 1) {
            const toggle = el.nextElementSibling;
            if (toggle && toggle.classList.contains('google-review-toggle')) {
                toggle.classList.remove('hidden');
            }
        }
    });

    const tabs = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');
    const bgColors = {
        'testimonials': 'bg-gradient-to-r from-forest-moss-green-500 to-forest-moss-green-600',
        'articles': 'bg-gradient-to-r from-soft-blush-pink-500 to-soft-blush-pink-600',
        'news': 'bg-gradient-to-r from-chai-500 to-chai-600',
        'promo': 'bg-gradient-to-r from-old-mustard-yellow-500 to-old-mustard-yellow-600',
        'faqs': 'bg-carob-600'
    };

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Deactivate all
            tabs.forEach(t => {
                t.classList.remove('active', 'text-white', 'shadow-md');
                t.classList.add('text-carob-600', 'bg-white', 'md:bg-transparent');
                
                // Reset icon bg
                // Use attribute selector instead of class selector with dots
                const iconSpan = t.querySelector('span[class*="p-1.5"]');
                if(iconSpan) {
                    iconSpan.classList.remove('bg-white/20');
                    iconSpan.classList.add('bg-soft-linen-100');
                }

                const bg = t.querySelector('.tab-active-bg') || t.querySelector('.absolute.inset-0.bg-gradient-to-r');
                if(bg) bg.remove();
            });
            
            contents.forEach(c => {
                c.classList.add('hidden', 'opacity-0');
                c.classList.remove('active', 'opacity-100');
            });

            // Activate clicked
            tab.classList.add('active', 'text-white', 'shadow-md');
            tab.classList.remove('text-carob-600', 'bg-white', 'md:bg-transparent');
            
            // Active icon bg
            const activeIconSpan = tab.querySelector('span[class*="p-1.5"]');
            if(activeIconSpan) {
                activeIconSpan.classList.remove('bg-soft-linen-100');
                activeIconSpan.classList.add('bg-white/20');
            }

            // Add bg
            const tabName = tab.dataset.tab;
            const bgDiv = document.createElement('div');
            bgDiv.className = `absolute inset-0 tab-active-bg ${bgColors[tabName]}`;
            // Insert as first child to be behind text
            tab.insertBefore(bgDiv, tab.firstChild);

            // Show content
            const target = document.getElementById(`${tabName}-content`);
            target.classList.remove('hidden');
            // Small delay for fade in
            setTimeout(() => {
                target.classList.add('active', 'opacity-100');
            }, 10);
        });
    });
});

// Modal Logic
function openModal(id) {
    const modal = document.getElementById(id);
    if(modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        trackModalView(id);
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if(modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Views Counter
function trackModalView(modalId) {
    const match = modalId.match(/^modal-(article|news)-(\d+)$/);
    if (!match) return;

    const [, type, contentId] = match;
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!token) return;

    fetch(`/content/${type}/${contentId}/view`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
        },
    })
        .then(response => response.ok ? response.json() : null)
        .then(data => {
            if (!data) return;
            const counter = document.getElementById(`views-count-${type}-${contentId}`);
            if (counter) {
                counter.textContent = `${data.views} views`;
            }
        })
        .catch(() => {});
}

// Share Logic
function getShareContext(el) {
    const container = el.closest('[data-share-url]');
    return {
        url: container?.dataset.shareUrl || window.location.href,
        title: container?.dataset.shareTitle || document.title,
    };
}

function shareToFacebook(el) {
    const { url } = getShareContext(el);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank', 'noopener,noreferrer,width=600,height=500');
}

function shareToX(el) {
    const { url, title } = getShareContext(el);
    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`, '_blank', 'noopener,noreferrer,width=600,height=500');
}

function copyShareLink(el) {
    const { url } = getShareContext(el);
    const button = el.closest('button');
    const label = button.querySelector('.copy-link-label');
    if (!label) return;

    const originalLabel = label.textContent;
    const showCopied = () => {
        label.textContent = 'Copied!';
        setTimeout(() => { label.textContent = originalLabel; }, 2000);
    };

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(showCopied).catch(() => fallbackCopyText(url, showCopied));
    } else {
        fallbackCopyText(url, showCopied);
    }
}

function fallbackCopyText(text, onDone) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();
    try { document.execCommand('copy'); } catch (e) {}
    document.body.removeChild(textarea);
    onDone();
}

// Open shared modal directly from URL hash, e.g. #modal-article-12
document.addEventListener('DOMContentLoaded', function () {
    const hash = window.location.hash.slice(1);
    const match = hash.match(/^modal-(article|news)-(\d+)$/);
    if (!match || !document.getElementById(hash)) return;

    const tabName = match[1] === 'article' ? 'articles' : 'news';
    const tabButton = document.querySelector(`.tab-btn[data-tab="${tabName}"]`);
    if (tabButton) tabButton.click();

    openModal(hash);
});

// FAQ Logic
function toggleFaq(button) {
    const container = button.parentElement;
    const content = container.querySelector('.faq-content');
    const isHidden = content.classList.contains('hidden');
    
    // Close all others
    document.querySelectorAll('.faq-btn').forEach(btn => {
        if(btn !== button) {
            const otherContainer = btn.parentElement;
            if(otherContainer.classList.contains('active')) {
                otherContainer.classList.remove('active');
                const otherContent = otherContainer.querySelector('.faq-content');
                otherContent.style.maxHeight = '0px';
                otherContent.style.opacity = '0';
                setTimeout(() => {
                    otherContent.classList.add('hidden');
                }, 300);
            }
        }
    });

    if(isHidden) {
        // Open
        container.classList.add('active');
        content.classList.remove('hidden');
        // Force reflow
        void content.offsetWidth; 
        
        content.style.maxHeight = content.scrollHeight + 'px';
        content.style.opacity = '1';
    } else {
        // Close
        container.classList.remove('active');
        content.style.maxHeight = '0px';
        content.style.opacity = '0';
        
        setTimeout(() => {
            content.classList.add('hidden');
        }, 300);
    }
}
</script>

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    .font-heading {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    
    .prose p {
        margin-bottom: 1.5em;
        line-height: 1.8;
    }

    @keyframes float-slow {
        0%, 100% { transform: translateY(0) rotate(12deg); }
        50% { transform: translateY(-20px) rotate(15deg); }
    }
    @keyframes float-medium {
        0%, 100% { transform: translateY(0) rotate(-12deg); }
        50% { transform: translateY(-15px) rotate(-8deg); }
    }
    @keyframes float-fast {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-10px) scale(1.1); }
    }
    .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
    .animate-float-medium { animation: float-medium 6s ease-in-out infinite; }
    .animate-float-fast { animation: float-fast 4s ease-in-out infinite; }

    /* Testimonials Infinite Scroll Columns */
    @keyframes testimonial-scroll {
        from { transform: translateY(0); }
        to { transform: translateY(-50%); }
    }
    .testimonial-track {
        animation: testimonial-scroll var(--duration, 30s) linear infinite;
        will-change: transform;
    }
    .testimonial-track-reverse {
        animation-direction: reverse;
    }
    .testimonial-column:hover .testimonial-track {
        animation-play-state: paused;
    }
    @media (prefers-reduced-motion: reduce) {
        .testimonial-track {
            animation: none;
        }
    }

    /* Article Content Styling */
    .article-content p {
        margin-bottom: 1.25em;
        line-height: 1.8;
    }
    .article-content ul {
        list-style-type: disc;
        padding-left: 1.5em;
        margin-bottom: 1.25em;
    }
    .article-content ol {
        list-style-type: decimal;
        padding-left: 1.5em;
        margin-bottom: 1.25em;
    }
    .article-content li {
        margin-bottom: 0.5em;
        padding-left: 0.5em;
    }
    .article-content li::marker {
        color: var(--color-forest-moss-green-500);
        font-weight: bold;
    }
    .article-content h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-carob-900);
        margin-top: 2em;
        margin-bottom: 1em;
    }
    .article-content h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--color-carob-800);
        margin-top: 1.5em;
        margin-bottom: 0.75em;
    }
    .article-content strong {
        color: var(--color-carob-900);
        font-weight: 700;
    }
    
    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #d2ab80; /* chai-500 */
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #bd9a73; /* chai-600 */
    }
</style>
