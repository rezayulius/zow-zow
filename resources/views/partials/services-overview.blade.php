@if ($serviceCategories->isNotEmpty())
<section id="services-overview" class="relative py-10 md:py-14 overflow-hidden bg-soft-linen-50">
    {{-- Seamless transition: matches the Philosophy section's flat soft-linen-50
         background above and blends into the Health section's white background below. --}}
    <div class="absolute inset-0 bg-gradient-to-b from-soft-linen-50 via-soft-linen-50/60 to-white -z-20"></div>
    <div class="absolute top-10 -left-16 w-64 h-64 bg-forest-moss-green-100/30 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-10 -right-16 w-72 h-72 bg-chai-100/30 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 bg-forest-moss-green-50 text-forest-moss-green-700 px-5 py-2 rounded-full text-sm font-semibold mb-5 border border-forest-moss-green-100">
                <i data-lucide="layout-grid" class="w-4 h-4"></i>
                {{ __('services.overview.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-carob-900 mb-4 font-heading leading-tight">
                {{ __('services.overview.title_line1') }}
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-forest-moss-green-600 to-chai-600">{{ __('services.overview.title_line2') }}</span>
            </h2>
            <p class="text-carob-600 max-w-xl mx-auto leading-relaxed">{{ __('services.overview.subtitle') }}</p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            @foreach ($serviceCategories as $category)
                @php
                    $theme = App\Support\CategoryTheme::for($category->slug);
                    $topServices = $category->clinicServices->take(4);
                    $remaining = max($category->clinicServices->count() - $topServices->count(), 0);
                @endphp
                <a href="{{ route('service-category.show', $category) }}" wire:navigate
                    class="group relative bg-white rounded-[2rem] p-6 md:p-7 border {{ $theme['border'] }} {{ $theme['borderHover'] }} shadow-md {{ $theme['shadowSoft'] }} hover:shadow-xl {{ $theme['shadowStrongHover'] }} transition-all duration-500 hover:-translate-y-1.5 flex flex-col">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-2xl {{ $theme['iconBg'] }} flex items-center justify-center shrink-0 group-hover:rotate-6 transition-transform duration-500 shadow-sm {{ $theme['iconShadow'] }}">
                            <i data-lucide="{{ $category->icon ?: $theme['icon'] }}" class="w-7 h-7 {{ $theme['iconText'] }}"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold {{ $theme['heading'] }} font-heading group-hover:{{ $theme['headingHover'] }} transition-colors">{{ $category->name }}</h3>
                            @if ($category->description)
                                <p class="text-sm {{ $theme['body'] }} line-clamp-1">{{ $category->description }}</p>
                            @endif
                        </div>
                    </div>

                    @if ($topServices->isNotEmpty())
                        <div class="flex flex-wrap gap-2 mb-5">
                            @foreach ($topServices as $service)
                                <span class="text-xs font-medium {{ $theme['badgeText'] }} {{ $theme['badgeBg'] }} px-3 py-1.5 rounded-full">{{ $service->name }}</span>
                            @endforeach
                            @if ($remaining > 0)
                                <span class="text-xs font-semibold {{ $theme['linkText'] }} px-3 py-1.5 rounded-full border {{ $theme['border'] }}">
                                    {{ __('services.overview.more_count', ['count' => $remaining]) }}
                                </span>
                            @endif
                        </div>
                    @endif

                    <div class="mt-auto pt-4 border-t {{ $theme['divider'] }} flex items-center justify-between">
                        <span class="text-sm font-bold {{ $theme['linkText'] }}">{{ __('services.overview.view_all') }}</span>
                        <span class="w-9 h-9 rounded-full {{ $theme['buttonBg'] }} {{ $theme['buttonBgHover'] }} text-white flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-sm">
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
