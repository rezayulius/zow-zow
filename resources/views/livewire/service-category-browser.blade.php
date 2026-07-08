<div>
    <!-- Search bar: floats over the hero/content seam -->
    <div class="relative z-20 -mt-12 md:-mt-14 max-w-3xl mx-auto px-6">
        <div class="bg-white rounded-[1.75rem] shadow-2xl shadow-carob-900/10 border border-soft-linen-100 p-2.5 flex items-center gap-2">
            <div class="pl-3 {{ $theme['iconText'] }}">
                <i data-lucide="search" class="w-5 h-5"></i>
            </div>

            <input type="text" wire:model.live.debounce.400ms="search"
                placeholder="{{ __('messages.search_services_placeholder') }}"
                class="flex-1 min-w-0 py-3 bg-transparent text-carob-800 placeholder:text-carob-500 focus:outline-none text-sm md:text-base">

            <div wire:loading wire:target="search" class="flex-shrink-0 pr-1">
                <svg class="animate-spin h-5 w-5 {{ $theme['iconText'] }}" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>

            @if ($hasSearch)
                <button type="button" wire:click="clearSearch"
                    class="hidden sm:flex items-center justify-center w-10 h-10 rounded-2xl text-carob-500 hover:text-carob-600 hover:bg-soft-linen-100 transition-colors flex-shrink-0"
                    title="{{ __('messages.clear_search') }}">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            @endif
        </div>
    </div>

    <!-- Services Grid -->
    <section id="layanan-list" class="relative pt-12 pb-16 md:pb-24 bg-white overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] -z-10 mix-blend-multiply" style="background-image: url('{{ asset('images/backgorund/pattern-tulang-trans.webp') }}'); background-size: 400px; background-repeat: repeat;"></div>

        <div wire:loading.class="opacity-40 pointer-events-none" wire:target="search,previousPage,nextPage,gotoPage,clearSearch"
            class="max-w-7xl mx-auto px-6 relative z-10 transition-opacity duration-200">

            @if ($hasSearch)
                <p class="text-sm text-carob-500 mb-8 text-center">
                    {{ __('messages.search_results_for') }} <span class="font-bold text-carob-800">&ldquo;{{ $search }}&rdquo;</span>
                    &middot;
                    {{ trans_choice('messages.results_count', $services->total(), ['count' => $services->total()]) }}
                </p>
            @endif

            @if ($services->isEmpty())
                <div class="text-center py-16 {{ $theme['iconBg'] }}/50 rounded-3xl border {{ $theme['border'] }} max-w-xl mx-auto">
                    <i data-lucide="{{ $hasSearch ? 'search-x' : 'calendar-x' }}" class="w-12 h-12 mx-auto mb-4 {{ $theme['iconText'] }}"></i>
                    <p class="font-bold text-carob-800 mb-1">
                        {{ $hasSearch ? __('messages.no_search_results') : __('messages.no_services_yet') }}
                    </p>
                    @if ($hasSearch)
                        <p class="text-sm {{ $theme['body'] }} mb-5">{{ __('messages.no_search_results_hint') }}</p>
                        <button type="button" wire:click="clearSearch"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl {{ $theme['buttonBg'] }} {{ $theme['buttonBgHover'] }} text-white text-sm font-bold transition-all duration-200">
                            <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                            {{ __('messages.clear_search') }}
                        </button>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($services as $service)
                        <x-service-card :service="$service" :category="$category" wire:key="service-{{ $service->id }}" />
                    @endforeach
                </div>

                @if ($services->hasPages())
                    {{-- Real hrefs (not just wire:click) so pagination stays crawlable/indexable
                         by search engines even though navigating it live-updates via Livewire. --}}
                    <nav aria-label="Pagination" class="flex items-center justify-center gap-2 mt-12">
                        @if ($services->onFirstPage())
                            <span class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl text-carob-300 cursor-not-allowed">
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </span>
                        @else
                            <a href="{{ route('service-category.show', ['category' => $category, 'page' => $services->currentPage() - 1]) }}"
                                wire:click.prevent="previousPage" rel="prev"
                                class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl text-carob-600 hover:bg-soft-linen-100 transition-colors duration-200">
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </a>
                        @endif

                        <div class="flex items-center gap-1.5">
                            @for ($page = 1; $page <= $services->lastPage(); $page++)
                                @if ($page === $services->currentPage())
                                    <span aria-current="page"
                                        class="w-10 h-10 flex items-center justify-center rounded-xl font-bold text-sm text-white {{ $theme['buttonBg'] }} shadow-md">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ route('service-category.show', ['category' => $category, 'page' => $page]) }}"
                                        wire:click.prevent="gotoPage({{ $page }})"
                                        class="w-10 h-10 flex items-center justify-center rounded-xl font-medium text-sm text-carob-600 hover:bg-soft-linen-100 transition-colors duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor
                        </div>

                        @if (! $services->hasMorePages())
                            <span class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl text-carob-300 cursor-not-allowed">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </span>
                        @else
                            <a href="{{ route('service-category.show', ['category' => $category, 'page' => $services->currentPage() + 1]) }}"
                                wire:click.prevent="nextPage" rel="next"
                                class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl text-carob-600 hover:bg-soft-linen-100 transition-colors duration-200">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </nav>
                @endif
            @endif
        </div>
    </section>
</div>
