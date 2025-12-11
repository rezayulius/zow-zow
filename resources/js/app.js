import './bootstrap';

// Mobile menu toggle with smooth animation
function initMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                // Open
                mobileMenu.classList.remove('hidden');
                // Small delay to allow display:block to apply before transition
                setTimeout(() => {
                    mobileMenu.classList.remove('scale-y-95', 'opacity-0');
                    mobileMenu.classList.add('scale-y-100', 'opacity-100');
                }, 10);
            } else {
                // Close
                mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                mobileMenu.classList.add('scale-y-95', 'opacity-0');
                
                // Wait for transition to finish before hiding
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300); // Match duration-300
            }
        });
    }
}

// Smooth scrolling for navigation links
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobileMenu');
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                    mobileMenu.classList.add('scale-y-95', 'opacity-0');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                    }, 300);
                }
            }
        });
    });
}

// Header scroll effect & Progress bar (Optimized with throttling)
function initHeaderScrollEffect() {
    let headerScrollTicking = false;
    const header = document.querySelector('header');
    const scrollProgress = document.getElementById('scrollProgress');
    
    function updateHeaderAndProgress() {
        try {
            const scrollY = window.scrollY;
            
            // Header scale effect
            if (header) {
                const headerDiv = header.querySelector('div');
                if (scrollY > 100) {
                    header.classList.add('scale-95');
                    if (headerDiv) {
                        headerDiv.classList.add('shadow-xl');
                        headerDiv.classList.remove('shadow-lg');
                    }
                } else {
                    header.classList.remove('scale-95');
                    if (headerDiv) {
                        headerDiv.classList.add('shadow-lg');
                        headerDiv.classList.remove('shadow-xl');
                    }
                }
            }

            // Progress bar animation (optimized calculation with overflow protection)
            if (scrollProgress) {
                const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                
                if (scrollHeight > 0) {
                    // Calculate scroll percentage with improved precision
                    let scrollPercentage = (scrollY / scrollHeight) * 100;
                    
                    // Apply strict bounds with proper padding margin (95% max to leave space)
                    scrollPercentage = Math.min(95, Math.max(0, scrollPercentage));
                    
                    // Round to prevent floating point precision issues
                    scrollPercentage = Math.round(scrollPercentage * 10) / 10;
                    
                    // Update width to reflect scroll progress with a smooth transition
                    scrollProgress.style.width = `${scrollPercentage}%`;
                }
            }
        } catch (error) {
            console.warn('Progress bar update error:', error);
        } finally {
            headerScrollTicking = false;
        }
    }
    
    function requestHeaderScrollTick() {
        if (!headerScrollTicking) {
            requestAnimationFrame(updateHeaderAndProgress);
            headerScrollTicking = true;
        }
    }
    
    window.addEventListener('scroll', requestHeaderScrollTick, { passive: true });
    
    // Initialize progress bar
    if (scrollProgress) {
        scrollProgress.style.width = '0%';
        
        // Initial call to set proper state
        updateHeaderAndProgress();
    }
}

// Hero Slider Functionality
function initHeroSlider() {
    const slides = document.querySelectorAll('.slide');
    if (slides.length === 0) return;

    let currentSlide = 0;
    let slideInterval;
    const slideDuration = 5000; // 5 seconds per slide

    function updateSlide(index) {
        // Add exiting class to current slide for exit animation
        if (slides[currentSlide]) {
            slides[currentSlide].classList.add('exiting');
        }

        // Wait for exit animation to complete, then switch slides
        setTimeout(() => {
            // Remove active and exiting class from all slides
            slides.forEach((slide, i) => {
                slide.classList.remove('active', 'prev', 'exiting');
                if (i < index) {
                    slide.classList.add('prev');
                }
            });
            // Add active class to new slide
            slides[index].classList.add('active');

            // Update progress indicators
            updateProgressIndicators(index);

            // Update navigation buttons
            updateNavigationButtons(index);

            currentSlide = index;
        }, 600); // Wait for exit animation to complete (0.5s + buffer)
    }

    function updateProgressIndicators(activeIndex) {
        const progressIndicators = document.querySelectorAll('.progress-indicator');
        
        progressIndicators.forEach((indicator, index) => {
            const progressFill = indicator.querySelector('.progress-bar-fill');
            
            if (index === activeIndex) {
                indicator.classList.add('active');
                if (progressFill) {
                    // Reset progress bar immediately without transition
                    progressFill.style.transition = 'none';
                    progressFill.style.width = '0%';
                    progressFill.offsetHeight; // Trigger reflow
                    
                    // Start animation after a small delay
                    setTimeout(() => {
                        progressFill.style.transition = 'width 5s linear';
                        progressFill.style.width = '100%';
                    }, 50);
                }
            } else {
                indicator.classList.remove('active');
                if (progressFill) {
                    // Reset non-active progress bars immediately
                    progressFill.style.transition = 'none';
                    progressFill.style.width = '0%';
                }
            }
        });
    }

    function updateNavigationButtons(activeIndex) {
        const navButtons = document.querySelectorAll('.slide-nav-btn');
        
        navButtons.forEach((button, index) => {
            if (index === activeIndex) {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
        });
    }

    function goToSlide(index) {
        if (index !== currentSlide && index >= 0 && index < slides.length) {
            updateSlide(index);
            restartSlider();
        }
    }

    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        updateSlide(next);
        restartSlider();
    }

    function startSlider() {
        slideInterval = setInterval(() => {
            nextSlide();
        }, slideDuration);
    }

    function stopSlider() {
        clearInterval(slideInterval);
    }

    function restartSlider() {
        stopSlider();
        startSlider();
    }

    // Initialize slider
    updateSlide(0);
    startSlider();

    // Add event listeners for navigation buttons
    const navButtons = document.querySelectorAll('.slide-nav-btn');
    navButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            goToSlide(index);
        });
    });

    // Initialize progress indicators
    updateProgressIndicators(0);
    updateNavigationButtons(0);

    // Pause slider on hover
    const heroSlider = document.querySelector('.hero-slider');
    if (heroSlider) {
        heroSlider.addEventListener('mouseenter', () => {
            stopSlider();
        });

        heroSlider.addEventListener('mouseleave', () => {
            startSlider();
        });
    }
}

// Parallax Scrolling Effect
function initParallax() {
    const parallaxElements = document.querySelectorAll('.parallax-bg, .parallax-element');
    
    function updateParallax() {
        const scrollTop = window.pageYOffset;
        const windowHeight = window.innerHeight;
        
        parallaxElements.forEach(element => {
            const rect = element.getBoundingClientRect();
            const elementTop = rect.top + scrollTop;
            
            // Check if element is in viewport
            if (rect.bottom >= 0 && rect.top <= windowHeight) {
                const speed = element.dataset.parallaxSpeed || 0.5;
                const yPos = -(scrollTop - elementTop) * speed;
                
                if (element.classList.contains('parallax-slow')) {
                    element.style.setProperty('--parallax-offset-slow', `${yPos * 0.3}px`);
                } else if (element.classList.contains('parallax-medium')) {
                    element.style.setProperty('--parallax-offset-medium', `${yPos * 0.5}px`);
                } else if (element.classList.contains('parallax-fast')) {
                    element.style.setProperty('--parallax-offset-fast', `${yPos * 0.8}px`);
                } else {
                    element.style.transform = `translateY(${yPos}px)`;
                }
            }
        });
    }
    
    // Throttle scroll events for better performance
    let ticking = false;
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
            setTimeout(() => { ticking = false; }, 16);
        }
    }
    
    window.addEventListener('scroll', requestTick);
    updateParallax(); // Initial call
}

// Mobile services dropdown toggle
function initMobileServicesDropdown() {
    const btn = document.getElementById('mobileServicesBtn');
    const dropdown = document.getElementById('mobileServicesDropdown');
    const icon = document.getElementById('mobileServicesIcon');

    if (btn && dropdown && icon) {
        btn.addEventListener('click', () => {
            const isHidden = dropdown.classList.contains('hidden');
            
            if (isHidden) {
                // Open
                dropdown.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                // Close
                dropdown.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    }
}

// Initialize all functions when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Initialize all functionality
    initMobileMenu();
    initMobileServicesDropdown();
    initSmoothScrolling();
    initHeaderScrollEffect();
    initHeroSlider();
    initParallax();
});