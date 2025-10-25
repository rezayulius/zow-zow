<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PetWellness Hub - Klinik Hewan Jakarta')</title>
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🐾</text></svg>">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased">
    <!-- Global Animated Background Bubbles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-[-1]">
        <div class="absolute -top-10 -left-10 w-72 h-72 bg-matcha-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -top-10 -right-10 w-72 h-72 bg-chai-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-10 left-20 w-72 h-72 bg-almond-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-vanilla-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-6000"></div>
    </div>

    @yield('content')
    
    <!-- Cekat.AI Live Chat Widget -->
    <script type="text/javascript">
        window.mychat = window.mychat || {};
        window.mychat.server = 'https://live.cekat.ai/widget.js';
        window.mychat.iframeWidth = '400px';
        window.mychat.iframeHeight = '700px';
        window.mychat.accessKey = 'ZOW-moTIgTQw';
        (function() {
            var mychat = document.createElement('script');
            mychat.type = 'text/javascript';
            mychat.async = true;
            mychat.src = window.mychat.server;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(mychat, s);
        })();
    </script>
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function(){
        const bindEmergency = (btn) => {
          if(!btn) return;
          btn.addEventListener('click', function(){
            Swal.fire({
              icon: 'warning',
              title: 'Konfirmasi Emergency Call',
              html: `
                <div class="text-left text-sm">
                  <p class="text-gray-700 mb-2">Panggilan emergency dapat dikenakan biaya tambahan. Emergency mencakup:</p>
                  <ul class="list-disc list-inside text-gray-800 mb-4">
                    <li>Gangguan kritis pada sistem atau layanan.</li>
                    <li>Kejadian terkait keselamatan atau keamanan.</li>
                    <li>Permasalahan operasional mendesak di luar jam kerja.</li>
                  </ul>
                </div>
              `,
              showCancelButton: true,
              confirmButtonText: 'Telpon Sekarang',
              cancelButtonText: 'Tutup',
              confirmButtonColor: '#f43f5e', // rose-500
              cancelButtonColor: '#e5e7eb', // gray-200
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'tel:+6281234567890';
              }
            });
          });
        };

        bindEmergency(document.getElementById('btnEmergencyCall'));
        bindEmergency(document.getElementById('btnEmergencyCallMobile'));
        bindEmergency(document.getElementById('emergency-call-mobile'));
      });
    </script>
    
    @stack('scripts')
</body>

</html>