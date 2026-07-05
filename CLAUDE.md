# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Install dependencies
composer install
npm install

# Local development (server + queue listener + log tailer + vite, all in one)
composer run dev

# Or individually
php artisan serve
npm run dev            # Vite dev server
npm run build          # Production frontend build

# Tests
php artisan test                                  # full suite
php artisan test tests/Feature/ExampleTest.php     # single file
php artisan test --filter=testMethodName           # single test
composer test                                      # clears config cache, then runs tests

# Code style (Laravel Pint, no custom pint.json — default preset)
vendor/bin/pint
vendor/bin/pint --test    # check only, no changes

# Digitail sync (also runs daily at 00:00 Asia/Jakarta via routes/console.php schedule)
php artisan digitail:sync {--clinic_id=}

# Filament admin
php artisan filament:user   # create an admin login
```

The DB in `.env.example` defaults to SQLite, but production/README setup targets **PostgreSQL**. Tests run against an in-memory SQLite DB regardless (`phpunit.xml`).

There are currently no Cursor/Copilot rule files in this repo.

## Architecture

This is a Laravel 12 app with a **Filament 5 admin panel** and a server-rendered public site (Blade + Vite + Tailwind v4), not an API-first SPA.

### Two distinct route surfaces (`routes/web.php`)

- **Public site**: `/`, locale switching, and `auth/*` — all handled by plain controllers returning JSON (for AJAX forms) or redirects.
- **Admin-only** (`middleware(['auth', 'admin'])`, `admin` = `EnsureUserIsAdmin`, checks `User::isAdmin()` i.e. `role === 'admin'`):
  - Filament panel at `/admin` (`AdminPanelProvider`, auto-discovers Resources/Pages/Widgets under `app/Filament/`).
  - `digitail/*` — an internal dashboard for manually testing Digitail API calls (`DigitailController`, `DigitailAuthController`).
  - `admin/digitail-sync/*` and `api/digitail/*` — sync trigger and a generic authenticated proxy to the Digitail API (`DigitailSyncController`, `DigitailApiController`). These exist for internal tooling, not end-user/customer consumption.

### Auth flow (custom, not Breeze/Fortify)

- `AuthController` implements signin/signup/OTP verification/resend/signout as **JSON-responding** endpoints consumed by AJAX forms in the Blade views — not Laravel's default `/login` redirect flow (that route is stubbed to redirect home).
- Signup requires OTP email verification (`OtpVerification` model) before the account is usable; unverified sign-in attempts are logged out and issued a fresh OTP. OTP has a 10-minute expiry and a max-attempts lockout (`OtpVerification::MAX_ATTEMPTS`).
- `auth/signin`, `verify-otp`, and `resend-otp` are throttled (`throttle:5,1` / `throttle:10,1`) to blunt brute-force/spam.
- Google OAuth (`GoogleController` via Socialite) links to an existing user by `google_id`, then falls back to matching by `email` — in the email-match case it **rotates the local password** to prevent a pre-existing/attacker-set password from remaining valid once Google ownership is confirmed, and auto-verifies the email.
- Every successful login path calls `$request->session()->regenerate()` (session-fixation protection) — this is easy to forget when adding new login paths.
- `role` on `User` is a plain string (`admin`/`user`); there's no separate roles/permissions package.

### Digitail integration (proxy pattern)

Digitail is an external vet-clinic platform. Its API is never called from the frontend directly:

- `DigitailService` owns OAuth2 (PKCE) token acquisition/refresh, stored in `DigitailToken`.
- `DigitailApiController` is a generic authenticated proxy (`ANY /api/digitail/{endpoint}`) plus a handful of named convenience endpoints (pets, pet-parents, vets, service-packages, etc.), all admin-gated.
- `SyncDigitailServices` (`digitail:sync` command) pulls service/pricing data from Digitail into the local `Service` model on a daily schedule; `Service` carries both site-authored fields (title, description, price) and raw Digitail fields (`digitail_id`, `visit_type_id`, `aaha_code`, etc.) side by side.
- Config lives in `config/services.php` under `digitail.*`, sourced from `DIGITAIL_*` env vars. See [README_API_DIGITAIL.md](README_API_DIGITAIL.md) for the full endpoint/security writeup.

### Localization

Session-based (not URL-prefixed) locale switching: `SetLocale` middleware (registered globally in `bootstrap/app.php`) reads locale from session each request, `LocaleController` writes it, `LocaleServiceProvider` shares it to views. Supported locales are hardcoded (`en`, `id`) in both the middleware and controller — keep them in sync if adding a language. See [LANGUAGE_SWITCHER.md](LANGUAGE_SWITCHER.md) for the full pattern and how to extend it. Filament forms use `spatie/laravel-translatable` (via `lara-zeus/spatie-translatable` plugin) for translatable fields like hero slide content.

### Filament resources

Every content type manageable in the admin (Articles, FAQs, HeroSlides, Memberships, News, Pricings, Promos, Services, Testimonials, Users) follows the same generated Filament 5 shape: `Resources/<Name>/`, containing `<Name>Resource.php`, `Pages/{Create,Edit,List}<Name>.php`, `Schemas/<Name>Form.php`, `Tables/<Name>sTable.php`. Follow this structure when adding a new resource (`php artisan make:filament-resource`).

### Not yet populated

`app/Repositories/` and `app/Traits/` exist (per the README's documented structure) but currently contain only `.gitkeep` — no repository or trait classes have been added yet. `tests/Feature` and `tests/Unit` currently only contain the framework's default `ExampleTest.php` stubs; there is no real test coverage for auth, Digitail sync, or Filament resources yet.
