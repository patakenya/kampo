<?php
// faq.php
session_start();
require_once 'config.php';

$page_title = "FAQ - Campus Hustle Kenya";
$page_description = "Find answers to common questions about Campus Hustle Kenya, including membership plans, online gigs, M-Pesa payouts, and more.";
$page_keywords = "Campus Hustle Kenya, FAQ, frequently asked questions, online gigs, M-Pesa, Kenyan students, freelance, student jobs";
$page_author = "Campus Hustle Kenya";
?>

<?php include 'header.php'; ?>

<!-- Remix Icon CDN -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

<!-- Inline CSS for Animations -->
<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in;
}

.animate-slide-up {
    animation: slideUp 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
</style>

<!-- FAQ Hero Section -->
<section id="faq-hero" class="py-20 bg-gradient-to-r from-blue-600 to-green-500 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-30 z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-8 animate-fade-in">Frequently Asked Questions</h2>
        <p class="text-lg text-gray-100 text-center mb-12 max-w-2xl mx-auto animate-fade-in">Got questions about Campus Hustle Kenya? Find answers about membership, gigs, payments, and more below!</p>
        <div class="max-w-md mx-auto">
            <input
                type="text"
                id="faq-search"
                placeholder="Search FAQs..."
                class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                aria-label="Search FAQs"
            >
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-3xl mx-auto">
            <h3 class="text-2xl font-semibold text-gray-900 mb-8 text-center animate-slide-up">Your Questions, Answered</h3>
            <div id="faq-list" class="space-y-4">
                <div class="faq-item bg-white rounded-2xl shadow-lg p-6" role="region" aria-labelledby="faq1">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" aria-expanded="false" aria-controls="faq1-content">
                        <h4 id="faq1" class="text-lg font-medium text-gray-900">What is Campus Hustle Kenya?</h4>
                        <i class="ri-arrow-down-s-line text-primary text-xl"></i>
                    </button>
                    <div id="faq1-content" class="faq-content hidden mt-4 text-gray-600 text-sm">
                        <p>Campus Hustle Kenya is a platform for Kenyan students to earn money online through flexible gigs, such as article writing, digital marketing, and transcription, with instant M-Pesa payouts.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-2xl shadow-lg p-6" role="region" aria-labelledby="faq2">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" aria-expanded="false" aria-controls="faq2-content">
                        <h4 id="faq2" class="text-lg font-medium text-gray-900">What are the membership plans?</h4>
                        <i class="ri-arrow-down-s-line text-primary text-xl"></i>
                    </button>
                    <div id="faq2-content" class="faq-content hidden mt-4 text-gray-600 text-sm">
                        <p>We offer three one-time membership plans: Basic (KES 750, 10 gig applications, KES 100–500 gigs), Pro (KES 1,000, 30 applications, KES 100–1,000 gigs, priority access), and Premium (KES 1,500, unlimited applications, KES 2,000+ gigs, top priority, profile boost).</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-2xl shadow-lg p-6" role="region" aria-labelledby="faq3">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" aria-expanded="false" aria-controls="faq3-content">
                        <h4 id="faq3" class="text-lg font-medium text-gray-900">How do I pay for my membership?</h4>
                        <i class="ri-arrow-down-s-line text-primary text-xl"></i>
                    </button>
                    <div id="faq3-content" class="faq-content hidden mt-4 text-gray-600 text-sm">
                        <p>Pay via M-Pesa to till number 4178866. After payment, submit your transaction code on the payments page. Our admin team will verify and approve your membership, typically within 24 hours.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-2xl shadow-lg p-6" role="region" aria-labelledby="faq4">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" aria-expanded="false" aria-controls="faq4-content">
                        <h4 id="faq4" class="text-lg font-medium text-gray-900">What types of gigs are available?</h4>
                        <i class="ri-arrow-down-s-line text-primary text-xl"></i>
                    </button>
                    <div id="faq4-content" class="faq-content hidden mt-4 text-gray-600 text-sm">
                        <p>Gigs include article writing, digital marketing, transcription, data entry, graphic design, virtual assistance, web research, content editing, online surveys, social media content creation, website testing, and translation, with payments ranging from KES 100 to KES 2,000+.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-2xl shadow-lg p-6" role="region" aria-labelledby="faq5">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" aria-expanded="false" aria-controls="faq5-content">
                        <h4 id="faq5" class="text-lg font-medium text-gray-900">How do I get paid?</h4>
                        <i class="ri-arrow-down-s-line text-primary text-xl"></i>
                    </button>
                    <div id="faq5-content" class="faq-content hidden mt-4 text-gray-600 text-sm">
                        <p>Payments are made via M-Pesa to your registered phone number within 24 hours of gig completion. Ensure your phone number is verified during registration.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-2xl shadow-lg p-6" role="region" aria-labelledby="faq6">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" aria-expanded="false" aria-controls="faq6-content">
                        <h4 id="faq6" class="text-lg font-medium text-gray-900">Is there a refund policy?</h4>
                        <i class="ri-arrow-down-s-line text-primary text-xl"></i>
                    </button>
                    <div id="faq6-content" class="faq-content hidden mt-4 text-gray-600 text-sm">
                        <p>Membership fees are non-refundable once approved. If your payment is rejected, you’ll be notified, and you can resubmit a valid transaction code.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-2xl shadow-lg p-6" role="region" aria-labelledby="faq7">
                    <button class="faq-toggle w-full text-left flex justify-between items-center" aria-expanded="false" aria-controls="faq7-content">
                        <h4 id="faq7" class="text-lg font-medium text-gray-900">How do I contact support?</h4>
                        <i class="ri-arrow-down-s-line text-primary text-xl"></i>
                    </button>
                    <div id="faq7-content" class="faq-content hidden mt-4 text-gray-600 text-sm">
                        <p>Contact us via email at <a href="mailto:support@campushustle.co.ke" class="text-primary hover:underline">support@campushustle.co.ke</a>, phone at <a href="tel:+254700123456" class="text-primary hover:underline">+254 700 123 456</a>, or through our <a href="contact.php" class="text-primary hover:underline">contact form</a>.</p>
                    </div>
                </div>
            </div>
            <p class="text-center text-gray-600 mt-8 text-sm">Still have questions? <a href="contact.php" class="text-primary hover:underline">Contact our support team</a>.</p>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-yellow-400 to-orange-500">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 animate-fade-in">Ready to Start Earning?</h2>
        <p class="text-lg text-white mb-8 max-w-2xl mx-auto animate-fade-in">Join <strong>Campus Hustle Kenya</strong> and start earning with flexible online gigs today!</p>
        <a
            href="register.php"
            class="bg-white text-primary px-8 py-3 rounded-button font-semibold text-base hover:bg-gray-100 transition-all duration-200"
            aria-label="Join Campus Hustle Kenya"
        >
            Join Now
        </a>
    </div>
</section>

<!-- Structured Data for SEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "What is Campus Hustle Kenya?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Campus Hustle Kenya is a platform for Kenyan students to earn money online through flexible gigs, such as article writing, digital marketing, and transcription, with instant M-Pesa payouts."
            }
        },
        {
            "@type": "Question",
            "name": "What are the membership plans?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We offer three one-time membership plans: Basic (KES 750, 10 gig applications, KES 100–500 gigs), Pro (KES 1,000, 30 applications, KES 100–1,000 gigs, priority access), and Premium (KES 1,500, unlimited applications, KES 2,000+ gigs, top priority, profile boost)."
            }
        },
        {
            "@type": "Question",
            "name": "How do I pay for my membership?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Pay via M-Pesa to till number 4178866. After payment, submit your transaction code on the payments page. Our admin team will verify and approve your membership, typically within 24 hours."
            }
        },
        {
            "@type": "Question",
            "name": "What types of gigs are available?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Gigs include article writing, digital marketing, transcription, data entry, graphic design, virtual assistance, web research, content editing, online surveys, social media content creation, website testing, and translation, with payments ranging from KES 100 to KES 2,000+."
            }
        },
        {
            "@type": "Question",
            "name": "How do I get paid?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Payments are made via M-Pesa to your registered phone number within 24 hours of gig completion. Ensure your phone number is verified during registration."
            }
        },
        {
            "@type": "Question",
            "name": "Is there a refund policy?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Membership fees are non-refundable once approved. If your payment is rejected, you’ll be notified, and you can resubmit a valid transaction code."
            }
        },
        {
            "@type": "Question",
            "name": "How do I contact support?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Contact us via email at support@campushustle.co.ke, phone at +254 700 123 456, or through our contact form."
            }
        }
    ]
}
</script>

<!-- Inline JavaScript for FAQ Functionality -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // FAQ Accordion Functionality
    const faqToggles = document.querySelectorAll('.faq-toggle');
    
    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const content = toggle.nextElementSibling;
            const icon = toggle.querySelector('i');
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            
            // Toggle content visibility
            if (isExpanded) {
                content.classList.add('hidden');
                toggle.setAttribute('aria-expanded', 'false');
                icon.classList.remove('ri-arrow-up-s-line');
                icon.classList.add('ri-arrow-down-s-line');
            } else {
                // Close all other open FAQs
                document.querySelectorAll('.faq-content').forEach(item => {
                    item.classList.add('hidden');
                });
                document.querySelectorAll('.faq-toggle').forEach(item => {
                    item.setAttribute('aria-expanded', 'false');
                    item.querySelector('i').classList.remove('ri-arrow-up-s-line');
                    item.querySelector('i').classList.add('ri-arrow-down-s-line');
                });
                
                // Open current FAQ
                content.classList.remove('hidden');
                toggle.setAttribute('aria-expanded', 'true');
                icon.classList.remove('ri-arrow-down-s-line');
                icon.classList.add('ri-arrow-up-s-line');
            }
        });
    });

    // FAQ Search Functionality
    const searchInput = document.getElementById('faq-search');
    const faqItems = document.querySelectorAll('.faq-item');

    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase().trim();

        faqItems.forEach(item => {
            const question = item.querySelector('h4').textContent.toLowerCase();
            const answer = item.querySelector('.faq-content').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
                item.classList.add('animate-fade-in');
            } else {
                item.style.display = 'none';
                item.classList.remove('animate-fade-in');
            }
        });

        // Show message if no results found
        const faqList = document.getElementById('faq-list');
        const noResults = document.querySelector('.no-results');
        
        if (Array.from(faqItems).every(item => item.style.display === 'none')) {
            if (!noResults) {
                const noResultsMsg = document.createElement('p');
                noResultsMsg.className = 'no-results text-center text-gray-600 mt-4';
                noResultsMsg.textContent = 'No FAQs found matching your search.';
                faqList.appendChild(noResultsMsg);
            }
        } else {
            if (noResults) {
                noResults.remove();
            }
        }
    });
});
</script>

<?php include 'footer.php'; ?>