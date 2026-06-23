// resources/js/public-ppdb.js

document.addEventListener("DOMContentLoaded", () => {
    /* ==========================================================================
       1. INTERSECTION OBSERVER UNTUK ANIMASI REVEAL
       ========================================================================== */
    const revealElements = document.querySelectorAll('.reveal');


    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            } else if (entry.target.classList.contains('reveal-repeat')) {
                entry.target.classList.remove('is-visible');
            }
        });
    }, {
        root: null,
        rootMargin: "-10% 0px -20% 0px",
        threshold: 0.1
    });

    revealElements.forEach(el => revealObserver.observe(el));

    /* ==========================================================================
       2. TIMELINE PROGRESS LINE SINKRON SCROLL
       ========================================================================== */
    const timelineWrapper = document.querySelector('.timeline-wrapper');
    const timelineProgress = document.querySelector('.timeline-progress');

    if (timelineWrapper && timelineProgress) {
        updateTimelineProgress();
        window.addEventListener('scroll', updateTimelineProgress, { passive: true });

        function updateTimelineProgress() {
            const rect = timelineWrapper.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            const progressInPx = (windowHeight / 2) - rect.top;

            const clampedProgress = Math.max(0, Math.min(progressInPx, rect.height));
            const percentage = (clampedProgress / rect.height) * 100;

            timelineProgress.style.setProperty('--timeline-progress', `${percentage}%`);
        }
    }
});
