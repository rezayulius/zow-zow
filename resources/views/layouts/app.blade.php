<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>

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

  @if(config('services.google.analytics_id'))
  <!-- Google Analytics (GA4) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ config('services.google.analytics_id') }}');
  </script>
  @endif
</head>

<body class="font-sans antialiased">
  <!-- Global Animated Background Bubbles -->
  <div class="fixed inset-0 overflow-hidden pointer-events-none z-[-1]">
    <div
      class="absolute -top-10 -left-10 w-72 h-72 bg-soft-linen-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
    </div>
    <div
      class="absolute -top-10 -right-10 w-72 h-72 bg-rusty-caramel-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
    </div>
    <div
      class="absolute -bottom-10 left-20 w-72 h-72 bg-old-mustard-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
    </div>
    <div
      class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-soft-blush-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-6000">
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

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
  <script>
    function initEmergencyModal() {
      const bindEmergency = (btn) => {
        if (!btn || btn.dataset.bound) return;
        btn.dataset.bound = '1';
        btn.addEventListener('click', function () {
          Swal.fire({
            icon: 'warning',
            title: 'Konfirmasi Emergency Call',
            html: `
                <div class="text-left text-sm">
                  <p class="text-gray-700 mb-2">Layanan emergency call ditujukan untuk kondisi darurat pada hewan peliharaan yang membutuhkan penanganan segera. Layanan ini dapat dikenakan biaya tambahan sesuai tarif yang berlaku.</p>
                  <p class="text-gray-700 mb-2">Kondisi darurat dapat mencakup:</p>
                  <ul class="list-disc list-inside text-gray-800 mb-4">
                    <li>Sesak napas, kejang, pingsan, atau lemas berat.</li>
                    <li>Perdarahan, luka serius, trauma, atau kecelakaan.</li>
                    <li>Dugaan keracunan, muntah/diare berat, atau kondisi memburuk tiba-tiba.</li>
                    <li>Kondisi mendesak lainnya yang memerlukan respons dokter hewan.</li>
                  </ul>
                  <div class="border-t pt-4 mt-4">
                    <p class="text-gray-700 mb-3 font-medium">Syarat dan Ketentuan:</p>
                    <ul class="list-disc list-inside text-gray-600 text-xs mb-4 space-y-1">
                      <li>Saya memahami bahwa emergency call dapat dikenakan biaya tambahan.</li>
                      <li>Saya menyatakan bahwa kondisi hewan peliharaan saya membutuhkan bantuan segera.</li>
                      <li>Saya bersedia memberikan informasi lengkap mengenai kondisi hewan saat dihubungi.</li>
                      <li>Saya memahami bahwa dokter hewan akan menentukan tindakan berdasarkan hasil penilaian awal.</li>
                    </ul>
                    <div class="flex items-start space-x-2">
                      <input type="checkbox" id="emergencyTermsCheckbox" class="mt-1 h-4 w-4 text-rose-600 focus:ring-rose-500 border-gray-300 rounded">
                      <label for="emergencyTermsCheckbox" class="text-xs text-gray-700 cursor-pointer">
                        Saya telah membaca dan menyetujui syarat dan ketentuan emergency call di atas.
                      </label>
                    </div>
                  </div>
                </div>
              `,
            showCancelButton: true,
            confirmButtonText: 'Telepon Sekarang',
            cancelButtonText: 'Tutup',
            confirmButtonColor: '#f43f5e', // rose-500
            cancelButtonColor: '#e5e7eb', // gray-200
            didOpen: () => {
              const confirmButton = Swal.getConfirmButton();
              const checkbox = document.getElementById('emergencyTermsCheckbox');

              // Disable button initially
              confirmButton.disabled = true;
              confirmButton.style.opacity = '0.5';
              confirmButton.style.cursor = 'not-allowed';

              // Enable/disable button based on checkbox
              checkbox.addEventListener('change', function () {
                if (this.checked) {
                  confirmButton.disabled = false;
                  confirmButton.style.opacity = '1';
                  confirmButton.style.cursor = 'pointer';
                } else {
                  confirmButton.disabled = true;
                  confirmButton.style.opacity = '0.5';
                  confirmButton.style.cursor = 'not-allowed';
                }
              });
            },
            preConfirm: () => {
              const checkbox = document.getElementById('emergencyTermsCheckbox');
              if (!checkbox.checked) {
                Swal.showValidationMessage('Anda harus menyetujui syarat dan ketentuan terlebih dahulu');
                return false;
              }
              return true;
            }
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'tel:+6281295911911';
            }
          });
        });
      };

      bindEmergency(document.getElementById('btnEmergencyCall'));
      bindEmergency(document.getElementById('btnEmergencyCallMobile'));
      bindEmergency(document.getElementById('emergency-call-mobile'));
    }

    document.addEventListener('DOMContentLoaded', initEmergencyModal);
    document.addEventListener('livewire:navigated', initEmergencyModal);

    // Flash messages come from a full-page redirect after a form POST (e.g.
    // sign in/out), never from a wire:navigate transition, so this only
    // needs to run once on the initial hard load.
    document.addEventListener('DOMContentLoaded', function () {
      @if(session('success'))
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '{{ session('success') }}',
          timer: 2000,
          showConfirmButton: false
        });
      @endif

      @if(session('error'))
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: '{{ session('error') }}',
          timer: 2000,
          showConfirmButton: false
        });
      @endif
    });
  </script>

  <!-- Authentication Modals -->
  @include('auth.modals')

  <!-- Authentication Modals JavaScript -->
  <script src="{{ asset('js/auth-modals.js') }}"></script>

  @livewireScripts

  @stack('scripts')
</body>

</html>
