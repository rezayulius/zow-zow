import './bootstrap';
import { createIcons } from 'lucide';
import { icons } from './icons';
import { initVetScheduleWidget } from './vet-schedule';
import { initTestimonialsSection } from './testimonials';
import { initAuthModals } from './auth-modals';
import { initEmergencyModal, initFlashMessages } from './emergency-modal';
import { initDeferredAnalytics } from './analytics';

// Mobile menu toggle with smooth animation
function initMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    // wire:navigate calls this again on every page (the header is shared
    // across all pages via a Blade partial); guard so the click listener
    // below doesn't get bound twice on the same button.
    if (mobileMenuBtn && mobileMenuBtn.dataset.bound) return;

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.dataset.bound = '1';
        mobileMenuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            
            mobileMenuBtn.setAttribute('aria-expanded', String(isHidden));

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

    // Close the mobile menu whenever a nav link inside it is clicked. This
    // matters most for same-page anchor links (e.g. "Booking" while already
    // on "/") which no longer go through a JS click-intercept (see
    // initSmoothScrolling) now that header links use full "/path#section"
    // hrefs instead of bare "#section" ones.
    if (mobileMenu && !mobileMenu.dataset.autoCloseBound) {
        mobileMenu.dataset.autoCloseBound = '1';
        mobileMenu.querySelectorAll('a[href]').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                mobileMenu.classList.add('scale-y-95', 'opacity-0');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            });
        });
    }
}

// Smooth scrolling for same-page anchor links (bare "#section" hrefs only —
// header nav links now point at full "/path#section" URLs so wire:navigate
// can handle cross-page hash navigation; those never match this selector).
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        // wire:navigate re-runs this on every page; guard per-anchor so
        // repeat visits to the same page don't stack duplicate listeners.
        if (anchor.dataset.smoothBound) return;
        anchor.dataset.smoothBound = '1';

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
    // wire:navigate re-runs this on every page; the header partial is shared
    // (identical markup) across all pages, so without this guard the
    // window "scroll" listener below would be added again on every
    // navigation and stack up.
    if (window.__zowHeaderScrollBound) return;
    window.__zowHeaderScrollBound = true;

    let headerScrollTicking = false;
    const header = document.querySelector('header');
    const scrollProgress = document.getElementById('scrollProgress');

    // documentElement.scrollHeight/clientHeight are layout-triggering reads.
    // Reading them inside the scroll handler (i.e. on every frame the user
    // scrolls) forces a synchronous reflow each time something else on the
    // page has invalidated layout since the last read -- measured by
    // Lighthouse as "forced reflow". Page height only changes on
    // resize/content-load, not on scroll, so it's computed once and cached
    // instead of on every scroll frame.
    let cachedScrollableHeight = 0;
    function recomputeScrollableHeight() {
        cachedScrollableHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    }
    recomputeScrollableHeight();
    window.addEventListener('resize', recomputeScrollableHeight, { passive: true });

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
                const scrollHeight = cachedScrollableHeight;

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

    // wire:navigate re-runs this whenever the homepage is (re)visited; guard
    // against re-initializing (and starting a second setInterval loop) if
    // morphdom left the slider's DOM untouched from a previous visit.
    const heroSlider = document.querySelector('.hero-slider');
    if (heroSlider && heroSlider.dataset.bound) return;
    if (heroSlider) heroSlider.dataset.bound = '1';

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
        }, 1200); // Wait for exit animation to complete (0.5s + buffer)
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
    // wire:navigate re-runs this on every page; guard the window "scroll"
    // listener below so it doesn't get bound again on every navigation.
    if (window.__zowParallaxBound) return;
    window.__zowParallaxBound = true;

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
// Mobile Services menu: outer accordion (Services -> list of categories) plus
// a nested accordion per category (category -> its services), driven by
// data-category-toggle/data-category-panel attributes rather than fixed ids
// since the category list is dynamic (admin-managed).
function initMobileServicesAccordion() {
    const btn = document.getElementById('mobileServicesBtn');
    const dropdown = document.getElementById('mobileServicesDropdown');
    const icon = document.getElementById('mobileServicesIcon');

    if (btn && dropdown && icon && !btn.dataset.bound) {
        btn.dataset.bound = '1';
        btn.addEventListener('click', () => {
            const isHidden = dropdown.classList.contains('hidden');

            if (isHidden) {
                dropdown.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                dropdown.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    }

    document.querySelectorAll('[data-category-toggle]').forEach((toggleBtn) => {
        if (toggleBtn.dataset.bound) return;
        toggleBtn.dataset.bound = '1';

        toggleBtn.addEventListener('click', () => {
            const slug = toggleBtn.dataset.categoryToggle;
            const panel = document.querySelector(`[data-category-panel="${slug}"]`);
            const chevron = document.querySelector(`[data-category-icon="${slug}"]`);
            if (!panel) return;

            const isHidden = panel.classList.contains('hidden');
            panel.classList.toggle('hidden', !isHidden);
            chevron?.classList.toggle('rotate-180', isHidden);
        });
    });
}

// Initialize all page functionality. Runs on the initial hard page load
// (DOMContentLoaded) AND after every wire:navigate transition, since Livewire's
// SPA-like navigation swaps the page body without firing a new DOMContentLoaded
// event. Each function above guards its own listener bindings (dataset/window
// flags) so repeat calls across navigations don't stack duplicate handlers.
function runPageInit() {
    createIcons({ icons });

    initMobileMenu();
    initMobileServicesAccordion();
    initSmoothScrolling();
    initHeaderScrollEffect();
    initHeroSlider();
    initVetScheduleWidget();
    initTestimonialsSection();
    initAuthModals();
    initEmergencyModal();
    initParallax();
}

document.addEventListener('DOMContentLoaded', runPageInit);
document.addEventListener('livewire:navigated', runPageInit);

// Flash messages only ever come from a full-page redirect (never a
// wire:navigate transition), so this runs once on the initial hard load.
document.addEventListener('DOMContentLoaded', initFlashMessages);
document.addEventListener('DOMContentLoaded', initDeferredAnalytics);

// Re-render Lucide icons after any Livewire component update (e.g. live search
// or pagination), since morphing swaps in fresh `data-lucide` placeholders that
// haven't been converted to inline SVG yet.
document.addEventListener('livewire:init', () => {
    Livewire.hook('morph.updated', () => {
        createIcons({ icons });
    });
});