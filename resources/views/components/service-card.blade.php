@props(['service', 'category'])

@php
    $theme = App\Support\CategoryTheme::for($category->slug);
@endphp

<a href="{{ route('service.show', [$category, $service]) }}" wire:navigate
    class="group relative bg-white rounded-[2rem] p-5 border {{ $theme['border'] }} {{ $theme['borderHover'] }} shadow-lg {{ $theme['shadowSoft'] }} hover:shadow-2xl {{ $theme['shadowStrongHover'] }} transition-all duration-500 hover:-translate-y-2 flex flex-col h-full overflow-hidden">

    <div class="relative w-full aspect-[4/3] rounded-[1.5rem] overflow-hidden mb-5 group-hover:rotate-1 transition-transform duration-500">
        @if ($service->thumbnail)
            <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}"
                loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        @else
            <div class="w-full h-full flex items-center justify-center {{ $theme['iconBg'] }}">
                <i data-lucide="{{ $category->icon ?: 'stethoscope' }}" class="w-10 h-10 {{ $theme['iconText'] }}"></i>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t {{ $theme['imageOverlay'] }} to-transparent"></div>

        <div class="absolute top-3 left-3">
            <span class="bg-white/95 backdrop-blur-md {{ $theme['badgeText'] }} text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm border border-white/20">
                {{ $category->name }}
            </span>
        </div>
    </div>

    <div class="px-1 pb-1 flex flex-col flex-grow text-left">
        <h3 class="text-lg font-bold {{ $theme['heading'] }} font-heading leading-tight mb-2 group-hover:{{ $theme['headingHover'] }} transition-colors">
            {{ $service->name }}
        </h3>

        @if ($service->excerpt)
            <p class="{{ $theme['body'] }} text-sm leading-relaxed line-clamp-2 mb-5 flex-1">
                {{ $service->excerpt }}
            </p>
        @else
            <div class="flex-1 mb-5"></div>
        @endif

        <div class="mt-auto pt-4 border-t {{ $theme['divider'] }} flex items-center justify-between">
            <span class="text-sm font-bold {{ $theme['linkText'] }}">
                {{ __('messages.view_details') }}
            </span>
            <span class="w-10 h-10 rounded-full {{ $theme['buttonBg'] }} text-white flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-md">
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </span>
        </div>
    </div>
</a>
