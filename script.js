function togglePassword(inputId, toggleId) {
    const input = document.getElementById(inputId);
    const toggle = document.getElementById(toggleId);
    if (input.type === 'password') {
        input.type = 'text';
        toggle.classList.remove('ri-eye-off-line');
        toggle.classList.add('ri-eye-line');
    } else {
        input.type = 'password';
        toggle.classList.remove('ri-eye-line');
        toggle.classList.add('ri-eye-off-line');
    }
}

function copyTillNumber() {
    const tillNumber = '4178866';
    navigator.clipboard.writeText(tillNumber).then(() => {
        alert('Till Number 4178866 copied to clipboard!');
    }).catch(() => {
        alert('Failed to copy till number. Please copy manually: 4178866');
    });
}

function validatePaymentForm() {
    const membershipTier = document.getElementById('membership-tier').value;
    const mpesaCode = document.getElementById('mpesa-code').value;
    if (!['Basic', 'Pro', 'Premium'].includes(membershipTier)) {
        alert('Please select a valid membership tier.');
        return false;
    }
    if (!/^[A-Z0-9]{10}$/.test(mpesaCode)) {
        alert('Please enter a valid M-Pesa transaction code (10 alphanumeric characters).');
        return false;
    }
    return true;
}

function validateContactForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const message = document.getElementById('message').value.trim();
    const submitButton = document.getElementById('submit-button');

    if (!name) {
        alert('Please enter your full name.');
        return false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }
    if (phone && !/^\+254\d{9}$/.test(phone)) {
        alert('Please enter a valid phone number (e.g., +254700123456).');
        return false;
    }
    if (!message) {
        alert('Please enter a message.');
        return false;
    }

    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="ri-loader-4-line animate-spin mr-2"></i> Sending...';
    return true;
}

function validateSignupForm() {
    const email = document.getElementById('signup-email').value.trim();
    const submitButton = document.getElementById('signup-button');

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="ri-loader-4-line animate-spin mr-2"></i> Signing Up...';
    return true;
}

document.addEventListener('DOMContentLoaded', function () {
    // FAQ Accordion
    const faqToggles = document.querySelectorAll('.faq-toggle');
    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const content = this.nextElementSibling;
            const icon = this.querySelector('i');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            faqToggles.forEach(t => {
                const c = t.nextElementSibling;
                const i = t.querySelector('i');
                if (t !== this) {
                    c.classList.add('hidden');
                    t.setAttribute('aria-expanded', 'false');
                    i.classList.remove('ri-arrow-up-s-line');
                    i.classList.add('ri-arrow-down-s-line');
                }
            });

            content.classList.toggle('hidden');
            this.setAttribute('aria-expanded', !isExpanded);
            icon.classList.toggle('ri-arrow-down-s-line');
            icon.classList.toggle('ri-arrow-up-s-line');
        });
    });

    // FAQ Search
    const searchInput = document.getElementById('faq-search');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('h4').textContent.toLowerCase();
                const answer = item.querySelector('.faq-content').textContent.toLowerCase();
                item.style.display = (question.includes(searchTerm) || answer.includes(searchTerm)) ? 'block' : 'none';
            });
        });
    }
});

// Mobile menu toggle
document.getElementById('mobile-menu-button').addEventListener('click', function () {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

