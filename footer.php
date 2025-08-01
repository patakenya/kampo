<?php
// footer.php
?>
<footer class="bg-gray-900 py-12 relative overflow-hidden">
    <!-- Gradient Accent -->
    <div class="absolute inset-0 bg-gradient-to-t from-blue-600/20 to-transparent z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Section -->
            <div>
                <h3 class="font-['Pacifico'] text-2xl text-white mb-4">Campus Hustle Kenya</h3>
                <p class="text-gray-300 text-sm mb-4">Empowering Kenyan students to earn money through flexible online gigs with instant M-Pesa payouts.</p>
                <div class="flex space-x-4">
                    <a href="https://wa.me/+254700123456" class="text-gray-300 hover:text-white transition-colors" aria-label="WhatsApp">
                        <i class="ri-whatsapp-line text-xl"></i>
                    </a>
                    <a href="https://instagram.com/campushustleke" class="text-gray-300 hover:text-white transition-colors" aria-label="Instagram">
                        <i class="ri-instagram-line text-xl"></i>
                    </a>
                    <a href="https://twitter.com/campushustleke" class="text-gray-300 hover:text-white transition-colors" aria-label="Twitter">
                        <i class="ri-twitter-line text-xl"></i>
                    </a>
                    <a href="https://tiktok.com/@campushustleke" class="text-gray-300 hover:text-white transition-colors" aria-label="TikTok">
                        <i class="ri-tiktok-line text-xl"></i>
                    </a>
                </div>
            </div>
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                <ul class="text-gray-300 text-sm space-y-2">
                    <li><a href="#features" class="hover:text-blue-400 transition-colors">Features</a></li>
                    <li><a href="#how-it-works" class="hover:text-blue-400 transition-colors">How It Works</a></li>
                    <li><a href="#pricing" class="hover:text-blue-400 transition-colors">Pricing</a></li>
                    <li><a href="#tasks" class="hover:text-blue-400 transition-colors">Tasks</a></li>
                    <li><a href="#blog" class="hover:text-blue-400 transition-colors">Blog</a></li>
                </ul>
            </div>
            <!-- Support Links -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Support</h3>
                <ul class="text-gray-300 text-sm space-y-2">
                    <li><a href="mailto:support@campushustle.co.ke" class="hover:text-blue-400 transition-colors">Contact Us</a></li>
                    <li><a href="/privacy" class="hover:text-blue-400 transition-colors">Privacy Policy</a></li>
                    <li><a href="/terms" class="hover:text-blue-400 transition-colors">Terms of Service</a></li>
                    <li><a href="/faq" class="hover:text-blue-400 transition-colors">FAQ</a></li>
                </ul>
            </div>
            <!-- Newsletter Subscription -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Stay Updated</h3>
                <p class="text-gray-300 text-sm mb-4">Get the latest gig opportunities and tips for Kenyan students.</p>
                <div class="flex">
                    <input
                        type="email"
                        placeholder="Enter your email"
                        class="w-full px-4 py-2 rounded-l-lg text-sm bg-gray-800 border border-gray-700 text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        aria-label="Newsletter email"
                    >
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition-colors">
                        <i class="ri-mail-send-line"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-gray-800 text-center">
            <p class="text-gray-400 text-sm">&copy; 2025 Campus Hustle Kenya. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Sign-Up Modal -->
<div id="signupModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Sign Up for Free</h2>
            <button id="closeModal" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100">
                <i class="ri-close-line text-gray-500"></i>
            </button>
        </div>
        <div class="space-y-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">University Email (.edu)</label>
                <input type="email" placeholder="e.g., student@university.ac.ke" class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Full Name</label>
                <input type="text" placeholder="e.g., John Doe" class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">M-Pesa Phone Number</label>
                <input type="tel" placeholder="e.g., +254 700 123 456" class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <button class="w-full bg-primary text-white py-3 rounded-button font-medium text-sm hover:bg-blue-700 transition-colors">
                Create Account
            </button>
            <p class="text-sm text-gray-600 text-center">Already have an account? <a href="#" class="text-primary hover:underline">Log In</a></p>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>