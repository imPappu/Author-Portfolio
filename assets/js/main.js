/**
 * Noir Editorial Main Script (Elite Vanilla JS Edition)
 */

document.addEventListener('DOMContentLoaded', () => {
  initHeader();
  initHeroCarousel();
  initEliteAnimations();
  initCustomCursor();
  initMagneticButtons();
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
    threshold: 0.1,
    rootMargin: '0px 0px -10% 0px'
  };

  const revealOnScroll = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        if (entry.target.classList.contains('stagger-container')) {
          const items = entry.target.querySelectorAll('.stagger-item');
          items.forEach((item, index) => {
            setTimeout(() => {
              item.classList.add('visible');
            }, index * 100);
          });
        } else {
          entry.target.classList.add('fade-in-visible');
        }
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Targets for animation
  const targets = document.querySelectorAll('.fade-in-ready, .bento-item, .post-card, .author-card, .newsletter-box-liquid, .stagger-container');

  targets.forEach(target => {
    if (!target.classList.contains('fade-in-ready') && !target.classList.contains('stagger-container')) {
      target.classList.add('fade-in-ready');
    }
    revealOnScroll.observe(target);
  });

  initMobileMenu();
}

/**
 * Custom Cursor Controller
 */
function initCustomCursor() {
  const cursor = document.querySelector('.custom-cursor');
  if (!cursor) return;

  let mouseX = 0;
  let mouseY = 0;
  let cursorX = 0;
  let cursorY = 0;

  document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
  });

  const animateCursor = () => {
    const easing = 0.15;
    cursorX += (mouseX - cursorX) * easing;
    cursorY += (mouseY - cursorY) * easing;

    cursor.style.left = `${cursorX}px`;
    cursor.style.top = `${cursorY}px`;

    requestAnimationFrame(animateCursor);
  };

  animateCursor();

  // Hover states
  const interactives = document.querySelectorAll('a, button, .clickable');
  interactives.forEach(el => {
    el.addEventListener('mouseenter', () => cursor.classList.add('active'));
    el.addEventListener('mouseleave', () => cursor.classList.remove('active'));
  });
}

/**
 * Magnetic Button Interaction Logic
 */
function initMagneticButtons() {
  const buttons = document.querySelectorAll('.btn-primary, .btn-secondary, .btn-contact');

  buttons.forEach(btn => {
    btn.addEventListener('mousemove', (e) => {
      const rect = btn.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;

      btn.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
    });

    btn.addEventListener('mouseleave', () => {
      btn.style.transform = '';
    });
  });
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
    const isActive = toggle.classList.toggle('active');
    overlay.classList.toggle('active');
    body.classList.toggle('nav-active');

    if (isActive) {
      const staggerContainer = overlay.querySelector('.stagger-container');
      if (staggerContainer) {
        const items = staggerContainer.querySelectorAll('.stagger-item');
        items.forEach((item, index) => {
          setTimeout(() => {
            item.classList.add('visible');
          }, 100 + (index * 100));
        });
      }
    } else {
      // Reset animations for next time
      const items = overlay.querySelectorAll('.stagger-item');
      items.forEach(item => item.classList.remove('visible'));
    }
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
