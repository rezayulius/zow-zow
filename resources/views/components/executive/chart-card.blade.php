@props(['title', 'description' => null, 'type', 'labels', 'data', 'label' => '', 'color' => null, 'colors' => null, 'height' => 260])

<div class="bg-carob-50 rounded-2xl border border-carob-900/[0.06] p-4 sm:p-5 shadow-[0_1px_2px_rgba(41,31,20,0.04)]">
    <h3 class="text-sm font-semibold text-carob-900 tracking-tight">{{ $title }}</h3>
    @if ($description)
        <p class="text-xs text-carob-500 mt-0.5">{{ $description }}</p>
    @endif

    @if (empty($data))
        <div class="flex items-center justify-center text-sm text-carob-400" style="height: {{ $height }}px">
            Tidak ada data pada rentang tanggal ini.
        </div>
    @else
        <div class="mt-3" style="height: {{ $height }}px">
            <canvas data-chart="{{ json_encode([
                'type' => $type,
                'labels' => $labels,
                'data' => $data,
                'label' => $label,
                'color' => $color,
                'colors' => $colors,
            ]) }}"></canvas>
        </div>
    @endif
</div>
