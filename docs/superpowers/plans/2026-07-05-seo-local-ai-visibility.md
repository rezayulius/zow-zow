# SEO & AI Answer-Engine Visibility Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Improve ZOW Vetique's visibility for "vet terdekat" / "klinik hewan terdekat" queries in Google Search/Maps and in AI answer engines (ChatGPT, Perplexity, Gemini, etc.), by shoring up structured data, crawler access, and local-keyword content on the existing single-page site.

**Architecture:** No new routes or pages. All changes are to existing Blade views (`layouts/app.blade.php`, `partials/hero.blade.php`, `partials/location.blade.php`, `partials/testimonials.blade.php`), two static public files (`robots.txt`, new `llms.txt`), and removal of one unused dead view. Structured data (`FAQPage`, `aggregateRating`) is generated from data the app already loads (`$faqs`, `GooglePlacesService`) — never hardcoded.

**Tech Stack:** Laravel 12 Blade views, PHP `json_encode` for JSON-LD, plain-text `robots.txt`/`llms.txt` in `public/`.

## Global Constraints

- No new routes/pages — site stays single-page (`HomeController::index()` → `home.blade.php`). Confirmed in [[2026-07-05-seo-local-ai-visibility-design]].
- Do NOT restructure the multiple `<h1>` tags in `hero.blade.php` / `services.blade.php` — explicitly out of scope per user decision.
- `aggregateRating` must come only from live `GooglePlacesService::getReviews()` data (`rating` + `user_ratings_total` both present). If either is null/missing, omit the field entirely — never a hardcoded or fallback number.
- Local-area targeting list (used consistently across schema and copy): Jakarta Selatan, Kebayoran Baru, Pulo, Prapanca, Kemang, Cilandak, Pondok Indah, Senayan, DKI Jakarta.
- CMS-owned data (`Testimonial`, `Service`, `Pricing`, `Membership`, `HeroSlide`, `Faq` records themselves) is never edited directly in this plan — only the static Blade copy around it.
- Verification for every task is static/local (file diff review, `grep`/`cat` output, `php artisan view:cache` as a Blade syntax smoke test). No live app boot / DB-backed page load — local `.env` exists (sqlite) but a pre-existing, unrelated migration (`2026_07_05_174047_translate_hero_slides_content_to_json.php`) uses Postgres-only SQL and fails on sqlite, so the app cannot currently be fully migrated locally. Do not attempt to fix that migration as part of this plan.
- Repo already has `.env` (sqlite) and `APP_KEY` set locally for this work; `php artisan view:cache` works without full migration.

---

### Task 1: Remove dead `welcome.blade.php`

**Files:**
- Delete: `resources/views/welcome.blade.php`

**Interfaces:**
- Consumes: nothing (this view is not referenced by any route or `view()` call).
- Produces: nothing — pure removal.

- [ ] **Step 1: Confirm the file is truly unreferenced**

Run: `grep -rn "welcome" routes/ app/Http/Controllers/ 2>/dev/null`
Expected: no output (no route or controller renders `view('welcome')`).

- [ ] **Step 2: Delete the file**

```bash
git rm resources/views/welcome.blade.php
```

- [ ] **Step 3: Verify it's gone and nothing else breaks**

Run: `test ! -f resources/views/welcome.blade.php && echo "removed"`
Expected: `removed`

Run: `php artisan view:clear && php artisan view:cache`
Expected: `Compiled views cleared successfully.` then `Blade templates cached successfully.` (no errors — proves no other view `@include`s or `@extends` the deleted file).

- [ ] **Step 4: Commit**

```bash
git add resources/views/welcome.blade.php
git commit -m "$(cat <<'EOF'
Remove unused welcome.blade.php scaffold view

Not referenced by any route (HomeController renders home.blade.php).
Contained stale brand name and wrong address that risked confusing
future edits.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 2: Explicit AI-crawler allowances in `robots.txt`

**Files:**
- Modify: `public/robots.txt`

**Interfaces:**
- Consumes: nothing.
- Produces: nothing — static file read directly by crawlers.

- [ ] **Step 1: Read current content to confirm baseline**

Run: `cat public/robots.txt`
Expected:
```
User-agent: *
Allow: /

Sitemap: https://zowvetique.com/sitemap.xml
```

- [ ] **Step 2: Replace with explicit AI-crawler stanzas**

Replace the full file content with:

```
User-agent: *
Allow: /

User-agent: GPTBot
Allow: /

User-agent: ChatGPT-User
Allow: /

User-agent: OAI-SearchBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: Claude-Web
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Google-Extended
Allow: /

User-agent: Applebot-Extended
Allow: /

User-agent: CCBot
Allow: /

Sitemap: https://zowvetique.com/sitemap.xml
```

- [ ] **Step 3: Verify content**

Run: `grep -c "^User-agent:" public/robots.txt`
Expected: `10`

Run: `grep "Sitemap:" public/robots.txt`
Expected: `Sitemap: https://zowvetique.com/sitemap.xml`

- [ ] **Step 4: Commit**

```bash
git add public/robots.txt
git commit -m "$(cat <<'EOF'
Explicitly allow AI crawlers in robots.txt

The wildcard already permitted every bot, but naming GPTBot, ClaudeBot,
PerplexityBot, Google-Extended, etc. explicitly future-proofs against a
later narrowly-scoped Disallow accidentally blocking AI answer engines.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 3: New `public/llms.txt`

**Files:**
- Create: `public/llms.txt`

**Interfaces:**
- Consumes: nothing.
- Produces: nothing — static file for AI agents/crawlers to fetch directly.

- [ ] **Step 1: Create the file**

```
# ZOW Vetique

> Klinik hewan (veterinary clinic) di Prapanca, Kebayoran Baru, Jakarta Selatan — konsultasi dokter hewan, vaksinasi, sterilisasi, grooming, laboratorium, terapi lanjutan, pet hotel, dan emergency care 24 jam untuk kucing, anjing, dan hewan peliharaan lainnya.

ZOW Vetique adalah klinik hewan terdekat dan vet terdekat untuk warga Kebayoran Baru, Kemang, Cilandak, Pondok Indah, Senayan, dan sekitar Jakarta Selatan. Buka setiap hari 07:00–22:00 WIB, dengan layanan emergency call di luar jam tersebut.

## Alamat & Kontak

- Alamat: Jl. Prapanca Raya No.25A, RT.2/RW.3, Pulo, Kec. Kby. Baru, Kota Jakarta Selatan, DKI Jakarta 12160
- Telepon: +62 812 1908 8899
- Emergency 24/7: +62 812 9591 1911
- Email: support@zowvetique.com
- Instagram: https://www.instagram.com/zowvetclinic/

## Layanan

- [Layanan & Kesehatan](https://zowvetique.com/#health): konsultasi dokter hewan, vaksinasi, sterilisasi (steril kucing/anjing), grooming, laboratorium, terapi lanjutan.
- [Booking & Membership](https://zowvetique.com/#booking): paket harga dan program keanggotaan.
- [Testimoni & FAQ](https://zowvetique.com/#testimoni): ulasan pelanggan dan pertanyaan yang sering diajukan.
- [Lokasi](https://zowvetique.com/#lokasi): peta, jam buka, dan info kontak klinik.

## Full page

- [ZOW Vetique — halaman utama](https://zowvetique.com/)
```

- [ ] **Step 2: Verify content**

Run: `head -1 public/llms.txt`
Expected: `# ZOW Vetique`

Run: `grep -c "^## " public/llms.txt`
Expected: `3`

- [ ] **Step 3: Commit**

```bash
git add public/llms.txt
git commit -m "$(cat <<'EOF'
Add llms.txt for AI agent/crawler discovery

Summarizes business, service area, contact info, and links to the
site's main sections, following the llms.txt convention, to help AI
answer engines cite ZOW Vetique accurately for local vet queries.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 4: `FAQPage` JSON-LD from live `$faqs` data

**Files:**
- Modify: `resources/views/partials/testimonials.blade.php:404-423` (FAQ tab block)

**Interfaces:**
- Consumes: `$faqs` — an `Illuminate\Database\Eloquent\Collection<\App\Models\Faq>` already passed into `home.blade.php` by `HomeController::index()` (each item has `->question: string` and `->answer: string`, the latter containing HTML).
- Produces: a `FAQPage` JSON-LD block pushed to the `json-ld` stack, rendered in `<head>` by `layouts/app.blade.php:177` (`@stack('json-ld')`).

- [ ] **Step 1: Confirm current FAQ block content (baseline)**

Run: `sed -n '404,423p' resources/views/partials/testimonials.blade.php`
Expected: the `@forelse($faqs as $faq) ... @endforelse` block ending in:
```php
                @empty
                    <div class="text-center py-12 text-carob-500">No FAQs available yet.</div>
                @endforelse
            </div>
        </div>
```

- [ ] **Step 2: Insert the `FAQPage` schema push**

In `resources/views/partials/testimonials.blade.php`, find:

```php
                @empty
                    <div class="text-center py-12 text-carob-500">No FAQs available yet.</div>
                @endforelse
            </div>
        </div>
```

Replace with:

```php
                @empty
                    <div class="text-center py-12 text-carob-500">No FAQs available yet.</div>
                @endforelse
            </div>

            @if($faqs->isNotEmpty())
                @push('json-ld')
                    @php
                        $faqSchema = [
                            '@context' => 'https://schema.org',
                            '@type' => 'FAQPage',
                            'mainEntity' => $faqs->map(function ($faq) {
                                return [
                                    '@type' => 'Question',
                                    'name' => $faq->question,
                                    'acceptedAnswer' => [
                                        '@type' => 'Answer',
                                        'text' => strip_tags($faq->answer),
                                    ],
                                ];
                            })->values()->all(),
                        ];
                    @endphp
                    <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
                @endpush
            @endif
        </div>
```

- [ ] **Step 3: Verify Blade syntax compiles**

Run: `php artisan view:clear && php artisan view:cache`
Expected: `Compiled views cleared successfully.` then `Blade templates cached successfully.` (no `ParseError` / `CompileException`).

- [ ] **Step 4: Verify the schema-building code is present and correctly scoped**

Run: `grep -n "FAQPage\|faqSchema\|strip_tags(\$faq->answer)" resources/views/partials/testimonials.blade.php`
Expected: 4 matching lines (the `'@type' => 'FAQPage'` line, the `$faqSchema = [` assignment, the `strip_tags($faq->answer)` line, and the `<script>` line referencing `$faqSchema` again) — all inside the `@if($faqs->isNotEmpty())` block added above.

- [ ] **Step 5: Commit**

```bash
git add resources/views/partials/testimonials.blade.php
git commit -m "$(cat <<'EOF'
Emit FAQPage JSON-LD from live FAQ data

Builds the schema directly from $faqs (same data already rendered in
the FAQ tab), so it can never drift from what's visibly on the page.
Skipped entirely when there are no active FAQs.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 5: Live `aggregateRating` on the sitewide `VeterinaryCare` schema

**Files:**
- Modify: `resources/views/layouts/app.blade.php:9-15` (`@php` header block)
- Modify: `resources/views/layouts/app.blade.php:74-75` (JSON-LD, insert after `priceRange`)

**Interfaces:**
- Consumes: `App\Services\GooglePlacesService::getReviews(): ?array` — returns `null` if `GOOGLE_PLACES_API_KEY`/`GOOGLE_PLACES_PLACE_ID` aren't configured, otherwise an array with keys `rating` (float|null), `user_ratings_total` (int|null), among others.
- Produces: an `aggregateRating` key inside the existing sitewide `VeterinaryCare` JSON-LD, present only when live rating data exists.

- [ ] **Step 1: Confirm current `@php` header block (baseline)**

Run: `sed -n '9,15p' resources/views/layouts/app.blade.php`
Expected:
```php
  @php
    $pageTitle = trim((string) $__env->yieldContent('title')) ?: 'Klinik Hewan Jakarta Selatan | ZOW Vetique Kemang';
    $pageDescription = trim((string) $__env->yieldContent('meta_description')) ?: 'ZOW Vetique adalah klinik hewan di Kemang, Jakarta Selatan, menyediakan konsultasi dokter hewan, vaksinasi, steril, grooming, lab, terapi, pet spa, penitipan, dan emergency care.';
    $pageCanonical = trim((string) $__env->yieldContent('canonical')) ?: url()->current();
    $pageOgImage = trim((string) $__env->yieldContent('og_image')) ?: 'https://zowvetique.com/images/logo/zow-vet-logo-brown.png';
    $pageRobots = trim((string) $__env->yieldContent('robots')) ?: 'index, follow';
  @endphp
```

- [ ] **Step 2: Fetch live Google Places data in the header block**

Find:
```php
    $pageRobots = trim((string) $__env->yieldContent('robots')) ?: 'index, follow';
  @endphp
```

Replace with:
```php
    $pageRobots = trim((string) $__env->yieldContent('robots')) ?: 'index, follow';
    $googleReviews = app(\App\Services\GooglePlacesService::class)->getReviews();
  @endphp
```

- [ ] **Step 3: Confirm current JSON-LD lines around `priceRange` (baseline)**

Run: `sed -n '73,76p' resources/views/layouts/app.blade.php`
Expected:
```
    "slogan": "Klinik Hewan dengan Hati Keluarga",
    "telephone": "+6281295911911",
    "priceRange": "$$",
    "address": {
```

- [ ] **Step 4: Insert conditional `aggregateRating`**

Find:
```
    "priceRange": "$$",
    "address": {
```

Replace with:
```
    "priceRange": "$$",
@if(($googleReviews['rating'] ?? null) && ($googleReviews['user_ratings_total'] ?? null))
    "aggregateRating": {
      "@@type": "AggregateRating",
      "ratingValue": {{ $googleReviews['rating'] }},
      "reviewCount": {{ $googleReviews['user_ratings_total'] }}
    },
@endif
    "address": {
```

- [ ] **Step 5: Verify Blade syntax compiles**

Run: `php artisan view:clear && php artisan view:cache`
Expected: `Compiled views cleared successfully.` then `Blade templates cached successfully.` (no errors).

- [ ] **Step 6: Verify the guard is warning-safe and correctly placed**

Run: `grep -n "googleReviews\|aggregateRating" resources/views/layouts/app.blade.php`
Expected: 5 matching lines — the `$googleReviews` fetch, the `@if` guard line (using `??` before the truthiness check, never raw `$googleReviews['rating']`), the `"aggregateRating": {` line, the `ratingValue` line, and the `reviewCount` line.

- [ ] **Step 7: Commit**

```bash
git add resources/views/layouts/app.blade.php
git commit -m "$(cat <<'EOF'
Add live aggregateRating to sitewide VeterinaryCare schema

Sourced from the same GooglePlacesService data already used for the
on-page Google Reviews section. Omitted entirely when no API
key/place ID is configured — never a hardcoded rating.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 6: Expand default title/meta description and `areaServed` for local-keyword coverage

**Files:**
- Modify: `resources/views/layouts/app.blade.php:10-11` (default title/description)
- Modify: `resources/views/layouts/app.blade.php:85-92` (JSON-LD `areaServed`)

**Interfaces:**
- Consumes: nothing new.
- Produces: nothing consumed elsewhere — page-level `<title>`/`<meta description>` and schema `areaServed`.

- [ ] **Step 1: Confirm current default title/description (baseline)**

Run: `sed -n '10,11p' resources/views/layouts/app.blade.php`
Expected:
```php
    $pageTitle = trim((string) $__env->yieldContent('title')) ?: 'Klinik Hewan Jakarta Selatan | ZOW Vetique Kemang';
    $pageDescription = trim((string) $__env->yieldContent('meta_description')) ?: 'ZOW Vetique adalah klinik hewan di Kemang, Jakarta Selatan, menyediakan konsultasi dokter hewan, vaksinasi, steril, grooming, lab, terapi, pet spa, penitipan, dan emergency care.';
```

- [ ] **Step 2: Update the default title and description**

Find:
```php
    $pageTitle = trim((string) $__env->yieldContent('title')) ?: 'Klinik Hewan Jakarta Selatan | ZOW Vetique Kemang';
    $pageDescription = trim((string) $__env->yieldContent('meta_description')) ?: 'ZOW Vetique adalah klinik hewan di Kemang, Jakarta Selatan, menyediakan konsultasi dokter hewan, vaksinasi, steril, grooming, lab, terapi, pet spa, penitipan, dan emergency care.';
```

Replace with:
```php
    $pageTitle = trim((string) $__env->yieldContent('title')) ?: 'Klinik Hewan Terdekat di Jakarta Selatan | ZOW Vetique Kemang';
    $pageDescription = trim((string) $__env->yieldContent('meta_description')) ?: 'ZOW Vetique adalah klinik hewan & vet terdekat di Kebayoran Baru, Kemang, Cilandak, Pondok Indah, dan Senayan, Jakarta Selatan — konsultasi dokter hewan, vaksinasi, steril, grooming, lab, terapi, pet hotel, dan emergency care 24 jam.';
```

- [ ] **Step 3: Confirm current `areaServed` (baseline)**

Run: `sed -n '85,92p' resources/views/layouts/app.blade.php`
Expected:
```
    "areaServed": [
      "Jakarta Selatan",
      "Kebayoran Baru",
      "Pulo",
      "Prapanca",
      "Kemang",
      "DKI Jakarta"
    ],
```

- [ ] **Step 4: Expand `areaServed`**

Find:
```
    "areaServed": [
      "Jakarta Selatan",
      "Kebayoran Baru",
      "Pulo",
      "Prapanca",
      "Kemang",
      "DKI Jakarta"
    ],
```

Replace with:
```
    "areaServed": [
      "Jakarta Selatan",
      "Kebayoran Baru",
      "Pulo",
      "Prapanca",
      "Kemang",
      "Cilandak",
      "Pondok Indah",
      "Senayan",
      "DKI Jakarta"
    ],
```

- [ ] **Step 5: Verify Blade syntax compiles**

Run: `php artisan view:clear && php artisan view:cache`
Expected: `Compiled views cleared successfully.` then `Blade templates cached successfully.` (no errors).

- [ ] **Step 6: Verify new copy is present**

Run: `grep -n "Klinik Hewan Terdekat di Jakarta Selatan\|vet terdekat\|Cilandak\|Pondok Indah\|Senayan" resources/views/layouts/app.blade.php`
Expected: matches for the new title, the description's "vet terdekat" phrase, and all three new `areaServed` entries.

- [ ] **Step 7: Commit**

```bash
git add resources/views/layouts/app.blade.php
git commit -m "$(cat <<'EOF'
Expand default SEO metadata and areaServed for local keyword coverage

Default title/description now target "vet terdekat"/"klinik hewan
terdekat" phrasing, and areaServed grows to include Cilandak, Pondok
Indah, and Senayan alongside the existing Kebayoran Baru/Kemang area.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 7: Local-keyword sub-copy line in the hero section

**Files:**
- Modify: `resources/views/partials/hero.blade.php:128-136` (per-slide loop)
- Modify: `resources/views/partials/hero.blade.php:193-199` (`@empty` fallback)

**Interfaces:**
- Consumes: nothing.
- Produces: nothing — purely additive static copy, no new `<h1>`.

- [ ] **Step 1: Confirm current per-slide description block (baseline)**

Run: `sed -n '128,136p' resources/views/partials/hero.blade.php`
Expected:
```php
                                    <p class="text-base sm:text-xl text-deep-cocoa-brown-600 leading-relaxed font-light hidden sm:block">
                                        {{ $slide->description }}
                                    </p>
                                    <p class="text-sm text-deep-cocoa-brown-600 leading-relaxed font-light sm:hidden line-clamp-3">
                                        {{ $slide->description }}
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto px-4 sm:px-0">
```

- [ ] **Step 2: Add the sub-copy line after the slide description**

Find:
```php
                                    <p class="text-sm text-deep-cocoa-brown-600 leading-relaxed font-light sm:hidden line-clamp-3">
                                        {{ $slide->description }}
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto px-4 sm:px-0">
```

Replace with:
```php
                                    <p class="text-sm text-deep-cocoa-brown-600 leading-relaxed font-light sm:hidden line-clamp-3">
                                        {{ $slide->description }}
                                    </p>
                                    <p class="text-xs sm:text-sm font-semibold text-forest-moss-green-600 uppercase tracking-wide">
                                        Klinik hewan terdekat di Jakarta Selatan — melayani Kebayoran Baru, Kemang, Cilandak, Pondok Indah & Senayan
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto px-4 sm:px-0">
```

- [ ] **Step 3: Confirm current `@empty` fallback block (baseline)**

Run: `sed -n '192,199p' resources/views/partials/hero.blade.php`
Expected:
```php
        @empty
            <!-- Fallback if no slides -->
            <div class="slide active absolute inset-0 w-full h-full z-10 flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-deep-cocoa-brown-800">Welcome to Zow Vetique</h1>
                    <p class="text-xl text-deep-cocoa-brown-600 mt-4">A Second Home for Your Pet</p>
                </div>
            </div>
        @endforelse
```

- [ ] **Step 4: Add the same sub-copy line to the fallback**

Find:
```php
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-deep-cocoa-brown-800">Welcome to Zow Vetique</h1>
                    <p class="text-xl text-deep-cocoa-brown-600 mt-4">A Second Home for Your Pet</p>
                </div>
```

Replace with:
```php
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-deep-cocoa-brown-800">Welcome to Zow Vetique</h1>
                    <p class="text-xl text-deep-cocoa-brown-600 mt-4">A Second Home for Your Pet</p>
                    <p class="text-sm font-semibold text-forest-moss-green-600 uppercase tracking-wide mt-2">
                        Klinik hewan terdekat di Jakarta Selatan — melayani Kebayoran Baru, Kemang, Cilandak, Pondok Indah & Senayan
                    </p>
                </div>
```

- [ ] **Step 5: Verify Blade syntax compiles**

Run: `php artisan view:clear && php artisan view:cache`
Expected: `Compiled views cleared successfully.` then `Blade templates cached successfully.` (no errors).

- [ ] **Step 6: Verify both insertions are present and no new `<h1>` was added**

Run: `grep -c "Klinik hewan terdekat di Jakarta Selatan" resources/views/partials/hero.blade.php`
Expected: `2`

Run: `grep -c "<h1" resources/views/partials/hero.blade.php`
Expected: `2` (unchanged from before this task — confirms no new `<h1>` was introduced).

- [ ] **Step 7: Commit**

```bash
git add resources/views/partials/hero.blade.php
git commit -m "$(cat <<'EOF'
Add local-keyword sub-copy to hero section

Static line naming "klinik hewan terdekat di Jakarta Selatan" and the
target area list, added as a <p> (not a new <h1>, per scope) to both
the slide loop and the no-slides fallback.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 8: Broaden area description copy in the location section

**Files:**
- Modify: `resources/views/partials/location.blade.php:27-29`

**Interfaces:**
- Consumes: nothing.
- Produces: nothing.

- [ ] **Step 1: Confirm current copy (baseline)**

Run: `sed -n '27,29p' resources/views/partials/location.blade.php`
Expected:
```php
            <p class="text-lg text-carob-600 leading-relaxed">
                A safe, comfortable, and warm environment in the heart of Kemang. Drop by for a check-up, a grooming session, or just to say hi!
            </p>
```

- [ ] **Step 2: Update the copy**

Find:
```php
            <p class="text-lg text-carob-600 leading-relaxed">
                A safe, comfortable, and warm environment in the heart of Kemang. Drop by for a check-up, a grooming session, or just to say hi!
            </p>
```

Replace with:
```php
            <p class="text-lg text-carob-600 leading-relaxed">
                A safe, comfortable, and warm environment in Kebayoran Baru — easy to reach from Kemang, Cilandak, Pondok Indah, and Senayan. Drop by for a check-up, a grooming session, or just to say hi!
            </p>
```

- [ ] **Step 3: Verify Blade syntax compiles**

Run: `php artisan view:clear && php artisan view:cache`
Expected: `Compiled views cleared successfully.` then `Blade templates cached successfully.` (no errors).

- [ ] **Step 4: Verify new copy is present**

Run: `grep -n "Kebayoran Baru — easy to reach from Kemang, Cilandak, Pondok Indah, and Senayan" resources/views/partials/location.blade.php`
Expected: one match.

- [ ] **Step 5: Commit**

```bash
git add resources/views/partials/location.blade.php
git commit -m "$(cat <<'EOF'
Broaden location section copy to named nearby areas

Extends the intro line from "the heart of Kemang" to also name
Kebayoran Baru, Cilandak, Pondok Indah, and Senayan, matching the
expanded areaServed schema and local-keyword targeting.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 9: Descriptive alt text for the hero secondary image

**Files:**
- Modify: `resources/views/partials/hero.blade.php:178-182`

**Interfaces:**
- Consumes: nothing.
- Produces: nothing.

- [ ] **Step 1: Confirm current markup (baseline)**

Run: `sed -n '178,182p' resources/views/partials/hero.blade.php`
Expected:
```php
                                @if($secondaryImage)
                                <div class="absolute top-[5%] right-[5%] sm:right-[15%] lg:right-0 w-[35%] sm:w-[30%] lg:w-[60%] aspect-square rounded-[2rem] overflow-hidden shadow-xl {{ $c['secondary_blob_shadow'] }} rotate-[6deg] opacity-90 transition-all duration-700 group-hover:rotate-[3deg] group-hover:translate-x-4 border-[4px] sm:border-[6px] border-white z-0 hidden sm:block">
                                     <img src="{{ $secondaryImage }}" alt="Detail" class="w-full h-full object-cover">
                                </div>
                                @endif
```

- [ ] **Step 2: Replace the generic alt text**

Find:
```php
                                     <img src="{{ $secondaryImage }}" alt="Detail" class="w-full h-full object-cover">
```

Replace with:
```php
                                     <img src="{{ $secondaryImage }}" alt="Fasilitas ZOW Vetique, klinik hewan terdekat di Jakarta Selatan" class="w-full h-full object-cover">
```

- [ ] **Step 3: Verify Blade syntax compiles**

Run: `php artisan view:clear && php artisan view:cache`
Expected: `Compiled views cleared successfully.` then `Blade templates cached successfully.` (no errors).

- [ ] **Step 4: Verify the change**

Run: `grep -n 'alt="Detail"' resources/views/partials/hero.blade.php`
Expected: no output (old generic alt text is gone).

Run: `grep -n "Fasilitas ZOW Vetique" resources/views/partials/hero.blade.php`
Expected: one match.

- [ ] **Step 5: Commit**

```bash
git add resources/views/partials/hero.blade.php
git commit -m "$(cat <<'EOF'
Add descriptive alt text to hero secondary image

Replaces the generic "Detail" alt attribute with a description that
names the clinic and local intent, without keyword-stuffing.

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

### Task 10: FAQ content-gap suggestions for Filament admin entry

**Files:**
- Create: `docs/superpowers/plans/2026-07-05-seo-faq-suggestions.md`

**Interfaces:**
- Consumes: nothing (this is a content deliverable, not code).
- Produces: nothing consumed by code — a reference document for the user to manually copy into the `Faq` Filament resource.

- [ ] **Step 1: Create the suggestions file**

```markdown
# Suggested FAQ additions for local-intent coverage

These are suggested Q&A pairs to add via the Filament admin (Faq
resource) to fill local-search-intent gaps. Check them against the
FAQs already live in production first to avoid duplicates — this list
was written without access to the production database.

1. **Q: Dimana klinik hewan terdekat di Jakarta Selatan yang bisa saya kunjungi?**
   A: ZOW Vetique berlokasi di Jl. Prapanca Raya No.25A, Pulo, Kebayoran
   Baru, Jakarta Selatan — mudah dijangkau dari Kemang, Cilandak, Pondok
   Indah, dan Senayan. Kami buka setiap hari pukul 07:00–22:00 WIB.

2. **Q: Apakah ZOW Vetique melayani area di luar Kebayoran Baru dan Kemang?**
   A: Ya, banyak pelanggan kami datang dari Cilandak, Pondok Indah,
   Senayan, dan area lain di Jakarta Selatan. Kami juga menyediakan
   layanan emergency call untuk kondisi darurat.

3. **Q: Apakah ZOW Vetique buka untuk keadaan darurat (emergency) 24 jam?**
   A: Layanan emergency call kami dapat dihubungi di luar jam operasional
   reguler (07:00–22:00 WIB) untuk kondisi darurat seperti sesak napas,
   kejang, pendarahan, atau kecelakaan pada hewan peliharaan.

4. **Q: Layanan apa saja yang tersedia di ZOW Vetique?**
   A: Konsultasi dokter hewan, vaksinasi, sterilisasi (steril kucing dan
   anjing), grooming, laboratorium, terapi lanjutan, pet hotel, dan
   emergency care.

5. **Q: Bagaimana cara membuat janji temu (booking) di ZOW Vetique?**
   A: Anda bisa menghubungi kami melalui WhatsApp atau telepon di nomor
   yang tercantum di halaman Kontak, atau datang langsung ke klinik pada
   jam operasional.
```

- [ ] **Step 2: Verify the file was written**

Run: `test -f "docs/superpowers/plans/2026-07-05-seo-faq-suggestions.md" && echo "created"`
Expected: `created`

Run: `grep -c "^[0-9]\. \*\*Q:" "docs/superpowers/plans/2026-07-05-seo-faq-suggestions.md"`
Expected: `5`

- [ ] **Step 3: Commit**

```bash
git add "docs/superpowers/plans/2026-07-05-seo-faq-suggestions.md"
git commit -m "$(cat <<'EOF'
Add suggested FAQ content for local search intent

Reference doc with 5 suggested Q&A pairs targeting "vet terdekat" /
"klinik hewan terdekat" intent, for manual entry via the Filament Faq
resource (FAQ content is CMS-owned, not edited directly in code).

Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>
EOF
)"
```

---

## Final verification (after all tasks)

- [ ] Run: `php artisan view:clear && php artisan view:cache` — expect success with no errors, confirming every touched Blade file across all 10 tasks still compiles together.
- [ ] Run: `git log --oneline -10` — expect 10 commits, one per task above, in order.
- [ ] Manually paste the `VeterinaryCare` JSON-LD block (`resources/views/layouts/app.blade.php`) and the new `FAQPage` block (built from a couple of sample `$faq` rows) into Google's Rich Results Test or schema.org validator to confirm both are valid — do this once production `.env` has `GOOGLE_PLACES_API_KEY`/`GOOGLE_PLACES_PLACE_ID` set and real FAQ rows exist, since local verification here was static-only (see Global Constraints).
