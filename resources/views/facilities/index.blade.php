@extends('layouts.app')

@php
    $theme = App\Support\CategoryTheme::for('facility');
@endphp

@section('title', __('messages.facilities') . ' | ZOW Vetique Kemang')
@section('meta_description', __('messages.facilities_subtitle') . ' — ZOW Vetique Kemang, Jakarta Selatan.')
@section('canonical', route('facility.index'))

@section('content')
<div class="bg-gradient-to-b from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50">
    @include('partials.header')

    <!-- Hero -->
    <section class="relative pt-32 pb-24 md:pt-40 md:pb-32 overflow-hidden bg-soft-linen-50">
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-0 -left-24 w-96 h-96 {{ $theme['blob1'] }} rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-0 w-[28rem] h-[28rem] {{ $theme['blob2'] }} rounded-full blur-3xl animate-bounce-slow"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 z-10">
            <x-breadcrumb :items="[
                ['label' => __('messages.home'), 'url' => route('home')],
                ['label' => __('messages.facilities'), 'url' => null],
            ]" class="mb-8" />

            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <!-- Left: copy -->
                <div class="lg:col-span-7">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full {{ $theme['badgeBg'] }} {{ $theme['badgeText'] }} text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                        {{ __('messages.facilities') }}
                    </div>

                    <h1 class="text-4xl md:text-6xl font-heading font-medium text-carob-900 mb-6 leading-[1.1]">
                        {{ __('messages.facilities') }}
                    </h1>

                    <p class="text-base md:text-xl text-carob-700 leading-relaxed max-w-xl mb-8">
                        {{ __('messages.facilities_subtitle') }}
                    </p>

                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/70 border {{ $theme['border'] }} text-sm font-semibold text-carob-800">
                            <i data-lucide="layout-grid" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                            {{ $facilities->count() }} {{ __('messages.facilities') }}
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/70 border {{ $theme['border'] }} text-sm font-semibold text-carob-800">
                            <i data-lucide="clock" class="w-4 h-4 {{ $theme['iconText'] }}"></i>
                            {{ config('clinic.operating_hours.label') }}
                        </span>
                        <a href="https://wa.me/{{ config('clinic.whatsapp_number') }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl {{ $theme['buttonBg'] }} {{ $theme['buttonBgHover'] }} text-white text-sm font-semibold shadow-lg transition-all duration-200">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            {{ __('messages.chat_whatsapp') }}
                        </a>
                    </div>
                </div>

                <!-- Right: decorative icon mosaic -->
                <div class="lg:col-span-5 hidden lg:flex items-center justify-center relative h-72">
                    <div class="absolute w-56 h-56 rounded-[2.5rem] {{ $theme['iconBg'] }} rotate-6 shadow-xl {{ $theme['iconShadow'] }}"></div>
                    <div class="absolute w-40 h-40 rounded-[2rem] bg-white -rotate-12 -translate-x-16 translate-y-10 shadow-xl border {{ $theme['border'] }} flex items-center justify-center">
                        <i data-lucide="flask-conical" class="w-14 h-14 {{ $theme['iconText'] }}"></i>
                    </div>
                    <div class="absolute w-32 h-32 rounded-[1.75rem] bg-white rotate-12 translate-x-20 -translate-y-8 shadow-xl border {{ $theme['border'] }} flex items-center justify-center">
                        <i data-lucide="shield-check" class="w-10 h-10 {{ $theme['iconText'] }}"></i>
                    </div>
                    <div class="relative w-44 h-44 rounded-[2rem] {{ $theme['sectionBg'] }} border {{ $theme['border'] }} shadow-2xl flex items-center justify-center">
                        <i data-lucide="building-2" class="w-20 h-20 {{ $theme['iconText'] }}"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Separator -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none pointer-events-none text-white">
            <svg class="relative block w-[calc(100%+1.3px)] h-[50px] sm:h-[70px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-current"></path>
            </svg>
        </div>
    </section>

    <!-- Facilities Grid -->
    <section class="relative py-16 md:py-24 bg-white overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] -z-10 mix-blend-multiply" style="background-image: url('{{ asset('images/backgorund/pattern-tulang-trans.webp') }}'); background-size: 400px; background-repeat: repeat;"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            @if ($facilities->isEmpty())
                <div class="text-center py-16 {{ $theme['iconBg'] }}/50 rounded-3xl border {{ $theme['border'] }} max-w-xl mx-auto">
                    <i data-lucide="building-2" class="w-12 h-12 mx-auto mb-4 {{ $theme['iconText'] }}"></i>
                    <p class="{{ $theme['body'] }}">{{ __('messages.no_facilities_yet') }}</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($facilities as $facility)
                        <x-facility-card :facility="$facility" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="relative py-12 md:py-16 bg-white overflow-hidden">
        <div class="max-w-5xl mx-auto px-6">
            <div class="relative rounded-[2.5rem] overflow-hidden bg-carob-900 text-white shadow-2xl shadow-carob-900/30 group transform transition-all hover:scale-[1.01] duration-500">
                <div class="absolute inset-0">
                    <div class="absolute inset-0 bg-gradient-to-r from-carob-900 via-carob-800/90 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1548767797-d8c844163c4c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=80"
                        alt="{{ __('messages.facilities') }}" loading="lazy"
                        class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-1000">

                    <div class="absolute top-8 right-8 w-24 h-24 bg-white/10 rounded-full blur-2xl animate-pulse-slow z-20"></div>
                    <div class="absolute bottom-8 left-1/3 w-20 h-20 {{ $theme['blob1'] }} blur-xl z-20"></div>
                </div>

                <div class="relative z-20 p-6 sm:p-8 lg:p-12 flex flex-col lg:flex-row items-center justify-between gap-6 lg:gap-10">
                    <div class="max-w-xl text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-4 hover:bg-white/20 transition-colors cursor-default">
                            <span class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse"></span>
                            <span class="text-[11px] font-bold tracking-wide uppercase text-white">{{ __('services.booking.badge') }}</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-heading font-medium mb-3 leading-tight">
                            {{ __('services.booking.title_line1') }}
                            <span class="italic text-chai-300 font-heading">{{ __('services.booking.title_line2') }}</span>
                        </h3>
                        <p class="text-carob-100 text-sm md:text-base leading-relaxed opacity-90 font-light">
                            {{ __('services.booking.subtitle') }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row lg:flex-col gap-3 w-full lg:w-auto lg:min-w-[240px]">
                        <a href="https://vet.digitail.io/clinics/zow-vet-clinic" target="_blank" rel="noopener noreferrer"
                            class="w-full py-3.5 px-6 bg-white text-carob-900 rounded-2xl font-bold hover:bg-forest-moss-green-50 transition-all duration-300 shadow-xl flex items-center justify-center gap-2 transform hover:-translate-y-1 hover:scale-105">
                            <i data-lucide="calendar-plus" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                            <span class="text-sm md:text-base">{{ __('services.booking.book_appointment') }}</span>
                        </a>
                        <a href="https://wa.me/{{ config('clinic.whatsapp_number') }}" target="_blank" rel="noopener noreferrer"
                            class="w-full py-3.5 px-6 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-2xl font-bold hover:bg-white/20 transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                            <span class="text-sm md:text-base">{{ __('services.booking.chat_whatsapp') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
</div>
@endsection

@push('json-ld')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "CollectionPage",
    "name": {!! json_encode(__('messages.facilities'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "description": {!! json_encode(__('messages.facilities_subtitle'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "url": {!! json_encode(url()->current(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "isPartOf": {
        "@@id": "https://zowvetique.com/#website"
    },
    "hasPart": [
        @foreach ($facilities as $facility)
        {
            "@@type": "WebPage",
            "name": {!! json_encode($facility->name, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
            "url": {!! json_encode(route('facility.show', $facility), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        }@if (!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endpush
