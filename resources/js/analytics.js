// GA4 accounts for ~157KB of JS on first load, almost all of it unused
// before the visitor does anything (per Lighthouse's coverage audit). It's
// loaded on the first scroll/click/touch/keypress instead -- or after a
// fixed fallback delay, so visitors who read without interacting (or on
// assistive tech that doesn't fire these events) still get tracked.
const INTERACTION_EVENTS = ['scroll', 'mousemove', 'keydown', 'touchstart', 'click'];
const FALLBACK_DELAY_MS = 4000;

export function initDeferredAnalytics() {
    const measurementId = document.documentElement.dataset.gaId;
    if (!measurementId || window.__gaLoaded) return;

    let fired = false;
    const load = () => {
        if (fired) return;
        fired = true;
        window.__gaLoaded = true;

        INTERACTION_EVENTS.forEach((evt) => document.removeEventListener(evt, load));
        clearTimeout(fallbackTimer);

        const script = document.createElement('script');
        script.async = true;
        script.src = `https://www.googletagmanager.com/gtag/js?id=${measurementId}`;
        document.head.appendChild(script);

        window.dataLayer = window.dataLayer || [];
        window.gtag = function gtag() { window.dataLayer.push(arguments); };
        window.gtag('js', new Date());
        window.gtag('config', measurementId);
    };

    const fallbackTimer = setTimeout(load, FALLBACK_DELAY_MS);
    INTERACTION_EVENTS.forEach((evt) => document.addEventListener(evt, load, { once: true, passive: true }));
}
