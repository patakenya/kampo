<?php
// pricing.php
session_start();
require_once 'config.php';

$page_title = "Pricing - Campus Hustle Kenya";
$page_description = "Choose a one-time membership plan to unlock flexible online gigs for Kenyan students with instant M-Pesa payouts.";
$page_keywords = "Campus Hustle Kenya, pricing, online gigs, M-Pesa, Kenyan students, freelance plans, student jobs";
$page_author = "Campus Hustle Kenya";

// Check payment status for logged-in users
$has_approved_payment = false;
if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT id FROM payments WHERE user_id = ? AND status = 'Approved'");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $has_approved_payment = $stmt->get_result()->num_rows > 0;
    $stmt->close();
}

// Handle plan selection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['membership_tier'])) {
    $_SESSION['membership_tier'] = $_POST['membership_tier'];
    if (isset($_SESSION['user_id'])) {
        if ($has_approved_payment) {
            $_SESSION['success_message'] = "You already have an approved membership. Start exploring gigs!";
            header("Location: dashboard.php");
        } else {
            header("Location: payments.php");
        }
    } else {
        header("Location: register.php");
    }
    exit();
}
?>

<?php include 'header.php'; ?>

<!-- Pricing Hero Section -->
<section id="pricing-hero" class="py-20 bg-gradient-to-r from-blue-600 to-green-500 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-30 z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-8 animate-fade-in">Choose Your Membership Plan</h2>
        <p class="text-lg text-gray-100 text-center mb-12 max-w-2xl mx-auto animate-fade-in">Unlock flexible online gigs with a one-time payment. No recurring fees, just instant access to earning opportunities tailored for Kenyan students!</p>
    </div>
</section>

<!-- Pricing Cards Section -->
<section id="pricing" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Basic Plan -->
            <div class="bg-white border border-blue-200 rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-200 animate-slide-up" role="region" aria-label="Basic Plan">
                <h3 class="text-2xl font-semibold text-gray-900 mb-3">Basic</h3>
                <p class="text-gray-600 mb-4">Perfect for students new to freelancing</p>
                <div class="text-4xl font-bold text-primary mb-4">KES 750<span class="text-base text-gray-500">/one-time</span></div>
                <ul class="text-gray-600 space-y-3 mb-6 text-sm">
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-primary mr-2"></i> Access to basic gigs (KES 100–500)
                    </li>
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-primary mr-2"></i> 10 gig applications
                    </li>
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-primary mr-2"></i> M-Pesa payouts
                    </li>
                    <li class="flex items-center justify-center text-gray-400">
                        <i class="ri-close-line mr-2"></i> Priority gig access
                    </li>
                </ul>
                <form method="POST" action="pricing.php">
                    <input type="hidden" name="membership_tier" value="Basic">
                    <button
                        type="submit"
                        class="bg-primary text-white px-6 py-3 rounded-button font-semibold text-sm hover:bg-blue-700 transition-all duration-200 w-full"
                        aria-label="Choose Basic Plan"
                    >
                        Choose Basic
                    </button>
                </form>
            </div>
            <!-- Pro Plan -->
            <div class="bg-white border border-green-200 rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-200 animate-slide-up relative" role="region" aria-label="Pro Plan">
                <span class="absolute top-0 right-0 bg-accent text-white text-xs font-semibold px-4 py-2 rounded-bl-lg rounded-tr-2xl">Most Popular</span>
                <h3 class="text-2xl font-semibold text-gray-900 mb-3">Pro</h3>
                <p class="text-gray-600 mb-4">Ideal for active hustlers seeking variety</p>
                <div class="text-4xl font-bold text-secondary mb-4">KES 1,000<span class="text-base text-gray-500">/one-time</span></div>
                <ul class="text-gray-600 space-y-3 mb-6 text-sm">
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-secondary mr-2"></i> Access to all gigs (KES 500–1,500)
                    </li>
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-secondary mr-2"></i> 30 gig applications
                    </li>
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-secondary mr-2"></i> M-Pesa payouts
                    </li>
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-secondary mr-2"></i> Priority gig access
                    </li>
                </ul>
                <form method="POST" action="pricing.php">
                    <input type="hidden" name="membership_tier" value="Pro">
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-6 py-3 rounded-button font-semibold text-sm hover:shadow-lg transition-all duration-200 w-full"
                        aria-label="Choose Pro Plan"
                    >
                        Choose Pro
                    </button>
                </form>
            </div>
            <!-- Premium Plan -->
            <div class="bg-white border border-orange-200 rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-200 animate-slide-up" role="region" aria-label="Premium Plan">
                <h3 class="text-2xl font-semibold text-gray-900 mb-3">Premium</h3>
                <p class="text-gray-600 mb-4">Exclusive access for high earners</p>
                <div class="text-4xl font-bold text-accent mb-4">KES 1,500<span class="text-base text-gray-500">/one-time</span></div>
                <ul class="text-gray-600 space-y-3 mb-6 text-sm">
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-accent mr-2"></i> Access to premium gigs (KES 2,000+)
                    </li>
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-accent mr-2"></i> Unlimited gig applications
                    </li>
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-accent mr-2"></i> M-Pesa payouts
                    </li>
                    <li class="flex items-center justify-center">
                        <i class="ri-check-line text-accent mr-2"></i> Top priority & profile boost
                    </li>
                </ul>
                <form method="POST" action="pricing.php">
                    <input type="hidden" name="membership_tier" value="Premium">
                    <button
                        type="submit"
                        class="bg-accent text-white px-6 py-3 rounded-button font-semibold text-sm hover:bg-orange-600 transition-all duration-200 w-full"
                        aria-label="Choose Premium Plan"
                    >
                        Choose Premium
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Comparison Table for Small Screens -->
<section class="py-16 bg-white md:hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-2xl font-semibold text-gray-900 text-center mb-8">Compare Plans</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-600 border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-4 text-left font-semibold">Feature</th>
                        <th class="p-4 text-center font-semibold">Basic</th>
                        <th class="p-4 text-center font-semibold">Pro</th>
                        <th class="p-4 text-center font-semibold">Premium</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-4 border-t">Price (one-time)</td>
                        <td class="p-4 border-t text-center">KES 750</td>
                        <td class="p-4 border-t text-center">KES 1,000</td>
                        <td class="p-4 border-t text-center">KES 1,500</td>
                    </tr>
                    <tr>
                        <td class="p-4 border-t">Gig Access</td>
                        <td class="p-4 border-t text-center">KES 100–500</td>
                        <td class="p-4 border-t text-center">KES 100–1,000</td>
                        <td class="p-4 border-t text-center">KES 2,000+</td>
                    </tr>
                    <tr>
                        <td class="p-4 border-t">Applications</td>
                        <td class="p-4 border-t text-center">10</td>
                        <td class="p-4 border-t text-center">30</td>
                        <td class="p-4 border-t text-center">Unlimited</td>
                    </tr>
                    <tr>
                        <td class="p-4 border-t">M-Pesa Payouts</td>
                        <td class="p-4 border-t text-center"><i class="ri-check-line text-primary"></i></td>
                        <td class="p-4 border-t text-center"><i class="ri-check-line text-secondary"></i></td>
                        <td class="p-4 border-t text-center"><i class="ri-check-line text-accent"></i></td>
                    </tr>
                    <tr>
                        <td class="p-4 border-t">Priority Access</td>
                        <td class="p-4 border-t text-center"><i class="ri-close-line text-gray-400"></i></td>
                        <td class="p-4 border-t text-center"><i class="ri-check-line text-secondary"></i></td>
                        <td class="p-4 border-t text-center"><i class="ri-check-line text-accent"></i></td>
                    </tr>
                    <tr>
                        <td class="p-4 border-t">Profile Boost</td>
                        <td class="p-4 border-t text-center"><i class="ri-close-line text-gray-400"></i></td>
                        <td class="p-4 border-t text-center"><i class="ri-close-line text-gray-400"></i></td>
                        <td class="p-4 border-t text-center"><i class="ri-check-line text-accent"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-yellow-400 to-orange-500">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 animate-fade-in">Start Earning Today!</h2>
        <p class="text-lg text-white mb-8 max-w-2xl mx-auto animate-fade-in">Choose a plan and unlock access to flexible online gigs that pay via M-Pesa. Join <strong>Campus Hustle Kenya</strong> now!</p>
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
    "@type": "WebPage",
    "name": "Pricing - Campus Hustle Kenya",
    "description": "Choose a one-time membership plan to unlock flexible online gigs for Kenyan students with instant M-Pesa payouts.",
    "url": "https://www.campushustle.co.ke/pricing.php",
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "https://www.campushustle.co.ke/index.php"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Pricing",
                "item": "https://www.campushustle.co.ke/pricing.php"
            }
        ]
    }
}
</script>

<?php include 'footer.php'; ?>