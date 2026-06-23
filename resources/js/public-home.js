        /* ROBUST REVEAL OBSERVER */
        document.addEventListener('DOMContentLoaded', () => {
            // Add ready class to body to enable opacity: 0
            document.body.classList.add('js-reveal-ready');

            const revealElements = document.querySelectorAll('.reveal');
            
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    } else if (entry.target.classList.contains('reveal-repeat')) {
                        entry.target.classList.remove('is-visible');
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: "-10% 0px -25% 0px"
            });

            revealElements.forEach(el => revealObserver.observe(el));
        });

                /* FAQ ACCORDION TOGGLE */
        window.toggleFaq = function(btn) {
            const item = btn.parentElement;
            const content = btn.nextElementSibling;

            const isOpen = item.classList.contains('faq-open');

            // Close all FAQ items
            document.querySelectorAll('.premium-faq-item').forEach(el => {
                el.classList.remove('faq-open');
                el.querySelector('.premium-faq-content').style.maxHeight = null;
            });

            if (!isOpen) {
                item.classList.add('faq-open');
                content.style.maxHeight = content.scrollHeight + "px";
            } else {
                item.classList.remove('faq-open');
                content.style.maxHeight = null;
            }
        };

        /* DYNAMIC PROGRAM FILTERING WITH STAGGERED RE-ENTRY */
        window.filterPrograms = function(category, btn) {
            // Update active button styling
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-emerald-600', 'text-white', 'shadow-md', 'shadow-emerald-200');
                b.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200', 'hover:bg-slate-50');
            });
            btn.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200', 'hover:bg-slate-50');
            btn.classList.add('bg-emerald-600', 'text-white', 'shadow-md', 'shadow-emerald-200');

            // Hide all cards first simultaneously
            const cards = document.querySelectorAll('.program-item');
            cards.forEach(card => {
                card.style.transitionDelay = '0ms'; // reset delay for quick exit
                card.classList.remove('is-visible'); // triggers exit animation
            });

            // Wait for exit animation to almost finish, then re-layout
            setTimeout(() => {
                let visibleCount = 0;
                cards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    if (category === 'all' || cardCat === category) {
                        card.style.display = 'block';
                        // Re-trigger entrance animation with staggered delay
                        setTimeout(() => {
                            card.style.transitionDelay = (120 + (visibleCount * 150)) + 'ms';
                            card.classList.add('is-visible');
                            visibleCount++;
                        }, 50);
                    } else {
                        card.style.display = 'none';
                    }
                });
            }, 500); // 500ms allows the exit to feel fluid before re-layout
        };

        /* TESTIMONIAL SLIDER CONTROLLER */
        let currentSlide = 0;
        const totalSlides = 3;
        const track = document.getElementById('testiSliderTrack');
        const dots = document.querySelectorAll('.slider-dot');

        function updateSlider() {
            if (track) {
                track.style.transform = `translateX(-${currentSlide * 33.333}%)`;
                dots.forEach((dot, idx) => {
                    if (idx === currentSlide) {
                        dot.classList.remove('bg-slate-300');
                        dot.classList.add('bg-emerald-600', 'w-6', 'animate-pulse');
                    } else {
                        dot.classList.remove('bg-emerald-600', 'w-6', 'animate-pulse');
                        dot.classList.add('bg-slate-300');
                    }
                });
            }
        }

        window.nextSlide = function() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        };

        window.prevSlide = function() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        };

        window.goToSlide = function(slideIdx) {
            currentSlide = slideIdx;
            updateSlider();
        };

        // Auto play testimonial slider every 8 seconds
        let sliderInterval = setInterval(window.nextSlide, 8000);

        // Reset auto play timer on manual navigation
        function resetSliderTimer() {
            clearInterval(sliderInterval);
            sliderInterval = setInterval(window.nextSlide, 8000);
        }

        // Wrap controls in timer resets
        const originalNext = window.nextSlide;
        window.nextSlide = function() {
            originalNext();
            resetSliderTimer();
        }
        const originalPrev = window.prevSlide;
        window.prevSlide = function() {
            originalPrev();
            resetSliderTimer();
        }
        const originalGoTo = window.goToSlide;
        window.goToSlide = function(idx) {
            originalGoTo(idx);
            resetSliderTimer();
        }

        // PPDB Popup Logic
        document.addEventListener('DOMContentLoaded', () => {
            const ppdbPopup = document.getElementById('ppdbPopup');
            const ppdbOverlay = document.getElementById('ppdbOverlay');
            const ppdbContent = document.getElementById('ppdbModalContent');
            const btnClose = document.getElementById('closePpdbBtn');
            const btnCloseFooter = document.getElementById('closePpdbFooterBtn');
            
            if (ppdbPopup && !sessionStorage.getItem('ppdbPopupClosed')) {
                // Show modal after slight delay
                setTimeout(() => {
                    ppdbPopup.classList.remove('hidden');
                    ppdbPopup.classList.add('flex');
                    
                    // Trigger animation frame
                    setTimeout(() => {
                        ppdbOverlay.classList.remove('opacity-0');
                        ppdbOverlay.classList.add('opacity-100');
                        ppdbContent.classList.remove('opacity-0', 'scale-95');
                        ppdbContent.classList.add('opacity-100', 'scale-100');
                    }, 50);
                }, 1500); // 1.5s delay before showing
                
                const closePopup = () => {
                    ppdbOverlay.classList.remove('opacity-100');
                    ppdbOverlay.classList.add('opacity-0');
                    ppdbContent.classList.remove('opacity-100', 'scale-100');
                    ppdbContent.classList.add('opacity-0', 'scale-95');
                    
                    setTimeout(() => {
                        ppdbPopup.classList.add('hidden');
                        ppdbPopup.classList.remove('flex');
                        sessionStorage.setItem('ppdbPopupClosed', 'true');
                    }, 300);
                };
                
                if (btnClose) btnClose.addEventListener('click', closePopup);
                if (btnCloseFooter) btnCloseFooter.addEventListener('click', closePopup);
                if (ppdbOverlay) ppdbOverlay.addEventListener('click', closePopup);
            }
        });
