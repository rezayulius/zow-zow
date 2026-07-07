@extends('layouts.app')

@php
    $theme = App\Support\CategoryTheme::for($category->slug);
    $heroImage = $service->thumbnail;
    $galleryImages = $service->serviceImages->skip($heroImage ? 1 : 0);
@endphp

{{-- meta_title/meta_description are treated as the final, complete SEO tag
     when the admin fills them in (no brand suffix is appended on top), so a
     value like "... | ZOW Vetique Kemang" typed in Filament isn't duplicated.
     The fallback below only kicks in when the field is left empty. --}}
@section('title', $service->meta_title ?: ($service->name . ' | ZOW Vetique Kemang'))
@section('meta_description', $service->meta_description ?: $service->excerpt)
@section('canonical', route('service.show', [$category, $service]))
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
                ['label' => $category->name, 'url' => route('service-category.show', $category)],
                ['label' => $service->name, 'url' => null],
            ]" />

            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div class="text-center lg:text-left order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full {{ $theme['badgeBg'] }} {{ $theme['badgeText'] }} text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                        {{ $category->name }}
                    </div>

                    <h1 class="text-3xl md:text-5xl font-heading font-medium text-carob-900 mb-5 leading-[1.15]">
                        {{ $service->name }}
                    </h1>

                    @if ($service->excerpt)
                        <p class="text-base md:text-xl text-carob-700 leading-relaxed mb-8">
                            {{ $service->excerpt }}
                        </p>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                        <a href="https://wa.me/{{ config('clinic.whatsapp_number') }}?text={{ urlencode($service->whatsapp_message ?: 'Halo, saya ingin tanya soal ' . $service->name) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="py-3.5 px-7 {{ $theme['buttonBg'] }} {{ $theme['buttonBgHover'] }} text-white rounded-2xl font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-lg {{ $theme['shadowStrongHover'] }} transform hover:-translate-y-0.5">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                            {{ __('messages.chat_whatsapp') }}
                        </a>
                        <a href="{{ $service->booking_cta_url ?: route('home') . '#booking' }}"
                            class="py-3.5 px-7 bg-white border-2 {{ $theme['border'] }} {{ $theme['linkText'] }} rounded-2xl font-bold hover:bg-soft-linen-50 transition-all duration-300 flex items-center justify-center gap-2">
                            <i data-lucide="calendar-check" class="w-5 h-5"></i>
                            {{ __('messages.book_now') }}
                        </a>
                    </div>
                </div>

                <div class="relative order-1 lg:order-2 mx-auto w-[85%] sm:w-[70%] lg:w-full max-w-md">
                    <div class="relative aspect-[4/5] rounded-[2rem] overflow-hidden shadow-2xl shadow-carob-900/10 rotate-2 hover:rotate-0 transition-all duration-700 border-[6px] border-white">
                        @if ($heroImage)
                            <img src="{{ asset('storage/' . $heroImage) }}" alt="{{ $service->name }}"
                                loading="eager" fetchpriority="high" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center {{ $theme['iconBg'] }}">
                                <i data-lucide="{{ $category->icon ?: $theme['icon'] }}" class="w-20 h-20 {{ $theme['iconText'] }}"></i>
                            </div>
                        @endif
                    </div>

                    <div class="absolute -bottom-3 -left-3 sm:-left-6 bg-white p-3 rounded-2xl shadow-xl border border-soft-linen-100 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full {{ $theme['iconBg'] }} flex items-center justify-center">
                            <i data-lucide="shield-check" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                        </div>
                        <span class="text-xs font-bold text-carob-800 pr-1">{{ __('messages.our_doctors') }}</span>
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
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-3 gap-12">

            <div class="lg:col-span-2 space-y-14">
                @if ($service->content)
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
                        {!! $service->content !!}
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
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->alt_text ?: $service->name }}"
                                        loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($service->clinicImages->isNotEmpty())
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl {{ $theme['iconBg'] }} flex items-center justify-center">
                                <i data-lucide="building-2" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                            </div>
                            <h2 class="text-2xl font-heading text-carob-900">{{ __('messages.clinic_photos') }}</h2>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach ($service->clinicImages as $image)
                                <div class="aspect-square rounded-2xl overflow-hidden shadow-md group">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->alt_text ?: $service->name }}"
                                        loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($vets->isNotEmpty())
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl {{ $theme['iconBg'] }} flex items-center justify-center">
                                <i data-lucide="stethoscope" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                            </div>
                            <h2 class="text-2xl font-heading text-carob-900">{{ __('messages.our_doctors') }}</h2>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach ($vets as $vet)
                                <div class="bg-white rounded-[2rem] overflow-hidden border border-carob-100 hover:border-carob-300 transition-all duration-500 hover:shadow-2xl hover:-translate-y-1 shadow-lg">
                                    <div class="h-16 bg-gradient-to-r from-carob-50 to-soft-linen-50"></div>
                                    <div class="px-5 pb-5 -mt-10 flex items-center gap-4">
                                        <div class="w-20 h-20 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white flex-shrink-0">
                                            @if (!empty($vet['avatar']))
                                                <img src="{{ $vet['avatar'] }}" alt="{{ $vet['name_with_title'] ?? $vet['full_name'] ?? '' }}"
                                                    loading="lazy" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-soft-linen-100 text-carob-300">
                                                    <i data-lucide="user" class="w-8 h-8"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="pt-9">
                                            <p class="font-bold text-carob-900 font-heading leading-tight">{{ $vet['name_with_title'] ?? $vet['full_name'] ?? '-' }}</p>
                                            @if (!empty($vet['job_title']))
                                                <p class="text-carob-500 text-xs font-medium uppercase tracking-wider">{{ $vet['job_title'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($service->faqs->isNotEmpty())
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl {{ $theme['iconBg'] }} flex items-center justify-center">
                                <i data-lucide="help-circle" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                            </div>
                            <h2 class="text-2xl font-heading text-carob-900">{{ __('messages.faq') }}</h2>
                        </div>
                        <div class="space-y-3">
                            @foreach ($service->faqs as $faq)
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

            <aside class="lg:col-span-1">
                <div class="sticky top-28 space-y-5">
                    <div class="relative overflow-hidden rounded-[2rem] bg-carob-900 text-white p-6 shadow-2xl shadow-carob-900/20">
                        <div class="absolute top-0 right-0 w-32 h-32 {{ $theme['blob1'] }} rounded-full blur-2xl -translate-y-1/3 translate-x-1/3"></div>

                        <div class="relative space-y-5">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wide text-carob-300 mb-2 flex items-center gap-2">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                    {{ __('messages.address') }}
                                </h3>
                                <p class="text-white/90 leading-relaxed text-sm">
                                    {{ $service->address ?: config('clinic.address.full') }}
                                </p>
                            </div>

                            <div class="h-px bg-white/10"></div>

                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wide text-carob-300 mb-2 flex items-center gap-2">
                                    <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                    {{ __('messages.opening_hours') }}
                                </h3>
                                @if (!empty($service->operating_hours))
                                    <ul class="text-sm text-white/90 space-y-1">
                                        @foreach ($service->operating_hours as $day => $hours)
                                            <li class="flex justify-between gap-3">
                                                <span>{{ $day }}</span>
                                                <span class="font-medium">{{ $hours }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-white/90">{{ config('clinic.operating_hours.label') }}</p>
                                @endif
                            </div>

                            <div class="flex flex-col gap-3 pt-2">
                                <a href="https://wa.me/{{ config('clinic.whatsapp_number') }}?text={{ urlencode($service->whatsapp_message ?: 'Halo, saya ingin tanya soal ' . $service->name) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="w-full py-3.5 px-6 bg-white text-carob-900 rounded-2xl font-bold hover:bg-forest-moss-green-50 transition-all duration-300 flex items-center justify-center gap-2 shadow-lg">
                                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                                    {{ __('messages.chat_whatsapp') }}
                                </a>
                                <a href="{{ $service->booking_cta_url ?: route('home') . '#booking' }}"
                                    class="w-full py-3.5 px-6 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-2xl font-bold hover:bg-white/20 transition-all duration-300 flex items-center justify-center gap-2">
                                    <i data-lucide="calendar-check" class="w-5 h-5"></i>
                                    {{ __('messages.book_now') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('service-category.show', $category) }}" wire:navigate
                        class="flex items-center justify-center gap-2 text-sm font-bold {{ $theme['linkText'] }} hover:underline py-3">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        {{ __('messages.back_to') }} {{ $category->name }}
                    </a>
                </div>
            </aside>
        </div>
    </section>

    @include('partials.footer')
</div>
@endsection

@push('json-ld')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Service",
    "name": {{ Js::from($service->name) }},
    "description": {{ Js::from($service->excerpt ?: '') }},
    "url": {{ Js::from(url()->current()) }},
    "provider": {
        "@@id": "https://zowvetique.com/#veterinarycare"
    },
    "areaServed": "Jakarta Selatan"
}
</script>
@endpush

@if ($service->faqs->isNotEmpty())
@push('json-ld')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        @foreach ($service->faqs as $faq)
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', reportClinicServiceView);
    document.addEventListener('livewire:navigated', reportClinicServiceView);

    function reportClinicServiceView() {
        if (window.location.pathname !== {{ Js::from('/' . $category->slug . '/' . $service->slug) }}) {
            return;
        }

        fetch({{ Js::from(route('content.view', ['type' => 'clinic-service', 'id' => $service->id])) }}, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        }).catch(() => {});
    }
</script>
@endpush
