<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(config('services.google.analytics_id')) data-ga-id="{{ config('services.google.analytics_id') }}" @endif>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @php
    // Fallbacks are run through e() too, so $pageTitle etc. are *always*
    // already-escaped text regardless of whether a @section() supplied them
    // (Laravel's inline @section('name', $value) escapes internally) or the
    // default here kicked in — letting the {!! !!} below stay a single,
    // consistent escape either way instead of double- or zero-escaping.
    $pageTitle = trim((string) $__env->yieldContent('title')) ?: e('Klinik Hewan Jakarta Selatan | ZOW Vetique Kemang');
    $pageDescription = trim((string) $__env->yieldContent('meta_description')) ?: e('ZOW Vetique adalah klinik hewan di Kemang, Jakarta Selatan, menyediakan konsultasi dokter hewan, vaksinasi, steril, grooming, lab, terapi, pet spa, penitipan, dan emergency care.');
    $pageCanonical = trim((string) $__env->yieldContent('canonical')) ?: e(url()->current());
    $pageOgImage = trim((string) $__env->yieldContent('og_image')) ?: e('https://zowvetique.com/images/og-image.png');
    $pageRobots = trim((string) $__env->yieldContent('robots')) ?: e('index, follow');
  @endphp

  {{-- $pageTitle/$pageDescription/etc. are already HTML-escaped by Laravel's
       inline @section('name', $value) helper (it calls e() internally before
       storing the section), matching how @yield() echoes sections unescaped.
       Escaping again here with {{ }} would double-encode entities like "&"
       into "&amp;amp;" — so these use {!! !!} on purpose, not a XSS oversight. --}}
  <title>{!! $pageTitle !!}</title>
  <link rel="canonical" href="{!! $pageCanonical !!}" />
  <meta name="robots" content="{!! $pageRobots !!}">
  <meta name="description" content="{!! $pageDescription !!}">
  <meta name="author" content="ZOW Vetique">

  <!-- Open Graph -->
  <meta property="og:site_name" content="ZOW Vetique">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{!! $pageTitle !!}">
  <meta property="og:description" content="{!! $pageDescription !!}">
  <meta property="og:url" content="{!! $pageCanonical !!}">
  <meta property="og:image" content="{!! $pageOgImage !!}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="ZOW Vetique - Klinik Hewan Jakarta Selatan">
  <meta property="og:locale" content="{{ app()->getLocale() === 'en' ? 'en_US' : 'id_ID' }}">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{!! $pageTitle !!}">
  <meta name="twitter:description" content="{!! $pageDescription !!}">
  <meta name="twitter:image" content="{!! $pageOgImage !!}">

  <meta name="theme-color" content="#553822">
  <link rel="icon" href="{{ asset('favicon-zow.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('favicon-zow.ico') }}">

  <!-- Fonts: only the one family actually used (.font-heading) is loaded.
       Figtree/Poppins/Inter were linked here previously but referenced by
       zero classes anywhere in the app -- pure dead weight, removed. -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- Deferred/async third-party origins: a cheap DNS/TCP head start, not a
       full preconnect, since none of these block first paint. -->
  <link rel="dns-prefetch" href="https://www.googletagmanager.com">
  <link rel="dns-prefetch" href="https://www.google-analytics.com">
  <link rel="dns-prefetch" href="https://live.cekat.ai">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

  @stack('styles')

  <!-- ===== JSON-LD: WebSite (sitewide, tells Google the site name is "ZOW Vetique") ===== -->
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "WebSite",
    "@@id": "https://zowvetique.com/#website",
    "name": "ZOW Vetique",
    "alternateName": "ZOW Vetique Kemang",
    "url": "https://zowvetique.com/",
    "inLanguage": "{{ app()->getLocale() === 'en' ? 'en-US' : 'id-ID' }}",
    "publisher": {
      "@@id": "https://zowvetique.com/#veterinarycare"
    }
  }
  </script>

  <!-- ===== JSON-LD: VeterinaryCare / LocalBusiness (sitewide) ===== -->
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "VeterinaryCare",
    "@@id": "https://zowvetique.com/#veterinarycare",
    "name": "ZOW Vetique",
    "alternateName": "ZOW Vet Clinic",
    "url": "https://zowvetique.com/",
    "logo": "https://zowvetique.com/images/logo/zow-vet-logo-brown.webp",
    "isPartOf": {
      "@@id": "https://zowvetique.com/#website"
    },
    "image": [
      "https://zowvetique.com/images/og-image.png"
    ],
    "description": "ZOW Vetique adalah klinik hewan di Prapanca, Kebayoran Baru, Jakarta Selatan yang menyediakan layanan konsultasi dokter hewan, vaksinasi, steril, grooming, laboratorium, terapi lanjutan, dan emergency care untuk hewan peliharaan.",
    "slogan": "Klinik Hewan dengan Hati Keluarga",
    "telephone": "+6281295911911",
    "priceRange": "$$",
    "address": {
      "@@type": "PostalAddress",
      "streetAddress": "Jl. Prapanca Raya No.25A, RT.2/RW.3, Pulo, Kec. Kby. Baru",
      "addressLocality": "Kota Jakarta Selatan",
      "addressRegion": "Daerah Khusus Ibukota Jakarta",
      "postalCode": "12160",
      "addressCountry": "ID"
    },
    "hasMap": "https://maps.app.goo.gl/7nqSYBnUKGHxvoKSA",
    "geo": {
      "@@type": "GeoCoordinates",
      "latitude": -6.2530661,
      "longitude": 106.8084629
    },
    "areaServed": [
      "Jakarta Selatan",
      "Kebayoran Baru",
      "Pulo",
      "Prapanca",
      "Kemang",
      "DKI Jakarta"
    ],
    "openingHours": [
      "Mo-Su 07:00-22:00"
    ],
    "openingHoursSpecification": [
      {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ],
        "opens": "07:00",
        "closes": "22:00"
      }
    ],
    "sameAs": [
      "https://www.instagram.com/zowvetclinic/"
    ],
    "contactPoint": [
      {
        "@@type": "ContactPoint",
        "telephone": "+6281295911911",
        "contactType": "customer service",
        "areaServed": "ID",
        "availableLanguage": ["Indonesian", "English"]
      }
    ],
    "hasOfferCatalog": {
      "@@type": "OfferCatalog",
      "name": "Layanan Klinik Hewan ZOW Vetique",
      "itemListElement": [
        {
          "@@type": "Offer",
          "itemOffered": {
            "@@type": "Service",
            "name": "Konsultasi Dokter Hewan"
          }
        },
        {
          "@@type": "Offer",
          "itemOffered": {
            "@@type": "Service",
            "name": "Vaksinasi Hewan"
          }
        },
        {
          "@@type": "Offer",
          "itemOffered": {
            "@@type": "Service",
            "name": "Steril Kucing dan Anjing"
          }
        },
        {
          "@@type": "Offer",
          "itemOffered": {
            "@@type": "Service",
            "name": "Grooming dan Pet Care"
          }
        },
        {
          "@@type": "Offer",
          "itemOffered": {
            "@@type": "Service",
            "name": "Laboratorium dan Advanced Therapy"
          }
        },
        {
          "@@type": "Offer",
          "itemOffered": {
            "@@type": "EmergencyService",
            "name": "Emergency Vet Care"
          }
        }
      ]
    }
  }
  </script>

  {{-- Page-specific structured data (e.g. FAQPage) is pushed only from views that
       render matching visible content, so it stays valid per Google's guidelines --}}
  @stack('json-ld')

  {{-- Google Analytics (GA4): loaded on first scroll/click/touch/keypress
       (or a 4s fallback) instead of eagerly -- see resources/js/analytics.js.
       The measurement ID is read from the data-ga-id attribute on <html>. --}}
</head>

<body class="font-sans antialiased">
  {{-- Global Animated Background Bubbles: sits behind every page (z-[-1]) on
       every route sitewide. Was 4 continuously-animated blur+compositor
       layers running forever on every single page load regardless of
       whether that page even shows them under its own content — trimmed to
       2, since this is pure decoration paid for on every route in the app,
       not just the homepage where it's more visible. --}}
  <div class="fixed inset-0 overflow-hidden pointer-events-none z-[-1]">
    <div
      class="absolute -top-10 -left-10 w-72 h-72 bg-soft-linen-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
    </div>
    <div
      class="absolute -bottom-10 right-10 w-72 h-72 bg-rusty-caramel-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
    </div>
  </div>

  @yield('content')

  <!-- Cekat.AI Live Chat Widget (deferred until after page load so it doesn't compete with above-the-fold resources) -->
  <script type="text/javascript">
    function initCekatWidget() {
      // wire:navigate swaps <body> on every internal navigation; guard so this
      // 3rd-party widget (which self-injects an iframe into <body>, outside
      // Livewire's morphed region) isn't loaded/injected more than once.
      if (window.__cekatInitialized) return;
      window.__cekatInitialized = true;

      // The widget script injects its chat <iframe> with no accessible title
      // (a Lighthouse/screen-reader issue we can't fix at the source since
      // it's 3rd-party markup) -- patch one in as soon as it appears.
      new MutationObserver(function (mutations, observer) {
        var frame = document.querySelector('iframe[src*="live.cekat.ai"]');
        if (frame && !frame.title) {
          frame.title = 'Live chat';
          observer.disconnect();
        }
      }).observe(document.body, { childList: true, subtree: true });

      !function(c,e,k,a,t){
      c.mychat=c.mychat||{server:"https://live.cekat.ai/widget.js",iframeWidth:"400px",iframeHeight:"700px",accessKey:"ZOW-NXWaCTvC",offsetX:-24,offsetY:24,position:"bottom-right"};
      var q=[];
      c.Cekat=function(){q.push(arguments)};
      c.Cekat.q=q;
      a=e.createElement(k);
      t=e.getElementsByTagName(k)[0];
      a.async=1;
      a.src=c.mychat.server;
      t.parentNode.insertBefore(a,t);
      }(window,document,"script");
    }

    window.addEventListener('load', initCekatWidget);
    document.addEventListener('livewire:navigated', initCekatWidget);
  </script>

  {{-- SweetAlert2 is no longer a global CDN script -- it's dynamically
       import()'d (see resources/js/swal.js) only the moment the emergency
       call dialog or a flash message actually needs to render, so it never
       ships to visitors who don't trigger either. The emergency modal
       handlers live in resources/js/emergency-modal.js. --}}
  @if(session('success') || session('error'))
  <script type="application/json" id="flash-data">{!! json_encode(['success' => session('success'), 'error' => session('error')]) !!}</script>
  @endif

  <!-- Authentication Modals (JS bundled in app.js via initAuthModals) -->
  @include('auth.modals')

  @livewireScripts

  @stack('scripts')
</body>

</html>
