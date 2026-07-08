@props(['items' => []])

{{-- $items: ordered array of ['label' => string, 'url' => string|null] pairs.
     The last item should have url = null (current page, not a link). Reused
     as the single source of truth for both the visible breadcrumb and its
     matching BreadcrumbList JSON-LD so the two never drift apart. --}}

<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'mb-6 flex']) }}>
    <ol class="flex flex-wrap items-center gap-1.5 text-sm text-carob-500">
        @foreach ($items as $index => $item)
            <li class="flex items-center gap-1.5">
                @if (!$loop->first)
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-carob-300"></i>
                @endif

                @if (!empty($item['url']) && !$loop->last)
                    <a href="{{ $item['url'] }}" wire:navigate class="hover:text-forest-moss-green-700 transition-colors">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="font-medium text-carob-700" @if ($loop->last) aria-current="page" @endif>
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>

@push('json-ld')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        @foreach ($items as $index => $item)
        {
            "@@type": "ListItem",
            "position": {{ $index + 1 }},
            "name": {!! json_encode($item['label'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
            @if (!empty($item['url'])), "item": {!! json_encode(url($item['url']), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!} @endif
        }@if (!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endpush
