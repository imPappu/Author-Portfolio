/**
 * Noir Editorial Main Script (Elite Vanilla JS Edition)
 */

document.addEventListener('DOMContentLoaded', () => {
  initHeader();
  initHeroCarousel();
  initEliteAnimations();
});

/**
 * Header Scroll & Transparency Controller
 */
function initHeader() {
  const header = document.querySelector('.site-header');
  if (!header) return;

  const handleScroll = () => {
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  };

  window.addEventListener('scroll', handleScroll, { passive: true });
}

/**
 * Cinematic Hero Carousel Logic
 */
function initHeroCarousel() {
  const slides = document.querySelectorAll('.hero-slide');
  if (slides.length < 2) return;

  let currentSlide = 0;
  const slideInterval = 6000; // 6 seconds for elite pacing

  const nextSlide = () => {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  };

  setInterval(nextSlide, slideInterval);
}

/**
 * Elite Scroll Animations using IntersectionObserver
 */
function initEliteAnimations() {
  const observerOptions = {
    threshold: 0.15,
    rootMargin: '0px 0px -10% 0px'
  };

  const revealOnScroll = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('fade-in-visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Targets for animation
  const targets = document.querySelectorAll('.fade-in-ready, .bento-item, .post-card, .author-card, .newsletter-box-liquid');

  targets.forEach(target => {
    if (!target.classList.contains('fade-in-ready')) {
      target.classList.add('fade-in-ready');
    }
    revealOnScroll.observe(target);
  });

  initMobileMenu();
}

/**
 * Lightweight Mobile Menu (No jQuery)
 */
function initMobileMenu() {
  // Mobile toggle logic can be expanded here if a burger menu is added to header.php
}
