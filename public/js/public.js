/* ========================================
   PUBLIC PAGES JS — SIT Mutiara Qur'an
   ======================================== */

document.addEventListener('DOMContentLoaded', function () {

    /* ======= NAVBAR SCROLL ======= */
    const header = document.querySelector('.public-header');
    const navbar = document.querySelector('.public-navbar');
    if (header) {
        window.addEventListener('scroll', function () {
            const isScrolled = window.scrollY > 30;
            header.classList.toggle('scrolled', isScrolled);
            if (navbar) {
                navbar.classList.toggle('scrolled', isScrolled);
            }
        });
    }

    /* ======= HAMBURGER TOGGLE ======= */
    const hamburger = document.getElementById('navHamburger');
    const mobileMenu = document.getElementById('navMobileMenu');

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('open');
            mobileMenu.classList.toggle('open');
            document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
        });

        // Close on link click
        mobileMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                hamburger.classList.remove('open');
                mobileMenu.classList.remove('open');
                document.body.style.overflow = '';
            });
        });
    }

    /* ======= SMOOTH SCROLL ======= */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* ======= SCROLL REVEAL ======= */
    var fadeEls = document.querySelectorAll('.fade-up');
    if (fadeEls.length > 0) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        fadeEls.forEach(function (el) { observer.observe(el); });
    }

    /* ======= COUNTER ANIMATION ======= */
    var counters = document.querySelectorAll('[data-count]');
    if (counters.length > 0) {
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var target = parseInt(el.getAttribute('data-count'), 10);
                    var suffix = el.getAttribute('data-suffix') || '';
                    var duration = 1500;
                    var start = performance.now();

                    function tick(now) {
                        var progress = Math.min((now - start) / duration, 1);
                        var eased = 1 - Math.pow(1 - progress, 4);
                        el.textContent = Math.round(target * eased) + suffix;
                        if (progress < 1) requestAnimationFrame(tick);
                    }

                    requestAnimationFrame(tick);
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(function (el) { counterObserver.observe(el); });
    }

    /* ======= LUCIDE ICONS ======= */
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    /* ======= BACK TO TOP BUTTON ======= */
    const backToTopBtn = document.getElementById('backToTop');
    if (backToTopBtn) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 400) {
                backToTopBtn.classList.remove('translate-y-16', 'opacity-0', 'pointer-events-none');
                backToTopBtn.classList.add('translate-y-0', 'opacity-1', 'pointer-events-auto');
            } else {
                backToTopBtn.classList.remove('translate-y-0', 'opacity-1', 'pointer-events-auto');
                backToTopBtn.classList.add('translate-y-16', 'opacity-0', 'pointer-events-none');
            }
        });

        backToTopBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

});

