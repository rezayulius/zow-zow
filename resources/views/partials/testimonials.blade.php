{{-- Testimonials, Articles, News & Promo Section --}}
<section id="testimoni" class="relative py-24 overflow-hidden bg-gradient-to-b from-soft-linen-50 via-chai-50/20 to-soft-linen-50">
    <!-- Top wave: seams the white(Membership) -> soft-linen-50(Testimonials) color change -->
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
        <svg class="relative block w-[calc(100%+1.3px)] h-[50px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-soft-linen-50"></path>
        </svg>
    </div>

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
                @foreach(__('testimonials.tabs') as $key => $label)
                    <button class="tab-btn px-6 py-3 rounded-xl md:rounded-full font-bold text-sm transition-all duration-300 relative overflow-hidden group {{ $loop->first ? 'active text-white shadow-md' : 'text-carob-600 hover:text-carob-800 bg-white md:bg-transparent' }} flex-1 md:flex-initial shadow-sm md:shadow-none" 
                            data-tab="{{ $key }}">
                        <span class="relative z-10 flex items-center justify-start md:justify-center gap-3 md:gap-2">
                            <span class="p-1.5 rounded-lg {{ $loop->first ? 'bg-white/20' : 'bg-soft-linen-100 group-hover:bg-white' }} transition-colors">
                                @if($key == 'testimonials') <i data-lucide="message-circle-heart" class="w-4 h-4"></i>
                                @elseif($key == 'articles') <i data-lucide="book-open" class="w-4 h-4"></i>
                                @elseif($key == 'news') <i data-lucide="newspaper" class="w-4 h-4"></i>
                                @elseif($key == 'promo') <i data-lucide="tag" class="w-4 h-4"></i>
                                @else <i data-lucide="circle-help" class="w-4 h-4"></i>
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
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-chai-50 text-chai-800 text-xs font-bold uppercase tracking-wider mb-6 border border-chai-100">
                <x-animal-icon name="bear" class="w-4 h-4 text-chai-600" />
                {{ __('testimonials.stories.trusted_badge') }}
            </div>
                <h2 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading leading-tight">
                    {{ __('testimonials.stories.title_line1') }}<br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-forest-moss-green-600 to-chai-600">{{ __('testimonials.stories.title_line2') }}</span>
                </h2>
                <p class="text-lg text-carob-600 leading-relaxed">
                    {{ __('testimonials.stories.subtitle') }}
                </p>
            </div>

            {{-- Community Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20">
                {{-- icon_classes are written out in full so Tailwind's scanner can see them —
                     a runtime-built "bg-{$color}-50" string never matches a real utility class
                     and would silently disappear from the production build. --}}
                @foreach([
                    ['icon' => 'users', 'val' => '500+', 'label' => __('testimonials.stories.stats.happy_clients'), 'icon_classes' => 'bg-forest-moss-green-50 text-forest-moss-green-600'],
                    ['icon' => 'paw-print', 'val' => '1.2k+', 'label' => __('testimonials.stories.stats.pets_served'), 'icon_classes' => 'bg-chai-50 text-chai-600'],
                    ['icon' => 'star', 'val' => '4.9', 'label' => __('testimonials.stories.stats.average_rating'), 'icon_classes' => 'bg-old-mustard-yellow-50 text-old-mustard-yellow-600'],
                    ['icon' => 'award', 'val' => '5+', 'label' => __('testimonials.stories.stats.years_caring'), 'icon_classes' => 'bg-soft-blush-pink-50 text-soft-blush-pink-600'],
                ] as $stat)
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition-transform duration-300">
                        <div class="w-12 h-12 mx-auto {{ $stat['icon_classes'] }} rounded-2xl flex items-center justify-center mb-4">
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
                    <div class="pointer-events-none absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-soft-linen-50 to-transparent z-10"></div>
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-soft-linen-50 to-transparent z-10"></div>

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
                                                            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-carob-500 font-bold text-lg ring-2 ring-white shadow-sm">
                                                                {{ mb_substr($testimonial->name, 0, 1) }}
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
                                                        <h3 class="font-bold text-carob-900 text-sm">{{ $testimonial->name }}</h3>
                                                        <p class="text-xs text-carob-500">
                                                            @if($testimonial->pet_name)
                                                                {{ __('testimonials.stories.parent_of') }} <span class="text-forest-moss-green-600 font-medium">{{ $testimonial->pet_name }}</span>
                                                            @else
                                                                {{ __('testimonials.stories.pet_parent') }}
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
                    <p class="text-carob-600">{{ __('testimonials.stories.empty') }}</p>
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
                                <h3 class="text-xl font-bold text-carob-900">{{ __('testimonials.stories.google_reviews') }}</h3>
                                @if($googleReviews['rating'])
                                    <p class="text-sm text-carob-500">
                                        <span class="font-bold text-carob-800">{{ $googleReviews['rating'] }}</span> {{ __('testimonials.stories.rating_from_reviews', ['total' => $googleReviews['user_ratings_total']]) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        @if($googleReviews['url'])
                            <a href="{{ $googleReviews['url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-bold text-forest-moss-green-600 hover:text-forest-moss-green-700 transition-colors">
                                {{ __('testimonials.stories.see_all_on_google') }}
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
                                <button type="button" class="google-review-toggle hidden text-xs font-bold text-forest-moss-green-600 hover:text-forest-moss-green-700 mt-2 text-left" data-action="toggle-google-review" data-more-text="{{ __('testimonials.stories.read_more') }}" data-less-text="{{ __('testimonials.stories.show_less') }}">
                                    {{ __('testimonials.stories.read_more') }}
                                </button>
                                <div class="flex items-center gap-3 mt-auto pt-6">
                                    @if($review['profile_photo_url'])
                                        <img src="{{ $review['profile_photo_url'] }}" alt="{{ $review['author_name'] }}" loading="lazy" class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow-sm" referrerpolicy="no-referrer">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-soft-linen-100 flex items-center justify-center text-carob-500 font-bold ring-2 ring-white shadow-sm">
                                            {{ mb_substr($review['author_name'], 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="font-bold text-carob-900 text-sm">{{ $review['author_name'] }}</h4>
                                        <p class="text-xs text-carob-500">{{ $review['relative_time_description'] }}</p>
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
                    <span>💡</span> {{ __('testimonials.articles.badge') }}
                </div>
                <h3 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading">
                    {!! __('testimonials.articles.title') !!}
                </h3>
                <p class="text-lg text-carob-600 leading-relaxed">
                    {{ __('testimonials.articles.subtitle') }}
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
                                    {{ $article->tags[0] ?? __('testimonials.articles.default_category') }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 text-xs font-medium text-carob-500 mb-4">
                                <i data-lucide="calendar" class="w-3 h-3"></i>
                                {{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}
                                <span class="w-1 h-1 bg-carob-300 rounded-full"></span>
                                <span>{{ __('testimonials.articles.min_read', ['count' => $article->reading_time]) }}</span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-carob-900 mb-3 leading-tight group-hover:text-forest-moss-green-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                            
                            <p class="text-carob-600 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                                {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            
                            <a href="{{ route('articles.show', $article) }}" wire:navigate
                               class="inline-flex items-center text-sm font-bold text-forest-moss-green-600 hover:text-forest-moss-green-700 transition-colors group/link">
                                {{ __('testimonials.articles.read_article') }}
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-carob-500">{{ __('testimonials.articles.empty') }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- News Tab Content --}}
        <div id="news-content" class="tab-content hidden transition-opacity duration-500">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h3 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading">{{ __('testimonials.news.title') }}</h3>
                <p class="text-lg text-carob-600">{{ __('testimonials.news.subtitle') }}</p>
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
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span> {{ __('testimonials.news.breaking') }}
                                    </span>
                                @endif
                                <span class="text-xs font-medium text-carob-500 md:hidden">{{ $newsItem->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-carob-900 mb-3 group-hover:text-forest-moss-green-600 transition-colors">
                                {{ $newsItem->title }}
                            </h3>
                            <p class="text-carob-600 text-sm leading-relaxed mb-4">
                                {{ $newsItem->excerpt ?: Str::limit(strip_tags($newsItem->content), 150) }}
                            </p>
                            <button type="button" data-action="open-modal" data-modal-id="modal-news-{{ $newsItem->id }}" class="text-sm font-bold text-chai-800 hover:text-chai-900 underline decoration-2 decoration-chai-200 hover:decoration-chai-500 underline-offset-4 transition-all">
                                {{ __('testimonials.news.read_update') }}
                            </button>
                        </div>

                        @if($newsItem->featured_image)
                            <div class="w-full md:w-32 h-32 rounded-2xl overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/' . $newsItem->featured_image) }}" alt="{{ $newsItem->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-12 text-carob-500">{{ __('testimonials.news.empty') }}</div>
                @endforelse
            </div>
        </div>

        {{-- Promo Tab Content --}}
        <div id="promo-content" class="tab-content hidden transition-opacity duration-500">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h3 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading">{{ __('testimonials.promo.title') }}</h3>
                <p class="text-lg text-carob-600">{{ __('testimonials.promo.subtitle') }}</p>
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
                                    <div class="text-xs font-bold uppercase tracking-wider opacity-80 mb-1">{{ __('testimonials.promo.save_up_to') }}</div>
                                    <div class="text-4xl font-extrabold tracking-tight">
                                        @if($promo->discount_type === 'percentage')
                                            {{ $promo->discount_value }}%
                                        @else
                                            Rp{{ number_format($promo->discount_value / 1000, 0) }}k
                                        @endif
                                    </div>
                                    <div class="text-sm font-bold opacity-90">{{ __('testimonials.promo.off') }}</div>
                                </div>
                            </div>
                            
                            <!-- Right: Details -->
                            <div class="p-8 md:w-3/5 flex flex-col justify-center relative z-10">
                                <h3 class="text-2xl font-bold text-carob-900 mb-3 leading-tight">{{ $promo->title }}</h3>
                                <p class="text-carob-600 text-sm mb-6 flex-1">{{ $promo->description }}</p>
                                
                                <div class="bg-soft-linen-50 border-2 border-dashed border-soft-linen-200 rounded-xl p-4 flex items-center justify-between mb-4">
                                    <div class="text-xs font-bold text-carob-500 uppercase tracking-wide">{{ __('testimonials.promo.code') }}</div>
                                    <div class="font-mono font-bold text-lg text-carob-800 tracking-wider select-all">{{ $promo->promo_code }}</div>
                                    <button type="button" data-action="copy-promo-code" data-promo-code="{{ $promo->promo_code }}" class="text-carob-500 hover:text-forest-moss-green-600 transition-colors" title="{{ __('testimonials.promo.copy_code') }}">
                                        <i data-lucide="copy" class="w-4 h-4"></i>
                                    </button>
                                </div>

                                <div class="flex items-center justify-between text-xs font-medium text-carob-500">
                                    <div class="flex items-center gap-1.5">
                                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                        {{ __('testimonials.promo.ends', ['date' => $promo->end_date->format('M d')]) }}
                                    </div>
                                    @if($promo->usage_limit)
                                        <div class="text-orange-500">{{ __('testimonials.promo.left', ['count' => $promo->usage_limit - $promo->used_count]) }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-carob-500">{{ __('testimonials.promo.empty') }}</div>
                @endforelse
            </div>
        </div>
        
        {{-- FAQs Tab Content --}}
        <div id="faqs-content" class="tab-content hidden transition-opacity duration-500">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h3 class="text-4xl md:text-5xl font-bold text-carob-900 mb-6 font-heading">{{ __('testimonials.faqs.title') }}</h3>
                <p class="text-lg text-carob-600">{{ __('testimonials.faqs.subtitle') }}</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                @forelse($faqs as $faq)
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm group">
                        <button type="button" class="faq-btn w-full px-6 py-5 text-left flex items-center justify-between gap-4 bg-white hover:bg-soft-linen-50 transition-colors">
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
                    <div class="text-center py-12 text-carob-500">{{ __('testimonials.faqs.empty') }}</div>
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

{{-- Articles now have their own canonical page (routes/web.php: articles.show)
     and navigate there directly instead of opening a modal, so only News still
     uses the modal below. --}}
<!-- Modals (Header, Body, Footer Layout - Joyful Edition) -->
{{-- Each modal's content lives inside a <template>: templates are inert (no
     layout, no image/network requests, no script execution) until their
     content is cloned into the live DOM, so the browser never pays to
     parse or paint the hidden modals below unless a visitor actually opens one. --}}
@foreach(['news' => $news] as $type => $items)
    @if(isset($items) && $items->count() > 0)
        @foreach($items as $item)
            <div id="modal-{{ $type }}-{{ $item->id }}" data-modal class="fixed inset-0 bg-carob-900/80 backdrop-blur-md hidden z-50 transition-opacity duration-300 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="modal-{{ $type }}-{{ $item->id }}-title">
                <template>
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
                                <h3 id="modal-{{ $type }}-{{ $item->id }}-title" class="text-2xl md:text-3xl font-bold text-carob-900 font-heading leading-tight line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                            </div>

                            <!-- Close Button -->
                            <button type="button" data-action="close-modal" class="relative z-10 w-10 h-10 bg-white hover:bg-red-50 text-carob-500 hover:text-red-500 rounded-full flex items-center justify-center transition-all duration-300 shadow-sm border border-gray-100 group flex-shrink-0" aria-label="{{ __('testimonials.modal.close') }}">
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
                                    <span class="font-medium">{{ $item->author ?? __('testimonials.modal.default_author') }}</span>
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
                                        <span class="font-medium" id="views-count-{{ $type }}-{{ $item->id }}" data-views-template="{{ __('testimonials.modal.views', ['count' => '__COUNT__']) }}">{{ __('testimonials.modal.views', ['count' => $item->views]) }}</span>
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
                            <div class="text-xs font-bold text-carob-500 uppercase tracking-wider">
                                {{ __('testimonials.modal.share_joy') }}
                            </div>
                            <div class="flex gap-3"
                                 data-share-url="{{ url('/') }}/#modal-{{ $type }}-{{ $item->id }}"
                                 data-share-title="{{ $item->title }}">
                                <!-- Facebook -->
                                <button type="button" data-action="share-facebook" class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-100 text-carob-600 text-xs font-bold hover:bg-[#1877F2] hover:text-white hover:border-transparent transition-all shadow-sm group">
                                    <img src="https://cdn.simpleicons.org/facebook/currentColor"
                                        alt="Facebook"
                                        width="14" height="14" loading="lazy"
                                        class="w-3.5 h-3.5 group-hover:scale-110 transition-transform">
                                    {{ __('testimonials.modal.facebook') }}
                                </button>

                                <!-- X (Twitter) -->
                                <button type="button" data-action="share-x" class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-100 text-carob-600 text-xs font-bold hover:bg-black hover:text-white hover:border-transparent transition-all shadow-sm group">
                                    <img src="https://cdn.simpleicons.org/x/currentColor"
                                        alt="X"
                                        width="14" height="14" loading="lazy"
                                        class="w-3.5 h-3.5 group-hover:scale-110 transition-transform">
                                    {{ __('testimonials.modal.x') }}
                                </button>

                                <!-- Copy Link -->
                                <button type="button" data-action="copy-share-link" class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-100 text-carob-600 text-xs font-bold hover:bg-forest-moss-green-500 hover:text-white hover:border-transparent transition-all shadow-sm group" data-copied-text="{{ __('testimonials.modal.copied') }}">
                                    <i data-lucide="link" class="w-3.5 h-3.5 group-hover:scale-110 transition-transform"></i>
                                    <span class="copy-link-label">{{ __('testimonials.modal.copy_link') }}</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </template>
            </div>
        @endforeach
    @endif
@endforeach
