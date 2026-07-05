# SEO & AI Answer-Engine Visibility — Local Search Design

## Goal

Improve ZOW Vetique's chances of appearing (a) in Google Search/Maps for
queries like "vet terdekat" / "klinik hewan terdekat" in South Jakarta, and
(b) in AI answer engines (ChatGPT, Perplexity, Gemini, etc.) for the same
kind of question.

## Background / current state

- The public site is effectively single-page: `HomeController::index()`
  renders `resources/views/home.blade.php`, which `@include`s
  `partials/{header,hero,services,pricing,membership,testimonials,location,footer}.blade.php`.
  `resources/views/welcome.blade.php` is **dead code** — no route renders it —
  but contains a stale brand name ("PetWellness Hub") and a wrong address
  ("Jl. Sudirman No. 123, Menteng"), left over from an early scaffold.
- `layouts/app.blade.php` already has decent groundwork: canonical URL, OG/Twitter
  tags, robots meta, and a sitewide `VeterinaryCare` JSON-LD block (name, address,
  areaServed, opening hours, offer catalog). It reserves a `@stack('json-ld')`
  slot for page-specific structured data (comment mentions `FAQPage`), but nothing
  currently pushes to it.
- `Faq` is a real Eloquent model with active/ordered scopes; `HomeController`
  already loads `$faqs` and passes it to the view, rendered in a FAQ tab inside
  `partials/testimonials.blade.php`. No `FAQPage` JSON-LD is emitted for it today.
- `GooglePlacesService` already fetches live rating/review data via the Google
  Places Details API (`GOOGLE_PLACES_API_KEY` / `GOOGLE_PLACES_PLACE_ID` env vars),
  cached and rendered as real reviews on the page. This data is not yet reflected
  in the `VeterinaryCare` schema's `aggregateRating`.
- `public/robots.txt` is `User-agent: *` / `Allow: /` — this already permits every
  crawler, including AI bots (GPTBot, ClaudeBot, PerplexityBot, etc.), since
  nothing is disallowed. There is no `llms.txt`.
- `public/sitemap.xml` lists only `/`, which matches the single-page structure.
- `hero.blade.php` and `services.blade.php` each contain more than one `<h1>`.
  This is a known SEO wart but is explicitly **out of scope** for this pass per
  user decision (see Decisions below).

## Decisions made during brainstorming

- Scope: technical on-page SEO + local keyword content + AI answer-engine
  visibility (GEO). Off-page work (Google Business Profile, citations,
  backlinks) is advisory only — not executed as part of this work.
- Google Business Profile status is unconfirmed by the user ("belum ada /
  tidak yakin"), despite the codebase already being wired for live Google
  Places reviews. This needs the user to verify `.env` production config and
  GBP claim/verification status independently.
- Site stays single-page (no new routes/pages) — reinforce existing content
  instead of fragmenting into per-service/per-area pages.
- Target area expands beyond Prapanca/Kebayoran Baru/Kemang to broader South
  Jakarta (Cilandak, Pondok Indah, Senayan) — accepting that "terdekat"
  relevance weakens the further out content reaches.
- AI crawlers: explicitly allow all (GPTBot, ChatGPT-User, OAI-SearchBot,
  ClaudeBot, Claude-Web, PerplexityBot, Google-Extended, Applebot-Extended,
  CCBot) in `robots.txt`, plus add `llms.txt`.
- Do **not** touch the multiple `<h1>` structure in `hero.blade.php` /
  `services.blade.php` in this pass.
- `aggregateRating` must only be emitted from live Google Places data already
  fetched by `GooglePlacesService`; if the API key/place ID isn't configured
  (service returns null), the field is omitted entirely — never a hardcoded
  or fallback rating.
- Work proceeds in two ordered phases: technical foundation first, then
  local-keyword content on top of it.

## Phase 1 — Technical foundation

1. **`FAQPage` JSON-LD**
   - Reuse `$faqs` (`Faq::active()->ordered()`, already loaded by
     `HomeController::index()` and passed to `home.blade.php`).
   - From the FAQ tab markup in `partials/testimonials.blade.php`, `@push('json-ld')`
     a `FAQPage` block whose `mainEntity` is built directly from `$faqs`
     (`Question` / `acceptedAnswer` pairs), so the schema always matches
     what's rendered — no separate copy to keep in sync.

2. **`aggregateRating` on the sitewide `VeterinaryCare` schema**
   - `layouts/app.blade.php` doesn't currently receive `$googleReviews`. Fetch
     it in the layout's existing `@php` block (same pattern already used for
     title/description defaults), via `app(GooglePlacesService::class)->getReviews()`.
   - Add `aggregateRating` (`ratingValue`, `reviewCount`) to the JSON-LD only
     when `rating` and `user_ratings_total` are both present and non-null.
     Omit the key entirely otherwise — no fallback/placeholder numbers.

3. **`robots.txt` — explicit AI crawler allowances**
   - Add explicit `User-agent` / `Allow: /` stanzas for: `GPTBot`,
     `ChatGPT-User`, `OAI-SearchBot`, `ClaudeBot`, `Claude-Web`,
     `PerplexityBot`, `Google-Extended`, `Applebot-Extended`, `CCBot`.
   - No functional change (wildcard already allows everything) — this is
     explicit/future-proofing so a later narrowly-scoped `Disallow` doesn't
     accidentally catch AI bots.

4. **New `public/llms.txt`**
   - Markdown file following the llms.txt convention: H1 with business name,
     one-line blockquote summary, then sections/links for: what ZOW Vetique
     is, address & service area, opening hours, core services, FAQ link,
     contact info.

5. **Delete `resources/views/welcome.blade.php`**
   - Confirmed unreferenced by any route. Remove to eliminate the stale
     brand/address content as a source of future confusion.

## Phase 2 — Local keyword content

1. **Titles & meta descriptions** (`layouts/app.blade.php` defaults, and any
   page-level `@section('title')` / `@section('meta_description')` overrides)
   — work in "vet terdekat" / "klinik hewan terdekat" phrasing and the wider
   area list without keyword-stuffing.

2. **`partials/hero.blade.php`** — add one sub-copy line (not a new `<h1>`)
   naming "klinik hewan terdekat di Jakarta Selatan" above the fold.

3. **`partials/location.blade.php` / `partials/footer.blade.php`** — extend
   the area description from "Kemang" alone to naturally include Kebayoran
   Baru, Cilandak, Pondok Indah, Senayan.

4. **`areaServed` in the `VeterinaryCare` JSON-LD** (`layouts/app.blade.php`)
   — add the same new areas (Cilandak, Pondok Indah, Senayan) alongside the
   existing Jakarta Selatan / Kebayoran Baru / Pulo / Prapanca / Kemang / DKI
   Jakarta list.

5. **FAQ content gaps** — review existing `Faq` records (via Filament/DB) for
   coverage of local-intent questions (e.g. "klinik hewan terdekat di Jakarta
   Selatan mana yang buka 24 jam"). Since this is CMS-owned content, produce
   concrete suggested Q&A text for the user to add via the Filament admin
   rather than editing DB data directly.

6. **Alt text** — review and improve generic `alt` attributes on
   location/hero imagery to be descriptive (and location-relevant where
   natural), without stuffing keywords.

Data-backed sections (`testimonials`, `services`, `pricing`, `membership`) are
CMS-owned (Filament) and are not edited directly — only the surrounding static
blade copy is in scope.

## Verification

- Validate emitted JSON-LD (`FAQPage`, updated `VeterinaryCare` with
  `aggregateRating`/`areaServed`) against Google's Rich Results Test /
  schema.org validator using the rendered HTML output.
- `php artisan test` stays green (no dedicated SEO test coverage exists;
  this is a regression sanity check only).
- Manually load the home page locally: confirm layout isn't broken by new
  copy, and that `/robots.txt` and `/llms.txt` are reachable and well-formed.

## Off-page guidance (manual, not implemented here)

- Claim/complete Google Business Profile: category "Veterinary care", service
  area, hours, real photos, review requests.
- Ensure NAP (Name, Address, Phone) on GBP matches the site's schema/footer
  exactly.
- Confirm production `.env` has valid `GOOGLE_PLACES_API_KEY` and
  `GOOGLE_PLACES_PLACE_ID` — required for both the live reviews UI and the
  new `aggregateRating` schema to actually appear.
- List on relevant local directories (e.g. Jakarta vet clinic directories)
  for additional citation signals.

## Out of scope

- Restructuring the multiple `<h1>` tags in `hero.blade.php` / `services.blade.php`.
- Splitting the site into multiple routes/pages.
- Executing off-page actions (GBP claim, directory submissions, backlink
  outreach) — guidance only.
