// Testimonials/Articles/News/Promo/FAQ tab section on the homepage: tab
// switching, article & news modals, Google review "read more" truncation,
// FAQ accordion, and promo/social share copy buttons.
//
// Modal bodies are kept inert inside a <template> in the blade markup and
// only cloned into the DOM the first time they're opened, so the page never
// pays to parse/paint hidden modal content (including remote images) that
// most visitors never see.

export function initTestimonialsSection() {
    const section = document.getElementById('testimoni');
    if (!section) return; // Section not present on this page.

    initTabs(section);
    initGoogleReviewToggle(section);
    initFaq();
    initPromoCopy();
    initModals();
    initShare();
}

// --- Tabs ---------------------------------------------------------------

const TAB_BG_CLASSES = {
    testimonials: 'bg-gradient-to-r from-forest-moss-green-500 to-forest-moss-green-600',
    articles: 'bg-gradient-to-r from-soft-blush-pink-500 to-soft-blush-pink-600',
    news: 'bg-gradient-to-r from-chai-500 to-chai-600',
    promo: 'bg-gradient-to-r from-old-mustard-yellow-500 to-old-mustard-yellow-600',
    faqs: 'bg-carob-600',
};

function initTabs(section) {
    section.querySelectorAll('.tab-btn').forEach((tab) => {
        tab.addEventListener('click', () => activateTab(section, tab));
    });
}

function activateTab(section, tab) {
    section.querySelectorAll('.tab-btn').forEach((t) => {
        t.classList.remove('active', 'text-white', 'shadow-md');
        t.classList.add('text-carob-600', 'bg-white', 'md:bg-transparent');

        const iconSpan = t.querySelector('span[class*="p-1.5"]');
        if (iconSpan) {
            iconSpan.classList.remove('bg-white/20');
            iconSpan.classList.add('bg-soft-linen-100');
        }

        t.querySelector('.tab-active-bg')?.remove();
    });

    section.querySelectorAll('.tab-content').forEach((c) => {
        c.classList.add('hidden', 'opacity-0');
        c.classList.remove('active', 'opacity-100');
    });

    tab.classList.add('active', 'text-white', 'shadow-md');
    tab.classList.remove('text-carob-600', 'bg-white', 'md:bg-transparent');

    const activeIconSpan = tab.querySelector('span[class*="p-1.5"]');
    if (activeIconSpan) {
        activeIconSpan.classList.remove('bg-soft-linen-100');
        activeIconSpan.classList.add('bg-white/20');
    }

    const tabName = tab.dataset.tab;
    const bgDiv = document.createElement('div');
    bgDiv.className = `absolute inset-0 tab-active-bg ${TAB_BG_CLASSES[tabName] || 'bg-carob-600'}`;
    tab.insertBefore(bgDiv, tab.firstChild);

    const target = document.getElementById(`${tabName}-content`);
    if (!target) return;
    target.classList.remove('hidden');
    requestAnimationFrame(() => target.classList.add('active', 'opacity-100'));
}

// --- Google reviews "read more" -----------------------------------------

function initGoogleReviewToggle(section) {
    // Read every element's layout first, then apply the resulting class
    // changes in a second pass — interleaving reads and writes here would
    // force a synchronous layout recalculation on every iteration.
    const texts = Array.from(section.querySelectorAll('.google-review-text'));
    const isTruncated = texts.map((el) => el.scrollHeight > el.clientHeight + 1);

    texts.forEach((el, i) => {
        if (!isTruncated[i]) return;
        const toggle = el.nextElementSibling;
        if (toggle?.classList.contains('google-review-toggle')) {
            toggle.classList.remove('hidden');
        }
    });

    document.addEventListener('click', (event) => {
        const button = event.target.closest('[data-action="toggle-google-review"]');
        if (!button) return;

        const text = button.previousElementSibling;
        const expanded = text.classList.toggle('line-clamp-5');
        text.classList.toggle('line-clamp-none');
        button.textContent = expanded ? button.dataset.moreText : button.dataset.lessText;
    });
}

// --- FAQ accordion --------------------------------------------------------

function initFaq() {
    document.addEventListener('click', (event) => {
        const button = event.target.closest('.faq-btn');
        if (button) toggleFaq(button);
    });
}

function toggleFaq(button) {
    const container = button.parentElement;
    const content = container.querySelector('.faq-content');
    const isHidden = content.classList.contains('hidden');

    document.querySelectorAll('.faq-btn').forEach((btn) => {
        if (btn === button) return;
        const otherContainer = btn.parentElement;
        if (!otherContainer.classList.contains('active')) return;

        otherContainer.classList.remove('active');
        const otherContent = otherContainer.querySelector('.faq-content');
        otherContent.style.maxHeight = '0px';
        otherContent.style.opacity = '0';
        setTimeout(() => otherContent.classList.add('hidden'), 300);
    });

    if (isHidden) {
        container.classList.add('active');
        content.classList.remove('hidden');
        void content.offsetWidth; // Force reflow so the max-height transition runs.
        content.style.maxHeight = `${content.scrollHeight}px`;
        content.style.opacity = '1';
    } else {
        container.classList.remove('active');
        content.style.maxHeight = '0px';
        content.style.opacity = '0';
        setTimeout(() => content.classList.add('hidden'), 300);
    }
}

// --- Promo code copy --------------------------------------------------------

function initPromoCopy() {
    document.addEventListener('click', (event) => {
        const button = event.target.closest('[data-action="copy-promo-code"]');
        if (!button) return;

        const code = button.dataset.promoCode;
        if (!code) return;

        copyText(code, () => flashCopiedIcon(button));
    });
}

function flashCopiedIcon(button) {
    const icon = button.querySelector('i[data-lucide]');
    if (!icon) return;

    const original = icon.getAttribute('data-lucide');
    icon.setAttribute('data-lucide', 'check');
    if (typeof lucide !== 'undefined') lucide.createIcons();

    setTimeout(() => {
        icon.setAttribute('data-lucide', original);
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }, 1500);
}

// --- Article/news modals ---------------------------------------------------
// Modal bodies live inside a <template> (see the blade partial) so the
// browser never parses/loads them until the first time they're opened.

function initModals() {
    let lastFocusedTrigger = null;

    document.addEventListener('click', (event) => {
        const opener = event.target.closest('[data-action="open-modal"]');
        if (opener) {
            event.preventDefault();
            lastFocusedTrigger = opener;
            openModal(opener.dataset.modalId);
            return;
        }

        const closer = event.target.closest('[data-action="close-modal"]');
        if (closer) {
            closeModal(closer.closest('[data-modal]')?.id, lastFocusedTrigger);
            return;
        }

        // Clicking the dimmed backdrop itself (not the card inside it) also closes it.
        const backdrop = event.target.closest('[data-modal]');
        if (backdrop && event.target === backdrop) {
            closeModal(backdrop.id, lastFocusedTrigger);
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        const openModalEl = document.querySelector('[data-modal]:not(.hidden)');
        if (openModalEl) closeModal(openModalEl.id, lastFocusedTrigger);
    });

    // Open a shared modal directly from the URL hash, e.g. #modal-article-12
    const hash = window.location.hash.slice(1);
    const match = hash.match(/^modal-(article|news)-(\d+)$/);
    if (match && document.getElementById(hash)) {
        const tabName = match[1] === 'article' ? 'articles' : 'news';
        const section = document.getElementById('testimoni');
        const tabButton = section?.querySelector(`.tab-btn[data-tab="${tabName}"]`);
        if (section && tabButton) activateTab(section, tabButton);
        openModal(hash);
    }
}

function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    instantiateModalContent(modal);

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    modal.querySelector('[data-action="close-modal"]')?.focus();

    trackModalView(id);
}

function closeModal(id, lastFocusedTrigger) {
    const modal = id && document.getElementById(id);
    if (!modal) return;

    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    lastFocusedTrigger?.focus();
}

function instantiateModalContent(modal) {
    if (modal.dataset.loaded === 'true') return;

    const template = modal.querySelector('template');
    if (!template) return;

    modal.appendChild(template.content.cloneNode(true));
    modal.dataset.loaded = 'true';

    if (typeof lucide !== 'undefined') lucide.createIcons();
}

function trackModalView(modalId) {
    const match = modalId.match(/^modal-(article|news)-(\d+)$/);
    if (!match) return;

    const [, type, contentId] = match;
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!token) return;

    fetch(`/content/${type}/${contentId}/view`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
        },
    })
        .then((response) => (response.ok ? response.json() : null))
        .then((data) => {
            if (!data) return;
            const counter = document.getElementById(`views-count-${type}-${contentId}`);
            if (counter) {
                const template = counter.dataset.viewsTemplate || '__COUNT__ views';
                counter.textContent = template.replace('__COUNT__', data.views);
            }
        })
        .catch(() => {});
}

// --- Social share & copy link -----------------------------------------------

function initShare() {
    document.addEventListener('click', (event) => {
        const facebookBtn = event.target.closest('[data-action="share-facebook"]');
        if (facebookBtn) return shareToFacebook(facebookBtn);

        const xBtn = event.target.closest('[data-action="share-x"]');
        if (xBtn) return shareToX(xBtn);

        const copyBtn = event.target.closest('[data-action="copy-share-link"]');
        if (copyBtn) return copyShareLink(copyBtn);
    });
}

function getShareContext(el) {
    const container = el.closest('[data-share-url]');
    return {
        url: container?.dataset.shareUrl || window.location.href,
        title: container?.dataset.shareTitle || document.title,
    };
}

function shareToFacebook(el) {
    const { url } = getShareContext(el);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank', 'noopener,noreferrer,width=600,height=500');
}

function shareToX(el) {
    const { url, title } = getShareContext(el);
    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`, '_blank', 'noopener,noreferrer,width=600,height=500');
}

function copyShareLink(el) {
    const { url } = getShareContext(el);
    const label = el.querySelector('.copy-link-label');
    if (!label) return;

    const originalLabel = label.textContent;
    copyText(url, () => {
        label.textContent = el.dataset.copiedText || 'Copied!';
        setTimeout(() => {
            label.textContent = originalLabel;
        }, 2000);
    });
}

function copyText(text, onDone) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(onDone).catch(() => fallbackCopyText(text, onDone));
    } else {
        fallbackCopyText(text, onDone);
    }
}

function fallbackCopyText(text, onDone) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();
    try {
        document.execCommand('copy');
    } catch (e) {
        // Clipboard unavailable; the user can still select+copy manually.
    }
    document.body.removeChild(textarea);
    onDone();
}
