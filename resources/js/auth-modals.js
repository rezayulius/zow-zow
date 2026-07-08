// Authentication Modals JavaScript
import { createIcons } from 'lucide';
import { icons } from './icons';
import { loadSwal } from './swal';

export function initAuthModals() {
    // wire:navigate re-renders the auth modals (they're in the shared layout)
    // on every navigation; guard so these listeners don't rebind and stack up.
    if (document.body.dataset.authModalsBound) return;
    document.body.dataset.authModalsBound = '1';

    // Modal Elements
    const signInModal = document.getElementById('signInModal');
    const signUpModal = document.getElementById('signUpModal');
    const otpModal = document.getElementById('otpModal');

    // Forms
    const signInForm = document.getElementById('signInForm');
    const signUpForm = document.getElementById('signUpForm');
    const otpForm = document.getElementById('otpForm');

    // Buttons
    const signInBtn = document.getElementById('signInBtn');
    const signUpBtn = document.getElementById('signUpBtn');
    const verifyOtpBtn = document.getElementById('verifyOtpBtn');
    const resendOtpBtn = document.getElementById('resendOtpBtn');

    // Password Toggle
    setupPasswordToggle('toggleSignInPassword', 'signin-password');
    setupPasswordToggle('toggleSignUpPassword', 'signup-password');
    setupPasswordToggle('toggleSignUpPasswordConfirm', 'signup-password-confirmation');

    // Password Strength Indicator
    const signupPassword = document.getElementById('signup-password');
    if (signupPassword) {
        signupPassword.addEventListener('input', checkPasswordStrength);
    }

    // OTP Inputs
    const otpInputs = document.querySelectorAll('.otp-input');
    setupOtpInputs(otpInputs);

    // Modal Open/Close Handlers
    document.querySelectorAll('[data-open-signin]').forEach(btn => {
        btn.addEventListener('click', () => openModal(signInModal));
    });

    document.querySelectorAll('[data-open-signup]').forEach(btn => {
        btn.addEventListener('click', () => openModal(signUpModal));
    });

    document.getElementById('closeSignInModal')?.addEventListener('click', () => closeModal(signInModal));
    document.getElementById('closeSignUpModal')?.addEventListener('click', () => closeModal(signUpModal));
    document.getElementById('closeOtpModal')?.addEventListener('click', () => closeModal(otpModal));

    // Switch between modals
    document.getElementById('showSignUpModal')?.addEventListener('click', () => {
        closeModal(signInModal);
        openModal(signUpModal);
    });

    document.getElementById('showSignInModal')?.addEventListener('click', () => {
        closeModal(signUpModal);
        openModal(signInModal);
    });

    // Close modal on backdrop click
    [signInModal, signUpModal, otpModal].forEach(modal => {
        modal?.addEventListener('click', (e) => {
            if (e.target === modal) closeModal(modal);
        });
    });

    // Form Submissions
    signInForm?.addEventListener('submit', handleSignIn);
    signUpForm?.addEventListener('submit', handleSignUp);
    otpForm?.addEventListener('submit', handleOtpVerification);
    resendOtpBtn?.addEventListener('click', handleResendOtp);

    // Functions
    function openModal(modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function setupPasswordToggle(buttonId, inputId) {
        const button = document.getElementById(buttonId);
        const input = document.getElementById(inputId);

        if (button && input) {
            button.addEventListener('click', () => {
                const type = input.type === 'password' ? 'text' : 'password';
                input.type = type;

                const icon = button.querySelector('i');
                if (icon) {
                    icon.setAttribute('data-lucide', type === 'password' ? 'eye' : 'eye-off');
                    createIcons({ icons });
                }
            });
        }
    }

    function checkPasswordStrength() {
        const password = this.value;
        let strength = 0;

        if (password.length >= 8) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        if (password.match(/[$@#&!]+/)) strength++;

        const indicators = [
            document.getElementById('strength-1'),
            document.getElementById('strength-2'),
            document.getElementById('strength-3'),
            document.getElementById('strength-4')
        ];

        const strengthText = document.getElementById('strength-text');
        const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
        const texts = ['Weak', 'Fair', 'Good', 'Strong'];

        indicators.forEach((indicator, index) => {
            indicator.className = 'h-1 flex-1 rounded bg-gray-200';
            if (index < strength) {
                indicator.classList.add(colors[Math.min(strength - 1, 3)]);
            }
        });

        if (password.length > 0) {
            strengthText.textContent = texts[Math.min(strength - 1, 3)] || 'Too weak';
        } else {
            strengthText.textContent = 'Password strength';
        }
    }

    function setupOtpInputs(inputs) {
        // Pasting a 6-digit code is handled through the regular `input` event
        // rather than intercepting `paste` with preventDefault() -- blocking
        // the native paste breaks password managers and is flagged as a
        // Lighthouse Best Practices issue. Each box's maxlength is relaxed
        // (see the markup) so a pasted string arrives here intact instead of
        // being truncated to 1 character before this handler sees it.
        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;

                if (value.length > 1) {
                    const digits = value.slice(0, inputs.length).split('');
                    digits.forEach((char, i) => {
                        if (inputs[i]) inputs[i].value = char;
                    });
                    const next = inputs[Math.min(digits.length, inputs.length - 1)];
                    next.focus();
                    next.select?.();
                    return;
                }

                if (value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    }

    async function handleSignIn(e) {
        e.preventDefault();

        const formData = new FormData(signInForm);
        const button = signInBtn;
        const errorDiv = document.getElementById('signin-error');
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');

        button.disabled = true;
        button.textContent = 'Signing in...';
        errorDiv.classList.add('hidden');

        try {
            const headers = {
                'Accept': 'application/json',
            };

            // Add CSRF token if available
            if (csrfMeta) {
                headers['X-CSRF-TOKEN'] = csrfMeta.content;
            }

            const response = await fetch('/auth/signin', {
                method: 'POST',
                headers: headers,
                body: formData
            });

            if (!response.ok) {
                console.error('Sign in error status:', response.status, response.statusText);
                let errorText = 'Terjadi kesalahan saat login';
                try {
                    const errorData = await response.json();
                    errorText = errorData.message || errorText;

                    if (errorData.requires_verification && errorData.email) {
                        closeModal(signInModal);
                        document.getElementById('otp-email').textContent = errorData.email;
                        document.getElementById('otp-email-hidden').value = errorData.email;
                        openModal(otpModal);
                        return;
                    }
                } catch (e) {
                    errorText = 'Status error: ' + response.status;
                }
                showError(errorDiv, errorText);
                return;
            }

            const data = await response.json();

            if (data.success) {
                const Swal = await loadSwal();
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    text: 'Selamat datang kembali!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.redirect_url || '/';
                });
            } else {
                showError(errorDiv, data.message || 'Login failed');
            }
        } catch (error) {
            console.error('Sign in exception:', error);
            showError(errorDiv, 'Terjadi kesalahan. Silakan coba lagi.');
        } finally {
            button.disabled = false;
            button.textContent = 'Sign In';
        }
    }

    async function handleSignUp(e) {
        e.preventDefault();

        const formData = new FormData(signUpForm);
        const button = signUpBtn;
        const errorDiv = document.getElementById('signup-error');

        // Check terms acceptance
        if (!document.getElementById('terms').checked) {
            showError(errorDiv, 'Please accept the Terms & Conditions');
            return;
        }

        button.disabled = true;
        button.textContent = 'Creating account...';
        errorDiv.classList.add('hidden');

        try {
            const response = await fetch('/auth/signup', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                // Close sign up modal and open OTP modal
                closeModal(signUpModal);
                document.getElementById('otp-email').textContent = data.email;
                document.getElementById('otp-email-hidden').value = data.email;
                openModal(otpModal);
                startResendCountdown();
            } else {
                if (data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        const errorSpan = document.getElementById(`signup-${key}-error`);
                        if (errorSpan) {
                            errorSpan.textContent = data.errors[key][0];
                            errorSpan.classList.remove('hidden');
                        }
                    });
                } else {
                    showError(errorDiv, data.message || 'Sign up failed');
                }
            }
        } catch (error) {
            showError(errorDiv, 'An error occurred. Please try again.');
        } finally {
            button.disabled = false;
            button.textContent = 'Sign Up';
        }
    }

    async function handleOtpVerification(e) {
        e.preventDefault();

        const otpCode = Array.from(otpInputs).map(input => input.value).join('');
        const email = document.getElementById('otp-email-hidden').value;
        const button = verifyOtpBtn;
        const errorDiv = document.getElementById('otp-error');

        if (otpCode.length !== 6) {
            showError(errorDiv, 'Please enter all 6 digits');
            return;
        }

        button.disabled = true;
        button.textContent = 'Verifying...';
        errorDiv.classList.add('hidden');

        try {
            const response = await fetch('/auth/verify-otp', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email, otp: otpCode })
            });

            const data = await response.json();

            if (data.success) {
                const Swal = await loadSwal();
                Swal.fire({
                    icon: 'success',
                    title: 'Verifikasi Berhasil!',
                    text: 'Akun Anda telah diverifikasi dan Anda sudah login.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.redirect_url || '/';
                });
            } else {
                showError(errorDiv, data.message || 'Verification failed');
                otpInputs.forEach(input => input.value = '');
                otpInputs[0].focus();
            }
        } catch (error) {
            showError(errorDiv, 'An error occurred. Please try again.');
        } finally {
            button.disabled = false;
            button.textContent = 'Verify Email';
        }
    }

    async function handleResendOtp() {
        const email = document.getElementById('otp-email-hidden').value;
        const button = resendOtpBtn;

        button.disabled = true;

        try {
            const response = await fetch('/auth/resend-otp', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email })
            });

            const data = await response.json();

            if (data.success) {
                startResendCountdown();
            }
        } catch (error) {
            console.error('Resend OTP error:', error);
        }
    }

    function startResendCountdown() {
        let countdown = 60;
        const countdownSpan = document.getElementById('resend-countdown');
        const button = resendOtpBtn;

        button.disabled = true;

        const interval = setInterval(() => {
            countdown--;
            countdownSpan.textContent = `(${countdown}s)`;

            if (countdown <= 0) {
                clearInterval(interval);
                countdownSpan.textContent = '';
                button.disabled = false;
            }
        }, 1000);
    }

    function showError(element, message) {
        element.textContent = message;
        element.classList.remove('hidden');
    }
}
