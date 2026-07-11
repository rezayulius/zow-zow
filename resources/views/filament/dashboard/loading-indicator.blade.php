{{-- Uses Livewire's own inline-style show/hide (wire:loading.flex) and Filament's
     own <x-filament::loading-indicator> component, both of which ship their own
     CSS — unlike Tailwind utility classes written here, which the admin panel's
     precompiled stylesheet doesn't know about and so render unstyled. --}}
<div wire:loading.flex style="display: none; align-items: center; gap: 0.5rem; font-size: 0.875rem; opacity: 0.7; margin-top: -0.5rem;">
    <x-filament::loading-indicator style="height: 1rem; width: 1rem;" />
    <span>Memuat data sesuai filter tanggal…</span>
</div>
