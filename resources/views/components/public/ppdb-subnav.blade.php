<div id="ppdb-subnav-wrapper" class="bg-white border-b border-slate-200 sticky top-[72px] z-40 shadow-sm transition-all duration-300">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 flex gap-4 overflow-x-auto py-3 no-scrollbar scroll-smooth">
        @php
            $navs = [
                ['id' => 'informasi', 'label' => 'Informasi'],
                ['id' => 'timeline', 'label' => 'Timeline'],
                ['id' => 'alur', 'label' => 'Alur'],
                ['id' => 'brosur', 'label' => 'Download Brosur'],
                ['id' => 'faq', 'label' => 'FAQ'],
                ['id' => 'kontak', 'label' => 'Kontak'],
            ];
        @endphp
        
        @foreach($navs as $nav)
            <a href="#{{ $nav['id'] }}" class="ppdb-nav-link whitespace-nowrap px-4 py-2 text-sm font-bold text-slate-500 hover:text-emerald-600 rounded-xl transition-all duration-300">
                {{ $nav['label'] }}
            </a>
        @endforeach
    </div>
</div>

<style>
    .ppdb-nav-link.active {
        background-color: #ecfdf5; /* emerald-50 */
        color: #059669; /* emerald-600 */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('.ppdb-nav-link');
        const sections = Array.from(navLinks).map(link => {
            const id = link.getAttribute('href').substring(1);
            return document.getElementById(id);
        }).filter(section => section !== null);

        // Smooth scroll for nav links
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    // Calculate offset taking into account main navbar and subnav heights
                    const headerOffset = 130; 
                    const elementPosition = targetSection.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                }
            });
        });

        // Intersection Observer for scroll spy
        const observerOptions = {
            root: null,
            rootMargin: '-140px 0px -40% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const currentId = entry.target.id;
                    navLinks.forEach(link => {
                        if (link.getAttribute('href').substring(1) === currentId) {
                            link.classList.add('active');
                            // Optional: scroll nav container to active link
                            link.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            });
        }, observerOptions);

        sections.forEach(section => observer.observe(section));
    });
</script>
