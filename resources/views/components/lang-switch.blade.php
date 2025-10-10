@props(['locales' => ['en', 'id'], 'class' => 'flex items-center space-x-1 bg-almond-100 rounded-lg p-1'])

<div {{ $attributes->merge(['class' => $class]) }}>
    @foreach($locales as $locale)
        <a href="{{ route('locale.set', $locale) }}"
           class="px-2 xl:px-3 py-1.5 rounded-lg text-xs xl:text-sm font-medium transition-all duration-200
                  {{ app()->getLocale() === $locale ? 'bg-white text-[#725C3A] shadow' : 'text-[#725C3A] hover:bg-white hover:shadow' }}"
           title="{{ $locale === 'id' ? 'Bahasa Indonesia' : 'English' }}" aria-label="{{ $locale === 'id' ? 'Bahasa Indonesia' : 'English' }}">
            <img
                src="{{ $locale === 'id' 
                    ? 'https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1ee-1f1e9.svg' 
                    : 'https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1ec-1f1e7.svg' }}"
                alt="{{ $locale === 'id' ? 'Bendera Indonesia' : 'Bendera Inggris' }}"
                class="inline-block align-middle"
                width="20" height="20">
        </a>
    @endforeach
</div>