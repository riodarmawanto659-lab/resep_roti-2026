(() => {
    const ready = (callback) => {
        if (document.readyState !== 'loading') {
            callback();
            return;
        }

        document.addEventListener('DOMContentLoaded', callback);
    };

    ready(() => {
        const header = document.getElementById('siteHeader');
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const backToTop = document.getElementById('backToTop');
        const glow = document.querySelector('.mouse-glow');

        const setHeaderState = () => {
            if (!header) return;
            header.classList.toggle('nav-scrolled', window.scrollY > 12);
        };

        setHeaderState();
        window.addEventListener('scroll', setHeaderState, { passive: true });

        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                const isOpen = mobileBtn.getAttribute('aria-expanded') === 'true';

                mobileBtn.setAttribute('aria-expanded', String(!isOpen));
                mobileBtn.classList.toggle('is-open', !isOpen);
                mobileMenu.classList.toggle('hidden', isOpen);
            });

            mobileMenu.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', () => {
                    mobileBtn.setAttribute('aria-expanded', 'false');
                    mobileBtn.classList.remove('is-open');
                    mobileMenu.classList.add('hidden');
                });
            });
        }

        const revealItems = document.querySelectorAll('[data-reveal], .reveal');
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.14, rootMargin: '0px 0px -40px 0px' });

            revealItems.forEach((item, index) => {
                item.style.transitionDelay = `${Math.min(index % 6, 5) * 55}ms`;
                observer.observe(item);
            });
        } else {
            revealItems.forEach((item) => item.classList.add('is-visible'));
        }

        const animateCounter = (counter) => {
            const target = Number(counter.dataset.target || 0);
            const duration = 900;
            const start = performance.now();

            const tick = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                counter.textContent = Math.round(target * eased).toLocaleString('id-ID');

                if (progress < 1) {
                    requestAnimationFrame(tick);
                }
            };

            requestAnimationFrame(tick);
        };

        const counters = document.querySelectorAll('.counter[data-target]');
        if ('IntersectionObserver' in window) {
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach((counter) => counterObserver.observe(counter));
        } else {
            counters.forEach(animateCounter);
        }

        const getSavedRecipes = () => {
            try {
                return JSON.parse(localStorage.getItem('savedRecipes') || '[]');
            } catch (error) {
                return [];
            }
        };

        const setSavedRecipes = (recipes) => {
            localStorage.setItem('savedRecipes', JSON.stringify([...new Set(recipes)]));
        };

        const updateSaveButtons = () => {
            const saved = getSavedRecipes();

            document.querySelectorAll('.js-save-recipe[data-recipe]').forEach((button) => {
                const recipeId = String(button.dataset.recipe);
                const isSaved = saved.includes(recipeId);

                button.classList.toggle('is-saved', isSaved);
                button.innerHTML = isSaved
                    ? button.classList.contains('save-button') ? '♥' : '♥ Tersimpan'
                    : button.classList.contains('save-button') ? '♡' : '♡ Simpan Resep';
            });
        };

        document.querySelectorAll('.js-save-recipe[data-recipe]').forEach((button) => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                event.stopPropagation();

                const recipeId = String(button.dataset.recipe);
                const saved = getSavedRecipes();
                const nextSaved = saved.includes(recipeId)
                    ? saved.filter((id) => id !== recipeId)
                    : [...saved, recipeId];

                setSavedRecipes(nextSaved);
                updateSaveButtons();
            });
        });

        updateSaveButtons();

        document.querySelectorAll('.js-copy-link').forEach((button) => {
            button.addEventListener('click', async () => {
                const original = button.textContent;

                try {
                    await navigator.clipboard.writeText(window.location.href);
                    button.textContent = 'Link Tersalin';
                } catch (error) {
                    button.textContent = 'Gagal Menyalin';
                }

                window.setTimeout(() => {
                    button.textContent = original;
                }, 1400);
            });
        });

        const handleBackToTop = () => {
            if (!backToTop) return;
            backToTop.classList.toggle('is-visible', window.scrollY > 360);
        };

        if (backToTop) {
            handleBackToTop();
            window.addEventListener('scroll', handleBackToTop, { passive: true });
            backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        }

        const parallaxItems = document.querySelectorAll('[data-parallax]');
        const moveParallax = () => {
            parallaxItems.forEach((item) => {
                const speed = Number(item.dataset.parallax || 0.04);
                const offset = window.scrollY * speed;
                item.style.transform = `translate3d(0, ${offset}px, 0)`;
            });
        };

        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            window.addEventListener('scroll', moveParallax, { passive: true });
            moveParallax();
        }

        if (glow && window.matchMedia('(pointer: fine)').matches) {
            document.addEventListener('mousemove', (event) => {
                glow.style.left = `${event.clientX}px`;
                glow.style.top = `${event.clientY}px`;
            }, { passive: true });
        }
    });
})();
