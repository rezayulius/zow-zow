<!-- Authentication Modals (Fresh & Joyful Redesign) -->
<div id="authModalsContainer">
    <!-- Sign In Modal -->
    <div id="signInModal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 bg-carob-900/40 backdrop-blur-md transition-opacity duration-300">
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-md w-full p-8 transform transition-all scale-100 animate-bounce-in relative overflow-hidden border-4 border-white ring-1 ring-gray-100">
            
            <!-- Joyful Background Elements -->
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-forest-moss-green-100 rounded-full blur-2xl opacity-60 pointer-events-none floating-element"></div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-chai-100 rounded-full blur-2xl opacity-60 pointer-events-none floating-element" style="animation-delay: -2s;"></div>
            <div class="absolute top-1/4 right-0 text-forest-moss-green-50 transform rotate-12 opacity-40 pointer-events-none floating-element" style="animation-delay: -1s;">
                <i data-lucide="paw-print" class="w-24 h-24"></i>
            </div>
            <div class="absolute bottom-1/4 left-0 text-chai-50 transform -rotate-12 opacity-40 pointer-events-none floating-element" style="animation-delay: -3s;">
                <i data-lucide="bone" class="w-20 h-20"></i>
            </div>

            <!-- Header -->
            <div class="text-center mb-8 relative z-10">
                <div class="w-20 h-20 bg-gradient-to-br from-forest-moss-green-400 to-forest-moss-green-600 rounded-[2rem] flex items-center justify-center mx-auto mb-4 shadow-lg shadow-forest-moss-green-200 rotate-3 hover:rotate-0 transition-all duration-300 hover:scale-110 group">
                    <i data-lucide="paw-print" class="text-white w-10 h-10 fill-current group-hover:animate-pulse"></i>
                </div>
                <h2 class="text-3xl font-bold text-carob-900 font-heading">Halo, Paw Parents! 👋</h2>
                <p class="text-carob-500 font-medium mt-2">Senang bertemu kembali! Siap merawat anabul? 🐾</p>
            </div>

            <!-- Sign In Form -->
            <form id="signInForm" class="space-y-5 relative z-10">
                @csrf
                <!-- Email -->
                <div class="group">
                    <div class="relative transition-transform duration-300 hover:scale-[1.01]">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="text-carob-300 w-5 h-5 group-focus-within:text-forest-moss-green-500 transition-colors"></i>
                        </div>
                        <input type="email" id="signin-email" name="email" required
                            class="w-full pl-12 pr-4 py-3.5 bg-soft-linen-50 border-2 border-transparent focus:border-forest-moss-green-400 rounded-2xl text-carob-800 placeholder-carob-300 font-medium focus:ring-0 focus:bg-white transition-all duration-300 shadow-sm group-hover:shadow-md"
                            placeholder="nama@email.com">
                    </div>
                    <span class="text-red-500 text-xs mt-1 ml-2 font-bold hidden animate-pulse" id="signin-email-error"></span>
                </div>

                <!-- Password -->
                <div class="group">
                    <div class="relative transition-transform duration-300 hover:scale-[1.01]">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="text-carob-300 w-5 h-5 group-focus-within:text-forest-moss-green-500 transition-colors"></i>
                        </div>
                        <input type="password" id="signin-password" name="password" required
                            class="w-full pl-12 pr-12 py-3.5 bg-soft-linen-50 border-2 border-transparent focus:border-forest-moss-green-400 rounded-2xl text-carob-800 placeholder-carob-300 font-medium focus:ring-0 focus:bg-white transition-all duration-300 shadow-sm group-hover:shadow-md"
                            placeholder="••••••••">
                        <button type="button" id="toggleSignInPassword"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-carob-300 hover:text-forest-moss-green-600 transition-colors hover:scale-110 transform">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <span class="text-red-500 text-xs mt-1 ml-2 font-bold hidden animate-pulse" id="signin-password-error"></span>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="remember"
                            class="w-5 h-5 text-forest-moss-green-500 border-2 border-carob-200 rounded-lg focus:ring-forest-moss-green-400 focus:ring-offset-0 transition-all cursor-pointer">
                        <span class="ml-2 text-sm text-carob-500 font-medium group-hover:text-carob-700 transition-colors">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm text-forest-moss-green-600 hover:text-forest-moss-green-700 font-bold hover:underline decoration-2 underline-offset-2 transition-colors">Lupa Password?</a>
                </div>

                <!-- Error Message -->
                <div id="signin-error"
                    class="hidden bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-2xl text-sm font-medium flex items-center gap-2 animate-bounce-in">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    <span></span>
                </div>

                <!-- Sign In Button -->
                <button type="submit" id="signInBtn"
                    class="w-full bg-forest-moss-green-500 hover:bg-forest-moss-green-600 text-white py-3.5 rounded-2xl font-bold shadow-lg shadow-forest-moss-green-200 hover:shadow-xl hover:shadow-forest-moss-green-300 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                    <span>Masuk Sekarang</span>
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t-2 border-dashed border-gray-100"></div>
                    </div>
                    <div class="relative flex justify-center text-xs font-bold uppercase tracking-wider">
                        <span class="px-4 bg-white text-carob-300">Atau masuk dengan</span>
                    </div>
                </div>

                <!-- Google Sign In -->
                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center gap-3 bg-white border-2 border-gray-100 text-carob-700 py-3.5 rounded-2xl hover:bg-gray-50 hover:border-gray-200 transition-all font-bold shadow-sm group hover:-translate-y-0.5">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Google
                </a>

                <!-- Sign Up Link -->
                <p class="text-center text-sm text-carob-500 mt-6 font-medium">
                    Belum punya akun?
                    <button type="button" id="showSignUpModal"
                        class="text-forest-moss-green-600 hover:text-forest-moss-green-700 font-bold hover:underline decoration-2 underline-offset-2 ml-1 transition-colors">Daftar disini</button>
                </p>
            </form>

            <!-- Close Button -->
            <button id="closeSignInModal" class="absolute top-4 right-4 w-10 h-10 bg-soft-linen-50 rounded-full flex items-center justify-center text-carob-400 hover:bg-red-50 hover:text-red-500 transition-all duration-300 z-20 group shadow-sm hover:shadow-md">
                <i data-lucide="x" class="w-5 h-5 group-hover:rotate-90 transition-transform"></i>
            </button>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div id="signUpModal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 bg-carob-900/40 backdrop-blur-md transition-opacity duration-300">
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-xl w-full flex flex-col transform transition-all scale-100 animate-bounce-in relative border-4 border-white ring-1 ring-gray-100 max-h-[90vh] overflow-hidden">
            
            <!-- Joyful Background Elements (Clipped by Container) -->
            <div class="absolute inset-0 rounded-[2.3rem] overflow-hidden pointer-events-none z-0">
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-chai-100 rounded-full blur-3xl opacity-50 floating-element"></div>
                <div class="absolute bottom-20 -left-10 w-40 h-40 bg-soft-blush-pink-100 rounded-full blur-2xl opacity-50 floating-element" style="animation-delay: -2s;"></div>
                <div class="absolute top-1/4 left-0 text-chai-50 transform -rotate-12 opacity-40 floating-element" style="animation-delay: -1.5s;">
                    <i data-lucide="heart" class="w-20 h-20 fill-current"></i>
                </div>
                <div class="absolute bottom-1/4 right-0 text-soft-blush-pink-50 transform rotate-12 opacity-40 floating-element" style="animation-delay: -3.5s;">
                    <i data-lucide="cat" class="w-24 h-24"></i>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto custom-scrollbar w-full h-full relative z-10 rounded-[2.3rem] my-4 mr-1 pr-1">
                <div class="p-8">
                    <!-- Header -->
                    <div class="text-center mb-8 relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-chai-400 to-chai-600 rounded-[2rem] flex items-center justify-center mx-auto mb-4 shadow-lg shadow-chai-200 -rotate-3 hover:rotate-0 transition-all duration-300 hover:scale-110 group">
                            <i data-lucide="heart-handshake" class="text-white w-10 h-10 fill-current group-hover:animate-pulse"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-carob-900 font-heading">Join the Family!</h2>
                        <p class="text-carob-500 font-medium mt-2">Mulai perjalanan sehat anabulmu disini 🐶🐱</p>
                    </div>

                    <!-- Sign Up Form -->
                    <form id="signUpForm" class="space-y-5 relative z-10">
                        @csrf
                        <!-- Name -->
                        <div class="group">
                            <div class="relative transition-transform duration-300 hover:scale-[1.01]">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="user" class="text-carob-300 w-5 h-5 group-focus-within:text-chai-500 transition-colors"></i>
                                </div>
                                <input type="text" id="signup-name" name="name" required
                                    class="w-full pl-12 pr-4 py-3.5 bg-soft-linen-50 border-2 border-transparent focus:border-chai-400 rounded-2xl text-carob-800 placeholder-carob-300 font-medium focus:ring-0 focus:bg-white transition-all duration-300 shadow-sm group-hover:shadow-md"
                                    placeholder="Nama Lengkap">
                            </div>
                            <span class="text-red-500 text-xs mt-1 ml-2 font-bold hidden animate-pulse" id="signup-name-error"></span>
                        </div>

                        <!-- Email -->
                        <div class="group">
                            <div class="relative transition-transform duration-300 hover:scale-[1.01]">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="mail" class="text-carob-300 w-5 h-5 group-focus-within:text-chai-500 transition-colors"></i>
                                </div>
                                <input type="email" id="signup-email" name="email" required
                                    class="w-full pl-12 pr-4 py-3.5 bg-soft-linen-50 border-2 border-transparent focus:border-chai-400 rounded-2xl text-carob-800 placeholder-carob-300 font-medium focus:ring-0 focus:bg-white transition-all duration-300 shadow-sm group-hover:shadow-md"
                                    placeholder="nama@email.com">
                            </div>
                            <span class="text-red-500 text-xs mt-1 ml-2 font-bold hidden animate-pulse" id="signup-email-error"></span>
                        </div>

                        <!-- Password -->
                        <div class="group">
                            <div class="relative transition-transform duration-300 hover:scale-[1.01]">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="text-carob-300 w-5 h-5 group-focus-within:text-chai-500 transition-colors"></i>
                                </div>
                                <input type="password" id="signup-password" name="password" required
                                    class="w-full pl-12 pr-12 py-3.5 bg-soft-linen-50 border-2 border-transparent focus:border-chai-400 rounded-2xl text-carob-800 placeholder-carob-300 font-medium focus:ring-0 focus:bg-white transition-all duration-300 shadow-sm group-hover:shadow-md"
                                    placeholder="Password (Min. 8)">
                                <button type="button" id="toggleSignUpPassword"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-carob-300 hover:text-chai-600 transition-colors hover:scale-110 transform">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                            <span class="text-red-500 text-xs mt-1 ml-2 font-bold hidden animate-pulse" id="signup-password-error"></span>
                            
                            <!-- Fun Strength Indicator -->
                            <div class="mt-2 px-1">
                                <div class="flex gap-1.5 h-1.5">
                                    <div class="flex-1 rounded-full bg-gray-100 transition-all duration-500" id="strength-1"></div>
                                    <div class="flex-1 rounded-full bg-gray-100 transition-all duration-500 delay-75" id="strength-2"></div>
                                    <div class="flex-1 rounded-full bg-gray-100 transition-all duration-500 delay-150" id="strength-3"></div>
                                    <div class="flex-1 rounded-full bg-gray-100 transition-all duration-500 delay-200" id="strength-4"></div>
                                </div>
                                <p class="text-[10px] text-carob-400 mt-1 font-bold text-right" id="strength-text">Password Strength</p>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="group">
                            <div class="relative transition-transform duration-300 hover:scale-[1.01]">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="check-circle-2" class="text-carob-300 w-5 h-5 group-focus-within:text-chai-500 transition-colors"></i>
                                </div>
                                <input type="password" id="signup-password-confirmation" name="password_confirmation" required
                                    class="w-full pl-12 pr-12 py-3.5 bg-soft-linen-50 border-2 border-transparent focus:border-chai-400 rounded-2xl text-carob-800 placeholder-carob-300 font-medium focus:ring-0 focus:bg-white transition-all duration-300 shadow-sm group-hover:shadow-md"
                                    placeholder="Ulangi Password">
                                <button type="button" id="toggleSignUpPasswordConfirm"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-carob-300 hover:text-chai-600 transition-colors hover:scale-110 transform">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                            <span class="text-red-500 text-xs mt-1 ml-2 font-bold hidden animate-pulse" id="signup-password-confirmation-error"></span>
                        </div>

                        <!-- Terms -->
                        <label class="flex items-start px-1 cursor-pointer group">
                            <input type="checkbox" id="terms" required
                                class="w-5 h-5 text-chai-500 border-2 border-carob-200 rounded-lg focus:ring-chai-400 focus:ring-offset-0 transition-all mt-0.5 cursor-pointer group-hover:scale-110">
                            <span class="ml-3 text-sm text-carob-500 font-medium leading-tight">
                                Saya setuju dengan <a href="#" class="text-chai-600 hover:text-chai-700 font-bold hover:underline">Syarat & Ketentuan</a> Zow Vetique.
                            </span>
                        </label>

                        <!-- Error Message -->
                        <div id="signup-error"
                            class="hidden bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-2xl text-sm font-medium flex items-center gap-2 animate-bounce-in">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            <span></span>
                        </div>

                        <!-- Sign Up Button -->
                        <button type="submit" id="signUpBtn"
                            class="w-full bg-chai-500 hover:bg-chai-600 text-white py-3.5 rounded-2xl font-bold shadow-lg shadow-chai-200 hover:shadow-xl hover:shadow-chai-300 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                            <span>Buat Akun</span>
                            <i data-lucide="sparkles" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                        </button>

                        <!-- Divider -->
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t-2 border-dashed border-gray-100"></div>
                            </div>
                            <div class="relative flex justify-center text-xs font-bold uppercase tracking-wider">
                                <span class="px-4 bg-white text-carob-300">Atau daftar dengan</span>
                            </div>
                        </div>

                        <!-- Google Sign Up -->
                        <a href="{{ route('auth.google') }}"
                            class="w-full flex items-center justify-center gap-3 bg-white border-2 border-gray-100 text-carob-700 py-3.5 rounded-2xl hover:bg-gray-50 hover:border-gray-200 transition-all font-bold shadow-sm group hover:-translate-y-0.5">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                            Google
                        </a>

                        <!-- Sign In Link -->
                        <p class="text-center text-sm text-carob-500 mt-6 font-medium">
                            Sudah punya akun?
                            <button type="button" id="showSignInModal"
                                class="text-chai-600 hover:text-chai-700 font-bold hover:underline decoration-2 underline-offset-2 ml-1 transition-colors">Masuk disini</button>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Close Button -->
            <button id="closeSignUpModal" class="absolute top-4 right-4 w-10 h-10 bg-soft-linen-50 rounded-full flex items-center justify-center text-carob-400 hover:bg-red-50 hover:text-red-500 transition-all duration-300 z-20 group shadow-sm hover:shadow-md">
                <i data-lucide="x" class="w-5 h-5 group-hover:rotate-90 transition-transform"></i>
            </button>
        </div>
    </div>

    <!-- OTP Verification Modal -->
    <div id="otpModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 bg-carob-900/30 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all animate-bounce-in relative overflow-hidden">
            
            <!-- Joyful Background Elements -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-pistache-400 to-pistache-600"></div>
            <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-pistache-100 rounded-full blur-2xl opacity-60 pointer-events-none floating-element"></div>
            <div class="absolute -top-10 -left-10 w-32 h-32 bg-chai-100 rounded-full blur-2xl opacity-60 pointer-events-none floating-element" style="animation-delay: -1.5s;"></div>

            <!-- Header -->
            <div class="text-center mb-6 relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-pistache-500 to-pistache-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-pistache-200 group hover:scale-110 transition-transform duration-300">
                    <i data-lucide="mail-check" class="text-white w-8 h-8 group-hover:animate-bounce"></i>
                </div>
                <h2 class="text-2xl font-bold text-carob-900">Verify Your Email</h2>
                <p class="text-carob-600 text-sm mt-2">Masukkan kode 6-digit yang dikirim ke</p>
                <p class="text-chai-600 font-semibold text-sm" id="otp-email"></p>
            </div>

            <!-- OTP Form -->
            <form id="otpForm" class="space-y-6 relative z-10">
                @csrf
                <input type="hidden" id="otp-email-hidden" name="email">

                <!-- OTP Input Boxes -->
                <div class="flex justify-center gap-2">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all hover:scale-105 focus:scale-110"
                        data-index="0">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all hover:scale-105 focus:scale-110"
                        data-index="1">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all hover:scale-105 focus:scale-110"
                        data-index="2">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all hover:scale-105 focus:scale-110"
                        data-index="3">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all hover:scale-105 focus:scale-110"
                        data-index="4">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all hover:scale-105 focus:scale-110"
                        data-index="5">
                </div>

                <!-- Error Message -->
                <div id="otp-error"
                    class="hidden bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm text-center animate-bounce-in">
                </div>

                <!-- Verify Button -->
                <button type="submit" id="verifyOtpBtn"
                    class="w-full bg-gradient-to-r from-pistache-500 to-pistache-600 text-white py-3 rounded-lg hover:from-pistache-600 hover:to-pistache-700 transition-all font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    Verify Email
                </button>

                <!-- Resend OTP -->
                <div class="text-center">
                    <p class="text-sm text-carob-600">Tidak menerima kode?</p>
                    <button type="button" id="resendOtpBtn"
                        class="text-sm text-pistache-600 hover:text-pistache-700 font-semibold mt-1 disabled:opacity-50 disabled:cursor-not-allowed hover:underline">
                        Kirim Ulang <span id="resend-countdown"></span>
                    </button>
                </div>
            </form>

            <!-- Close Button -->
            <button id="closeOtpModal" class="absolute top-4 right-4 text-carob-400 hover:text-carob-600 hover:rotate-90 transition-all">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
    </div>
</div>

<!-- Include Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>