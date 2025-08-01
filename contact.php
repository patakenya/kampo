<?php
// contact.php
$page_title = "Contact Us - Campus Hustle Kenya";
$page_description = "Get in touch with Campus Hustle Kenya for support, inquiries, or feedback about earning money online through flexible gigs.";
$page_keywords = "Campus Hustle Kenya, contact us, support, earn money online, M-Pesa, Kenyan students";
$page_author = "Campus Hustle Kenya";

// Handle form submission (basic example, add backend logic as needed)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    // Add backend logic here (e.g., send email, save to database)
    // For now, we'll just set a success message
    $success_message = "Thank you for your message, $name! We'll get back to you soon.";
}
?>

<?php include 'header.php'; ?>

<!-- Contact Section -->

<section id="contact-hero" class="py-20 bg-gradient-to-r from-blue-600 to-green-500 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-30 z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-8 animate-fade-in">Get in Touch</h2>
        <p class="text-lg text-gray-100 text-center mb-12 max-w-2xl mx-auto animate-fade-in">Have questions or need support? Reach out to our team, and we’ll respond as soon as possible!</p>
    </div>
</section>
<section id="contact" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Success Message -->
        <?php if (isset($success_message)): ?>
            <div class="bg-green-100 border border-green-200 rounded-lg p-4 mb-8 text-center">
                <p class="text-green-600"><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Send Us a Message</h3>
                <form method="POST" action="contact.php" class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Full Name</label>
                        <input
                            type="text"
                            name="name"
                            placeholder="e.g., John Doe"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="e.g., johndoe@email.com"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Message</label>
                        <textarea
                            name="message"
                            placeholder="Your message or question"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                            rows="5"
                            required
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="w-full bg-primary text-white py-3 rounded-button font-medium text-sm hover:bg-blue-700 transition-colors"
                    >
                        Send Message
                    </button>
                </form>
            </div>
             <!-- Contact Info -->
            <div class="text-center md:text-left animate-slide-up">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Get in Touch</h3>
                <p class="text-gray-600 mb-6">We’re here to help you succeed with Campus Hustle Kenya. Reach out via email, phone, or social media.</p>
                <ul class="text-gray-600 space-y-4 mb-6">
                    <li class="flex items-center justify-center md:justify-start">
                        <i class="ri-mail-line text-primary mr-3 text-xl"></i>
                        <a href="mailto:support@campushustle.co.ke" class="hover:text-primary transition-colors">support@campushustle.co.ke</a>
                    </li>
                    <li class="flex items-center justify-center md:justify-start">
                        <i class="ri-phone-line text-primary mr-3 text-xl"></i>
                        <a href="tel:+254700123456" class="hover:text-primary transition-colors">+254 700 123 456</a>
                    </li>
                    <li class="flex items-center justify-center md:justify-start">
                        <i class="ri-whatsapp-line text-primary mr-3 text-xl"></i>
                        <a href="https://wa.me/+254700123456" class="hover:text-primary transition-colors">WhatsApp Us</a>
                    </li>
                </ul>
                <div class="flex justify-center md:justify-start space-x-6">
                    <a href="https://instagram.com/campushustleke" class="text-gray-600 hover:text-primary transition-colors" aria-label="Instagram">
                        <i class="ri-instagram-line text-2xl"></i>
                    </a>
                    <a href="https://twitter.com/campushustleke" class="text-gray-600 hover:text-primary transition-colors" aria-label="Twitter">
                        <i class="ri-twitter-line text-2xl"></i>
                    </a>
                    <a href="https://tiktok.com/@campushustleke" class="text-gray-600 hover:text-primary transition-colors" aria-label="TikTok">
                        <i class="ri-tiktok-line text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-yellow-400 to-orange-500">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready to Start Earning?</h2>
        <p class="text-lg text-white mb-8 max-w-2xl mx-auto">Join <strong>Campus Hustle Kenya</strong> and start earning with flexible online gigs today!</p>
        <button class="bg-white text-primary px-8 py-3 rounded-button font-semibold text-base hover:bg-gray-100 transition-colors">
            Join Now
        </button>
    </div>
</section>

<?php include 'footer.php'; ?>