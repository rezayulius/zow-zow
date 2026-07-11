@props(['label', 'value', 'hint' => null, 'accent' => 'neutral'])

{{--
    Same status tokens as the charts (ExecutiveController::statusColor()) —
    inline style, not a Tailwind class, so the hex is guaranteed identical
    rather than "close enough" via a generic Tailwind red/amber/green.
--}}
@php
    $hintColor = match ($accent) {
        'critical' => '#d03b3b',
        'warning' => '#fab219',
        'good' => '#0ca30c',
        default => '#8a7a63',
    };
@endphp

<div class="bg-carob-50 rounded-2xl border border-carob-900/[0.06] p-4 sm:p-5 shadow-[0_1px_2px_rgba(41,31,20,0.04)]">
    <p class="text-xs sm:text-[13px] text-carob-500 font-medium">{{ $label }}</p>
    <p class="text-2xl sm:text-[28px] font-semibold text-carob-900 mt-1.5 break-words leading-tight" style="font-variant-numeric: proportional-nums;">{{ $value }}</p>
    @if ($hint)
        <p class="text-xs mt-1.5 font-medium" style="color: {{ $hintColor }}">{{ $hint }}</p>
    @endif
</div>
