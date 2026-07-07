@extends('layouts.app')

@php
    $theme = App\Support\CategoryTheme::for('facility');
    $heroImage = $facility->thumbnail;
    $galleryImages = $facility->images->skip($heroImage ? 1 : 0);
@endphp

{{-- meta_title/meta_description are treated as the final, complete SEO tag
     when the admin fills them in (no brand suffix is appended on top), so a
     value like "... | ZOW Vetique Kemang" typed in Filament isn't duplicated.
     The fallback below only kicks in when the field is left empty. --}}
@section('title', $facility->meta_title ?: ($facility->name . ' | ZOW Vetique Kemang'))
@section('meta_description', $facility->meta_description ?: $facility->excerpt)
@section('canonical', route('facility.show', $facility))
@if ($heroImage)
    @section('og_image', asset('storage/' . $heroImage))
@endif

@section('content')
<div class="bg-gradient-to-b from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50">
    @include('partials.header')

    <!-- Hero -->
    <section class="relative pt-32 pb-16 md:pt-40 md:pb-20 overflow-hidden bg-soft-linen-50">
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-0 -left-32 w-96 h-96 {{ $theme['blob1'] }} rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 -right-32 w-96 h-96 {{ $theme['blob2'] }} rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 z-10">
            <x-breadcrumb :items="[
                ['label' => __('messages.home'), 'url' => route('home')],
                ['label' => __('messages.facilities'), 'url' => route('facility.index')],
                ['label' => $facility->name, 'url' => null],
            ]" />

            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div class="text-center lg:text-left order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full {{ $theme['badgeBg'] }} {{ $theme['badgeText'] }} text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                        {{ __('messages.facilities') }}
                    </div>

                    <h1 class="text-3xl md:text-5xl font-heading font-medium text-carob-900 mb-5 leading-[1.15]">
                        {{ $facility->name }}
                    </h1>

                    @if ($facility->excerpt)
                        <p class="text-base md:text-xl text-carob-700 leading-relaxed mb-8">
                            {{ $facility->excerpt }}
                        </p>
                    @endif

                    <a href="{{ route('facility.index') }}" wire:navigate
                        class="inline-flex items-center gap-2 text-sm font-bold {{ $theme['linkText'] }} hover:underline">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        {{ __('messages.back_to_facilities') }}
                    </a>
                </div>

                <div class="relative order-1 lg:order-2 mx-auto w-[85%] sm:w-[70%] lg:w-full max-w-md">
                    <div class="relative aspect-[4/5] rounded-[2rem] overflow-hidden shadow-2xl shadow-carob-900/10 rotate-2 hover:rotate-0 transition-all duration-700 border-[6px] border-white">
                        @if ($heroImage)
                            <img src="{{ asset('storage/' . $heroImage) }}" alt="{{ $facility->name }}"
                                loading="eager" fetchpriority="high" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center {{ $theme['iconBg'] }}">
                                <i data-lucide="building-2" class="w-20 h-20 {{ $theme['iconText'] }}"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none pointer-events-none text-white">
            <svg class="relative block w-[calc(100%+1.3px)] h-[40px] sm:h-[60px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-current"></path>
            </svg>
        </div>
    </section>

    <!-- Content -->
    <section class="relative py-14 md:py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6 space-y-14">

            @if ($facility->content)
                <div class="text-carob-700 leading-relaxed
                    [&_h1]:font-heading [&_h1]:text-carob-900 [&_h1]:text-3xl [&_h1]:font-medium [&_h1]:mb-4 [&_h1]:mt-8 [&_h1:first-child]:mt-0
                    [&_h2]:font-heading [&_h2]:text-carob-900 [&_h2]:text-2xl [&_h2]:font-medium [&_h2]:mb-4 [&_h2]:mt-8 [&_h2:first-child]:mt-0
                    [&_h3]:font-heading [&_h3]:text-carob-900 [&_h3]:text-xl [&_h3]:font-medium [&_h3]:mb-3 [&_h3]:mt-6
                    [&_p]:mb-5 [&_p]:leading-relaxed
                    [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-5 [&_ul]:space-y-2
                    [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-5 [&_ol]:space-y-2
                    [&_a]:text-forest-moss-green-700 [&_a]:font-semibold [&_a]:underline
                    [&_strong]:text-carob-900 [&_strong]:font-bold
                    [&_img]:rounded-2xl [&_img]:my-6
                    [&_blockquote]:border-l-4 [&_blockquote]:border-forest-moss-green-300 [&_blockquote]:pl-4 [&_blockquote]:italic [&_blockquote]:text-carob-600">
                    {!! $facility->content !!}
                </div>
            @endif

            @if ($galleryImages->isNotEmpty())
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl {{ $theme['iconBg'] }} flex items-center justify-center">
                            <i data-lucide="images" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                        </div>
                        <h2 class="text-2xl font-heading text-carob-900">{{ __('messages.gallery') }}</h2>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach ($galleryImages as $image)
                            <div class="aspect-square rounded-2xl overflow-hidden shadow-md group">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->alt_text ?: $facility->name }}"
                                    loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($facility->equipment->isNotEmpty())
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl {{ $theme['iconBg'] }} flex items-center justify-center">
                            <i data-lucide="stethoscope" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                        </div>
                        <h2 class="text-2xl font-heading text-carob-900">{{ __('messages.available_equipment') }}</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($facility->equipment as $item)
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl {{ $theme['iconBg'] }} flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="check" class="w-5 h-5 {{ $theme['iconText'] }}"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-carob-900">{{ $item->name }}</p>
                                    @if ($item->description)
                                        <p class="text-sm text-carob-600 leading-relaxed mt-1">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($facility->faqs->isNotEmpty())
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl {{ $theme['iconBg'] }} flex items-center justify-center">
                            <i data-lucide="help-circle" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                        </div>
                        <h2 class="text-2xl font-heading text-carob-900">{{ __('messages.faq') }}</h2>
                    </div>
                    <div class="space-y-3">
                        @foreach ($facility->faqs as $faq)
                            <details class="group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                                <summary class="flex items-center justify-between gap-4 cursor-pointer font-bold text-carob-900 list-none px-6 py-5 hover:bg-soft-linen-50 transition-colors">
                                    {{ $faq->question }}
                                    <span class="w-8 h-8 rounded-full bg-soft-linen-100 flex items-center justify-center text-carob-500 flex-shrink-0 transition-transform duration-300 group-open:rotate-180">
                                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                                    </span>
                                </summary>
                                <p class="text-carob-600 leading-relaxed px-6 pb-5 pt-1 border-t border-dashed border-gray-100 bg-soft-linen-50/30">
                                    {{ $faq->answer }}
                                </p>
                            </details>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('partials.footer')
</div>
@endsection

@push('json-ld')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "WebPage",
    "name": {{ Js::from($facility->name) }},
    "description": {{ Js::from($facility->excerpt ?: '') }},
    "url": {{ Js::from(url()->current()) }},
    "isPartOf": {
        "@@id": "https://zowvetique.com/#website"
    },
    "about": {
        "@@id": "https://zowvetique.com/#veterinarycare"
    }
}
</script>
@endpush

@if ($facility->faqs->isNotEmpty())
@push('json-ld')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        @foreach ($facility->faqs as $faq)
        {
            "@@type": "Question",
            "name": {{ Js::from($faq->question) }},
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": {{ Js::from($faq->answer) }}
            }
        }@if (!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endpush
@endif
