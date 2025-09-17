# Language Switcher Implementation

## Overview
Implementasi language switcher yang fungsional dan seamless untuk aplikasi Laravel dengan best practices.

## Features
- ✅ Session-based locale storage
- ✅ Middleware untuk auto-detect locale
- ✅ Reusable Blade component
- ✅ Translation files (ID & EN)
- ✅ SEO-friendly URLs
- ✅ Smooth transitions

## File Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   └── LocaleController.php
│   └── Middleware/
│       └── SetLocale.php
└── Providers/
    └── LocaleServiceProvider.php

lang/
├── en/
│   └── messages.php
└── id/
    └── messages.php

resources/views/components/
└── lang-switch.blade.php
```

## Usage

### 1. Basic Language Switcher Component
```blade
<x-lang-switch :locales="['id', 'en']" />
```

### 2. Custom Styling
```blade
<x-lang-switch 
    :locales="['id', 'en']" 
    class="custom-class" 
/>
```

### 3. Translation Helper
```blade
{{ __('messages.welcome') }}
{{ __('messages.home') }}
{{ __('messages.services') }}
```

### 4. Manual Route
```blade
<a href="{{ route('locale.set', 'id') }}">Bahasa Indonesia</a>
<a href="{{ route('locale.set', 'en') }}">English</a>
```

## How It Works

### 1. Route Handling
- Route: `/set-locale/{locale}`
- Controller: `LocaleController@setLocale`
- Validation: Only 'en' and 'id' allowed
- Storage: Session-based

### 2. Middleware
- `SetLocale` middleware runs on every request
- Automatically sets locale from session
- Fallback to config default if invalid

### 3. Translation Files
- Located in `lang/{locale}/messages.php`
- Contains key-value pairs for translations
- Easily extendable

## Adding New Languages

### 1. Create Translation File
```bash
# Create new language file
mkdir lang/es
cp lang/en/messages.php lang/es/messages.php
```

### 2. Update Controller
```php
// In LocaleController.php
$supportedLocales = ['en', 'id', 'es'];
```

### 3. Update Middleware
```php
// In SetLocale.php
$supportedLocales = ['en', 'id', 'es'];
```

### 4. Use in Component
```blade
<x-lang-switch :locales="['id', 'en', 'es']" />
```

## Best Practices Implemented

1. **Session Storage**: Persists across requests
2. **Middleware**: Automatic locale detection
3. **Validation**: Prevents invalid locales
4. **Component**: Reusable UI element
5. **Service Provider**: Global view sharing
6. **SEO Friendly**: Clean URLs
7. **Fallback**: Graceful degradation
8. **Performance**: Minimal overhead

## Testing

1. Visit the website
2. Click language switcher (ID/EN)
3. Observe navigation menu changes
4. Check session persistence on refresh
5. Test invalid locale URLs (should redirect)

## Troubleshooting

### Language not changing?
- Check if middleware is registered
- Verify translation files exist
- Clear cache: `php artisan cache:clear`

### Component not found?
- Check if LocaleServiceProvider is registered
- Verify component file exists
- Run: `php artisan view:clear`

### Routes not working?
- Check route registration in web.php
- Verify controller exists
- Test: `php artisan route:list`