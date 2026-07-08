@extends('layouts.app')

@php
    $theme = App\Support\CategoryTheme::for('article');
@endphp

@section('title', $article->title . ' | ZOW Vetique Kemang')
@section('meta_description', $article->excerpt ?: strip_tags($article->content))
@section('canonical', route('articles.show', $article))
@if ($article->featured_image)
    @section('og_image', asset('storage/' . $article->featured_image))
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

        <div class="relative max-w-3xl mx-auto px-6 z-10">
            <x-breadcrumb :items="[
                ['label' => __('messages.home'), 'url' => route('home')],
                ['label' => __('messages.articles'), 'url' => route('articles.index')],
                ['label' => $article->title, 'url' => null],
            ]" class="mb-8" />

            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full {{ $theme['badgeBg'] }} {{ $theme['badgeText'] }} text-xs font-bold uppercase tracking-wider mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                {{ $article->tags[0] ?? __('testimonials.articles.default_category') }}
            </div>

            <h1 class="text-3xl md:text-5xl font-heading font-medium text-carob-900 mb-6 leading-[1.15]">
                {{ $article->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 md:gap-6 text-sm text-carob-500">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-carob-600 shadow-sm">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </div>
                    <span class="font-medium">{{ $article->author ?? __('testimonials.modal.default_author') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-carob-600 shadow-sm">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                    </div>
                    <span class="font-medium">{{ ($article->published_at ?? $article->created_at)->format('d F Y') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-carob-600 shadow-sm">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                    </div>
                    <span class="font-medium">{{ __('testimonials.modal.views', ['count' => $article->views]) }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Body -->
    <section class="relative py-12 md:py-16 bg-white overflow-hidden">
        <div class="max-w-3xl mx-auto px-6">
            @if ($article->featured_image)
                <div class="rounded-[2rem] overflow-hidden shadow-md mb-10 ring-4 ring-soft-linen-50">
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" class="w-full h-auto object-cover max-h-[420px]">
                </div>
            @endif

            <div class="article-content text-carob-700 leading-relaxed">
                {!! $article->content !!}
            </div>

            @if (!empty($article->tags))
                <div class="flex flex-wrap gap-2 mt-10 pt-8 border-t border-dashed border-gray-200">
                    @foreach ($article->tags as $tag)
                        <span class="px-3 py-1 rounded-full bg-soft-linen-100 text-carob-700 text-xs font-semibold">#{{ $tag }}</span>
                    @endforeach
                </div>
            @endif

            <!-- Share -->
            <div class="flex flex-wrap items-center gap-3 mt-8">
                <span class="text-xs font-bold text-carob-500 uppercase tracking-wider">{{ __('testimonials.modal.share_joy') }}</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article)) }}" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-100 text-carob-600 text-xs font-bold hover:bg-[#1877F2] hover:text-white hover:border-transparent transition-all shadow-sm">
                    {{ __('testimonials.modal.facebook') }}
                </a>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . route('articles.show', $article)) }}" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-100 text-carob-600 text-xs font-bold hover:bg-[#25D366] hover:text-white hover:border-transparent transition-all shadow-sm">
                    WhatsApp
                </a>
            </div>

            <div class="mt-6">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-sm font-bold {{ $theme['linkText'] }} hover:underline">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    {{ __('messages.back_to_articles') }}
                </a>
            </div>
        </div>
    </section>

    @if ($relatedArticles->isNotEmpty())
        <section class="relative py-12 md:py-16 bg-soft-linen-50/50 overflow-hidden">
            <div class="max-w-5xl mx-auto px-6">
                <h2 class="text-2xl md:text-3xl font-bold text-carob-900 mb-8 font-heading">{{ __('messages.related_articles') }}</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach ($relatedArticles as $related)
                        <a href="{{ route('articles.show', $related) }}" class="group bg-white rounded-[1.5rem] overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                            @if ($related->featured_image)
                                <div class="h-36 overflow-hidden">
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @endif
                            <div class="p-5">
                                <h3 class="font-bold text-carob-900 leading-snug group-hover:text-forest-moss-green-600 transition-colors line-clamp-2">{{ $related->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('partials.footer')
</div>
@endsection

@push('json-ld')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BlogPosting",
    "headline": {!! json_encode($article->title, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "description": {!! json_encode($article->excerpt ?: '', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "url": {!! json_encode(route('articles.show', $article), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "mainEntityOfPage": {
        "@@type": "WebPage",
        "@@id": {!! json_encode(route('articles.show', $article), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    },
    @if ($article->featured_image)
    "image": {!! json_encode(asset('storage/' . $article->featured_image), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    @endif
    "datePublished": {!! json_encode(($article->published_at ?? $article->created_at)->toIso8601String(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "dateModified": {!! json_encode($article->updated_at->toIso8601String(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},
    "author": {
        "@@type": "Organization",
        "name": {!! json_encode($article->author ?: 'ZOW Vetique', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    },
    "publisher": {
        "@@id": "https://zowvetique.com/#veterinarycare"
    },
    "isPartOf": {
        "@@id": "https://zowvetique.com/#website"
    }
}
</script>
@endpush
