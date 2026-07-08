<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - Zow Vetique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Baskerville:ital,wght@0,400;0,700;1,400&family=Helvetica:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Theme Configuration based on app.css */
        :root {
            --color-soft-linen-50: #fefcf9;
            --color-soft-linen-100: #fdf8f0;
            --color-soft-linen-200: #faf0e1;
            --color-forest-moss-green-50: #f4f7f3;
            --color-forest-moss-green-100: #e9efe7;
            --color-forest-moss-green-500: #364E2C;
            --color-forest-moss-green-600: #2f4426;
            --color-deep-cocoa-brown-800: #342618;
            --color-deep-cocoa-brown-900: #291f14;
            --color-chai-100: #f5f0ea;
            --color-chai-500: #d2ab80;
            --color-soft-blush-pink-100: #fff3f3;
        }

        body {
            font-family: 'Helvetica', sans-serif;
            background-color: var(--color-soft-linen-50);
            color: var(--color-deep-cocoa-brown-800);
        }

        h1, h2, h3 {
            font-family: 'Baskerville', serif;
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse-soft {
            0%, 100% { transform: scale(1); opacity: 0.4; }
            50% { transform: scale(1.05); opacity: 0.6; }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-pulse-soft {
            animation: pulse-soft 4s ease-in-out infinite;
        }

        .animate-bounce-in {
            animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col relative overflow-hidden">

    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute top-[-10%] left-[-5%] w-[500px] h-[500px] bg-[#e9efe7] rounded-full blur-3xl opacity-60 animate-pulse-soft"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[600px] h-[600px] bg-[#f5f0ea] rounded-full blur-3xl opacity-60 animate-pulse-soft" style="animation-delay: 2s;"></div>
        <div class="absolute top-[20%] right-[10%] w-[300px] h-[300px] bg-[#fff3f3] rounded-full blur-3xl opacity-50 animate-pulse-soft" style="animation-delay: 4s;"></div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center relative z-10 px-4 sm:px-6">
        <div class="max-w-4xl w-full text-center">
            
            <!-- Logo Section -->
            <div class="mb-8 animate-bounce-in">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-[2rem] shadow-xl border-2 border-[#f4f7f3] mb-6 transform rotate-3 hover:rotate-0 transition-all duration-500">
                    <img src="{{ asset('images/logo/zow-vet-logo-brown.webp') }}" alt="Zow Vetique Logo" width="500" height="223" class="w-16 h-auto">
                </div>
            </div>

            <!-- Heading -->
            <h1 class="text-5xl sm:text-7xl font-bold text-[#342618] mb-6 tracking-tight animate-float" style="animation-delay: 0.5s;">
                Coming Soon
            </h1>
            
            <p class="text-xl sm:text-2xl text-[#675334] mb-12 max-w-2xl mx-auto leading-relaxed">
                Kami sedang mempersiapkan sesuatu yang istimewa untuk anabul kesayangan Anda. <br>
                <span class="font-bold text-[#364E2C]">Zow Vetique</span> akan segera hadir sebagai rumah kedua mereka! 🐾
            </p>

            <!-- Newsletter / Notify Me (Optional) -->
            <div class="max-w-md mx-auto mb-16 bg-white p-2 rounded-2xl shadow-lg border border-[#e9efe7] flex flex-col sm:flex-row gap-2">
                <input type="email" placeholder="Masukkan email Anda..." class="flex-grow px-6 py-3 rounded-xl bg-[#fefcf9] border-none focus:ring-2 focus:ring-[#364E2C] outline-none text-[#342618] placeholder-[#9e8b6e]">
                <button class="px-8 py-3 bg-[#364E2C] hover:bg-[#2f4426] text-white font-bold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2 group">
                    <span>Kabari Saya</span>
                    <i data-lucide="bell" class="w-4 h-4 group-hover:rotate-12 transition-transform"></i>
                </button>
            </div>

            <!-- Social & Contact -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 sm:gap-12">
                <a href="https://wa.me/{{ config('clinic.whatsapp_number') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 text-[#675334] hover:text-[#364E2C] transition-colors group bg-white/50 px-6 py-3 rounded-full backdrop-blur-sm border border-transparent hover:border-[#e9efe7]">
                    <div class="w-10 h-10 bg-[#e9efe7] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="message-circle" class="w-5 h-5 text-[#364E2C]"></i>
                    </div>
                    <span class="font-medium">Chat WhatsApp</span>
                </a>
                
                <a href="https://www.instagram.com/zowvetclinic?igsh=aXUzZXZnc3JrYTFs"
                    target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-3 text-[#675334] hover:text-[#d2ab80] transition-colors group bg-white/50 px-6 py-3 rounded-full backdrop-blur-sm border border-transparent hover:border-[#f5f0ea]">

                    <div class="w-10 h-10 bg-[#f5f0ea] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <img
                            src="https://cdn.simpleicons.org/instagram/currentColor"
                            alt="Instagram"
                            class="w-5 h-5">
                    </div>

                    <span class="font-medium">Follow Instagram</span>
                </a>
            </div>

        </div>
    </main>

    <!-- Footer Simple -->
    <footer class="relative z-10 py-8 text-center text-[#9e8b6e] text-sm">
        <p>&copy; 2025 Zow Vetique. Pet Wellness Hub.</p>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>