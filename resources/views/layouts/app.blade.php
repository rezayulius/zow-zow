<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div
      class="absolute -top-10 -left-10 w-72 h-72 bg-matcha-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
    </div>
    <div
      class="absolute -top-10 -right-10 w-72 h-72 bg-chai-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
    </div>
    <div
      class="absolute -bottom-10 left-20 w-72 h-72 bg-almond-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
    </div>
    <div
      class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-vanilla-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-6000">
    </div>
  </div>

  @yield('content')

  <!-- Cekat.AI Live Chat Widget -->
  <script type="text/javascript">
    window.mychat = window.mychat || {};
    window.mychat.server = 'https://live.cekat.ai/widget.js';
    window.mychat.iframeWidth = '400px';
    window.mychat.iframeHeight = '700px';
    window.mychat.accessKey = 'ZOW-moTIgTQw';
    (function () {
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
    document.addEventListener('DOMContentLoaded', function () {
      const bindEmergency = (btn) => {
        if (!btn) return;
        btn.addEventListener('click', function () {
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
                  <div class="border-t pt-4 mt-4">
                    <p class="text-gray-700 mb-3 font-medium">Syarat dan Ketentuan Emergency Call:</p>
                    <ul class="list-disc list-inside text-gray-600 text-xs mb-4 space-y-1">
                      <li>Saya memahami bahwa layanan emergency call dikenakan biaya tambahan sesuai tarif yang berlaku.</li>
                      <li>Saya menyatakan bahwa kondisi hewan peliharaan saya memerlukan penanganan darurat segera.</li>
                      <li>Saya bersedia memberikan informasi lengkap mengenai kondisi hewan saat dihubungi.</li>
                      <li>Saya memahami bahwa dokter hewan akan menentukan tindakan yang diperlukan berdasarkan kondisi hewan.</li>
                    </ul>
                    <div class="flex items-start space-x-2">
                      <input type="checkbox" id="emergencyTermsCheckbox" class="mt-1 h-4 w-4 text-rose-600 focus:ring-rose-500 border-gray-300 rounded">
                      <label for="emergencyTermsCheckbox" class="text-xs text-gray-700 cursor-pointer">
                        Saya telah membaca dan menyetujui syarat dan ketentuan emergency call di atas
                      </label>
                    </div>
                  </div>
                </div>
              `,
            showCancelButton: true,
            confirmButtonText: 'Telpon Sekarang',
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
              window.location.href = 'tel:+6281219088899';
            }
          });
        });
      };

      bindEmergency(document.getElementById('btnEmergencyCall'));
      bindEmergency(document.getElementById('btnEmergencyCallMobile'));
      bindEmergency(document.getElementById('emergency-call-mobile'));

      // Handle Laravel Flash Messages
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

  @stack('scripts')
</body>

</html>