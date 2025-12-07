<!-- Authentication Modals -->
<div id="authModalsContainer">
    <!-- Sign In Modal -->
    <div id="signInModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 bg-carob-900/30 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all">
            <!-- Header -->
            <div class="text-center mb-6">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-chai-500 to-chai-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="log-in" class="text-white w-8 h-8"></i>
                </div>
                <h2 class="text-2xl font-bold text-carob-900">Sign In</h2>
                <p class="text-carob-600 text-sm mt-2">Selamat datang kembali!</p>
            </div>

            <!-- Sign In Form -->
            <form id="signInForm" class="space-y-4">
                @csrf
                <!-- Email -->
                <div>
                    <label for="signin-email" class="block text-sm font-medium text-carob-700 mb-2">Email</label>
                    <input type="email" id="signin-email" name="email" required
                        class="w-full px-4 py-3 border border-chai-200 rounded-lg focus:ring-2 focus:ring-chai-500 focus:border-transparent transition-all"
                        placeholder="nama@email.com">
                    <span class="text-red-500 text-xs hidden" id="signin-email-error"></span>
                </div>

                <!-- Password -->
                <div>
                    <label for="signin-password" class="block text-sm font-medium text-carob-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="signin-password" name="password" required
                            class="w-full px-4 py-3 border border-chai-200 rounded-lg focus:ring-2 focus:ring-chai-500 focus:border-transparent transition-all pr-12"
                            placeholder="••••••••">
                        <button type="button" id="toggleSignInPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-carob-400 hover:text-carob-600">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <span class="text-red-500 text-xs hidden" id="signin-password-error"></span>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-chai-600 border-chai-300 rounded focus:ring-chai-500">
                        <span class="ml-2 text-sm text-carob-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-chai-600 hover:text-chai-700 font-medium">Forgot Password?</a>
                </div>

                <!-- Error Message -->
                <div id="signin-error"
                    class="hidden bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm"></div>

                <!-- Sign In Button -->
                <button type="submit" id="signInBtn"
                    class="w-full bg-gradient-to-r from-chai-500 to-chai-600 text-white py-3 rounded-lg hover:from-chai-600 hover:to-chai-700 transition-all font-semibold shadow-lg hover:shadow-xl">
                    Sign In
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-chai-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-carob-500">OR</span>
                    </div>
                </div>

                <!-- Google Sign In -->
                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center gap-3 bg-white border-2 border-chai-200 text-carob-700 py-3 rounded-lg hover:bg-chai-50 transition-all font-medium">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Sign in with Google
                </a>

                <!-- Sign Up Link -->
                <p class="text-center text-sm text-carob-600 mt-4">
                    Don't have an account?
                    <button type="button" id="showSignUpModal"
                        class="text-chai-600 hover:text-chai-700 font-semibold">Sign Up</button>
                </p>
            </form>

            <!-- Close Button -->
            <button id="closeSignInModal" class="absolute top-4 right-4 text-carob-400 hover:text-carob-600">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div id="signUpModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 bg-carob-900/30 backdrop-blur-sm">
        <div
            class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="text-center mb-6">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-matcha-500 to-matcha-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="user-plus" class="text-white w-8 h-8"></i>
                </div>
                <h2 class="text-2xl font-bold text-carob-900">Sign Up</h2>
                <p class="text-carob-600 text-sm mt-2">Buat akun baru Anda</p>
            </div>

            <!-- Sign Up Form -->
            <form id="signUpForm" class="space-y-4">
                @csrf
                <!-- Name -->
                <div>
                    <label for="signup-name" class="block text-sm font-medium text-carob-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="signup-name" name="name" required
                        class="w-full px-4 py-3 border border-chai-200 rounded-lg focus:ring-2 focus:ring-matcha-500 focus:border-transparent transition-all"
                        placeholder="John Doe">
                    <span class="text-red-500 text-xs hidden" id="signup-name-error"></span>
                </div>

                <!-- Email -->
                <div>
                    <label for="signup-email" class="block text-sm font-medium text-carob-700 mb-2">Email</label>
                    <input type="email" id="signup-email" name="email" required
                        class="w-full px-4 py-3 border border-chai-200 rounded-lg focus:ring-2 focus:ring-matcha-500 focus:border-transparent transition-all"
                        placeholder="nama@email.com">
                    <span class="text-red-500 text-xs hidden" id="signup-email-error"></span>
                </div>

                <!-- Password -->
                <div>
                    <label for="signup-password" class="block text-sm font-medium text-carob-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="signup-password" name="password" required
                            class="w-full px-4 py-3 border border-chai-200 rounded-lg focus:ring-2 focus:ring-matcha-500 focus:border-transparent transition-all pr-12"
                            placeholder="Min. 8 karakter">
                        <button type="button" id="toggleSignUpPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-carob-400 hover:text-carob-600">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <span class="text-red-500 text-xs hidden" id="signup-password-error"></span>
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="flex gap-1">
                            <div class="h-1 flex-1 rounded bg-gray-200" id="strength-1"></div>
                            <div class="h-1 flex-1 rounded bg-gray-200" id="strength-2"></div>
                            <div class="h-1 flex-1 rounded bg-gray-200" id="strength-3"></div>
                            <div class="h-1 flex-1 rounded bg-gray-200" id="strength-4"></div>
                        </div>
                        <p class="text-xs text-carob-500 mt-1" id="strength-text">Password strength</p>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="signup-password-confirmation"
                        class="block text-sm font-medium text-carob-700 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" id="signup-password-confirmation" name="password_confirmation" required
                            class="w-full px-4 py-3 border border-chai-200 rounded-lg focus:ring-2 focus:ring-matcha-500 focus:border-transparent transition-all pr-12"
                            placeholder="Ulangi password">
                        <button type="button" id="toggleSignUpPasswordConfirm"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-carob-400 hover:text-carob-600">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <span class="text-red-500 text-xs hidden" id="signup-password-confirmation-error"></span>
                </div>

                <!-- Terms & Conditions -->
                <div>
                    <label class="flex items-start">
                        <input type="checkbox" id="terms" required
                            class="w-4 h-4 text-matcha-600 border-chai-300 rounded focus:ring-matcha-500 mt-1">
                        <span class="ml-2 text-sm text-carob-600">
                            Saya setuju dengan <a href="#"
                                class="text-matcha-600 hover:text-matcha-700 font-medium">Terms & Conditions</a> dan <a
                                href="#" class="text-matcha-600 hover:text-matcha-700 font-medium">Privacy Policy</a>
                        </span>
                    </label>
                </div>

                <!-- Error Message -->
                <div id="signup-error"
                    class="hidden bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm"></div>

                <!-- Sign Up Button -->
                <button type="submit" id="signUpBtn"
                    class="w-full bg-gradient-to-r from-matcha-500 to-matcha-600 text-white py-3 rounded-lg hover:from-matcha-600 hover:to-matcha-700 transition-all font-semibold shadow-lg hover:shadow-xl">
                    Sign Up
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-chai-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-carob-500">OR</span>
                    </div>
                </div>

                <!-- Google Sign Up -->
                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center gap-3 bg-white border-2 border-chai-200 text-carob-700 py-3 rounded-lg hover:bg-chai-50 transition-all font-medium">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Sign up with Google
                </a>

                <!-- Sign In Link -->
                <p class="text-center text-sm text-carob-600 mt-4">
                    Already have an account?
                    <button type="button" id="showSignInModal"
                        class="text-matcha-600 hover:text-matcha-700 font-semibold">Sign In</button>
                </p>
            </form>

            <!-- Close Button -->
            <button id="closeSignUpModal" class="absolute top-4 right-4 text-carob-400 hover:text-carob-600">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    <!-- OTP Verification Modal -->
    <div id="otpModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 bg-carob-900/30 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all">
            <!-- Header -->
            <div class="text-center mb-6">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-pistache-500 to-pistache-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="mail-check" class="text-white w-8 h-8"></i>
                </div>
                <h2 class="text-2xl font-bold text-carob-900">Verify Your Email</h2>
                <p class="text-carob-600 text-sm mt-2">Masukkan kode 6-digit yang dikirim ke</p>
                <p class="text-chai-600 font-semibold text-sm" id="otp-email"></p>
            </div>

            <!-- OTP Form -->
            <form id="otpForm" class="space-y-6">
                @csrf
                <input type="hidden" id="otp-email-hidden" name="email">

                <!-- OTP Input Boxes -->
                <div class="flex justify-center gap-2">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all"
                        data-index="0">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all"
                        data-index="1">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all"
                        data-index="2">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all"
                        data-index="3">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all"
                        data-index="4">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-14 text-center text-2xl font-bold border-2 border-chai-200 rounded-lg focus:ring-2 focus:ring-pistache-500 focus:border-transparent transition-all"
                        data-index="5">
                </div>

                <!-- Error Message -->
                <div id="otp-error"
                    class="hidden bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm text-center">
                </div>

                <!-- Verify Button -->
                <button type="submit" id="verifyOtpBtn"
                    class="w-full bg-gradient-to-r from-pistache-500 to-pistache-600 text-white py-3 rounded-lg hover:from-pistache-600 hover:to-pistache-700 transition-all font-semibold shadow-lg hover:shadow-xl">
                    Verify Email
                </button>

                <!-- Resend OTP -->
                <div class="text-center">
                    <p class="text-sm text-carob-600">Tidak menerima kode?</p>
                    <button type="button" id="resendOtpBtn"
                        class="text-sm text-pistache-600 hover:text-pistache-700 font-semibold mt-1 disabled:opacity-50 disabled:cursor-not-allowed">
                        Kirim Ulang <span id="resend-countdown"></span>
                    </button>
                </div>
            </form>

            <!-- Close Button -->
            <button id="closeOtpModal" class="absolute top-4 right-4 text-carob-400 hover:text-carob-600">
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