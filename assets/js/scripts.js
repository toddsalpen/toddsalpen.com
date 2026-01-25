// Navigation scroll effect
const nav = document.getElementById('nav');
let ticking = false;

const updateNav = () => {
    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
    ticking = false;
};

window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(updateNav);
        ticking = true;
    }
}, {passive: true});

// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === '#') return;

        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
            // Close mobile menu if open
            navLinks.classList.remove('mobile-open');

            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Fade in animation on scroll
const fadeElements = document.querySelectorAll('.fade-in');
const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            obs.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
});

fadeElements.forEach(el => observer.observe(el));

// Mobile menu toggle
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');

mobileMenuBtn.addEventListener('click', () => {
    navLinks.classList.toggle('mobile-open');
});

// Form submission
const form = document.querySelector('.contact-form');
form.addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Thank you for your message! I will get back to you soon.');
    form.reset();
});

// Play button clicks (placeholder for actual audio player)
document.querySelectorAll('.play-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        alert('Audio player coming soon! Check out the streaming links below.');
    });
});