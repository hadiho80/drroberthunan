import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const supportsAnimation =
        typeof Element !== 'undefined' &&
        typeof Element.prototype.animate === 'function' &&
        typeof window.matchMedia === 'function' &&
        !window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (supportsAnimation) {
        document.querySelectorAll('.service-card, .quote-card, .fact-card, .service-feature-card, .highlight-tile').forEach((element, index) => {
            element.animate(
                [
                    { opacity: 0, transform: 'translateY(18px)' },
                    { opacity: 1, transform: 'translateY(0)' },
                ],
                {
                    duration: 500,
                    delay: index * 80,
                    easing: 'ease-out',
                    fill: 'both',
                },
            );
        });
    }

    const menuToggle = document.querySelector('[data-menu-toggle]');
    const mobileNav = document.querySelector('[data-mobile-nav]');

    if (menuToggle && mobileNav) {
        menuToggle.addEventListener('click', () => {
            const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', String(!isOpen));
            menuToggle.classList.toggle('is-open', !isOpen);
            mobileNav.hidden = isOpen;
        });
    }

    document.querySelectorAll('[data-dropdown]').forEach((dropdown) => {
        const trigger = dropdown.querySelector('[data-dropdown-trigger]');
        const menu = dropdown.querySelector('[data-dropdown-menu]');

        if (!trigger || !menu) {
            return;
        }

        trigger.addEventListener('click', () => {
            const isOpen = trigger.getAttribute('aria-expanded') === 'true';
            trigger.setAttribute('aria-expanded', String(!isOpen));
            dropdown.classList.toggle('is-open', !isOpen);
            menu.hidden = isOpen;
        });
    });
});
