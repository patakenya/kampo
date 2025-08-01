// script.js
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
            // Close mobile menu if open
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu.classList.contains('flex')) {
                mobileMenu.classList.remove('flex');
                mobileMenu.classList.add('hidden');
            }
        });
    });

    // Toggle mobile menu
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    menuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('flex');
        const icon = menuButton.querySelector('i');
        icon.classList.toggle('ri-menu-line');
        icon.classList.toggle('ri-close-line');
    });

    // Modal interactions
    const signupButtons = document.querySelectorAll('button:contains("Sign Up"), button:contains("Sign Up for Free"), button:contains("Join Now")');
    const modal = document.getElementById('signupModal');
    const closeButton = document.getElementById('closeModal');

    signupButtons.forEach(button => {
        button.addEventListener('click', function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    closeButton.addEventListener('click', function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });
});

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

// Existing mobile menu toggle (from previous responses)
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

function copyTillNumber() {
    const tillNumber = '4178866';
    navigator.clipboard.writeText(tillNumber).then(() => {
        alert('Till Number 4178866 copied to clipboard!');
    }).catch(() => {
        alert('Failed to copy till number. Please copy manually: 4178866');
    });
}