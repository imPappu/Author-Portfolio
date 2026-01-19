/**
 * Noir Editorial Main Script
 */

document.addEventListener('DOMContentLoaded', () => {
  initHeader();
  initHeroCarousel();
  initAnimations();
});

/**
 * Header Scroll Controller
 */
function initHeader() {
  const header = document.querySelector('.site-header');
  if (!header) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
}

/**
 * Hero Carousel Logic
 */
function initHeroCarousel() {
  const slides = document.querySelectorAll('.hero-slide');
  if (slides.length < 2) return;

  let currentSlide = 0;

  setInterval(() => {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }, 5000);
}

/**
 * Scroll Animations using IntersectionObserver
 */
function initAnimations() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('fade-in-visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  document.querySelectorAll('.bento-item, .split-content, .stat-item').forEach(el => {
    el.classList.add('fade-in-ready');
    observer.observe(el);
  });

  initMobileMenu();
}

/**
 * Mobile Menu Toggle
 */
function initMobileMenu() {
  const toggle = document.querySelector('.mobile-toggle');
  const nav = document.querySelector('.main-navigation');
  const body = document.body;

  if (!toggle || !nav) return;

  toggle.addEventListener('click', () => {
    toggle.classList.toggle('active');
    nav.classList.toggle('active');
    body.style.overflow = nav.classList.contains('active') ? 'hidden' : '';
  });

  // Close on link click
  nav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      toggle.classList.remove('active');
      nav.classList.remove('active');
      body.style.overflow = '';
    });
  });
}