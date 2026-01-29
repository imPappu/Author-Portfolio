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
  const toggle = document.querySelector('.mobile-toggle');
  const overlay = document.querySelector('.mobile-nav-overlay');
  const body = document.body;
  const navLinks = document.querySelectorAll('.mobile-nav-menu a');

  if (!toggle || !overlay) return;

  const toggleMenu = () => {
    toggle.classList.toggle('active');
    overlay.classList.toggle('active');
    body.classList.toggle('nav-active');
  };

  toggle.addEventListener('click', toggleMenu);

  // Close menu when a link is clicked
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      toggle.classList.remove('active');
      overlay.classList.remove('active');
      body.classList.remove('nav-active');
    });
  });
}
