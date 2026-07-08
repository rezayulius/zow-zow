@extends('layouts.app')

@php
    $theme = App\Support\CategoryTheme::for('article');
@endphp

@section('title', __('messages.articles') . ' | ZOW Vetique Kemang')
@section('meta_description', __('testimonials.articles.subtitle'))
@section('canonical', route('articles.index'))

@section('content')
<div class="bg-gradient-to-b from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50">
    @include('partials.header')

    <!-- Hero -->
    <section class="relative pt-32 pb-16 md:pt-40 md:pb-20 overflow-hidden bg-soft-linen-50">
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-0 -left-24 w-96 h-96 {{ $theme['blob1'] }} rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-0 w-[28rem] h-[28rem] {{ $theme['blob2'] }} rounded-full blur-3xl animate-bounce-slow"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 z-10">
            <x-breadcrumb :items="[
                ['label' => __('messages.home'), 'url' => route('home')],
                ['label' => __('messages.articles'), 'url' => null],
            ]" class="mb-8" />

            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full {{ $theme['badgeBg'] }} {{ $theme['badgeText'] }} text-xs font-bold uppercase tracking-wider mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                    {{ __('testimonials.articles.badge') }}
                </div>

                <h1 class="text-4xl md:text-6xl font-heading font-medium text-carob-900 mb-6 leading-[1.1]">
                    {!! __('testimonials.articles.title') !!}
                </h1>

                <p class="text-base md:text-xl text-carob-700 leading-relaxed">
                    {{ __('testimonials.articles.subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="relative py-16 md:py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            @if ($articles->isEmpty())
                <div class="text-center py-16 {{ $theme['iconBg'] }}/50 rounded-3xl border {{ $theme['border'] }} max-w-xl mx-auto">
                    <i data-lucide="newspaper" class="w-12 h-12 mx-auto mb-4 {{ $theme['iconText'] }}"></i>
                    <p class="{{ $theme['body'] }}">{{ __('testimonials.articles.empty') }}</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($articles as $article)
                        <article class="group bg-white rounded-[2rem] overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                            <div class="relative h-56 overflow-hidden">
                                @if ($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 backdrop-blur-md text-carob-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                        {{ $article->tags[0] ?? __('testimonials.articles.default_category') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-8 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 text-xs font-medium text-carob-500 mb-4">
                                    <i data-lucide="calendar" class="w-3 h-3"></i>
                                    {{ ($article->published_at ?? $article->created_at)->format('d M Y') }}
                                </div>

                                <h2 class="text-xl font-bold text-carob-900 mb-3 leading-tight group-hover:text-forest-moss-green-600 transition-colors">
                                    {{ $article->title }}
                                </h2>

                                <p class="text-carob-600 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                                    {{ $article->excerpt }}
                                </p>

                                <a href="{{ route('articles.show', $article) }}"
                                    class="inline-flex items-center text-sm font-bold text-forest-moss-green-600 hover:text-forest-moss-green-700 transition-colors group/link">
                                    {{ __('testimonials.articles.read_article') }}
                                    <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $articles->links() }}
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
    "@@type": "CollectionPage",
    "name": {!! json_encode(__('messages.articles'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "description": {!! json_encode(__('testimonials.articles.subtitle'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "url": {!! json_encode(url()->current(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "isPartOf": {
        "@@id": "https://zowvetique.com/#website"
    },
    "hasPart": [
        @foreach ($articles as $article)
        {
            "@@type": "BlogPosting",
            "headline": {!! json_encode($article->title, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
            "url": {!! json_encode(route('articles.show', $article), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        }@if (!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endpush
