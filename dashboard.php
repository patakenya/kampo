<?php
// dashboard.php
session_start();
require_once 'config.php';

$page_title = "Dashboard - Campus Hustle Kenya";
$page_description = "Access your Campus Hustle Kenya dashboard to browse online gigs, track earnings, and manage your account as a Kenyan student.";
$page_keywords = "Campus Hustle Kenya, dashboard, online gigs, Kenyan students, M-Pesa, freelance, student jobs";
$page_author = "Campus Hustle Kenya";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$stmt = $conn->prepare("SELECT first_name, last_name, email, phone, is_verified, membership_tier FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Check if user is verified
if (!$user['is_verified']) {
    $_SESSION['error_message'] = "Please verify your account to access the dashboard.";
    header("Location: register.php");
    exit();
}

// Check payment status
$stmt = $conn->prepare("SELECT status FROM payments WHERE user_id = ? AND status = 'Approved'");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$payment = $stmt->get_result()->fetch_assoc();
$is_payment_approved = !empty($payment);
$stmt->close();

// Fetch gigs from database
$gigs_result = $conn->query("SELECT title, icon, icon_bg, icon_color, description, payment, duration, badge, badge_bg, badge_text, category, difficulty FROM gigs");
$gigs = $gigs_result->fetch_all(MYSQLI_ASSOC);
?>

<?php include 'header.php'; ?>

<!-- Dashboard Section -->
<section id="dashboard" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Welcome, <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>!</h2>
        <p class="text-lg text-gray-600 text-center mb-12 max-w-2xl mx-auto">Explore available gigs, track your earnings, and manage your account.</p>
        
        <!-- Payment Status Message -->
        <?php if (!$is_payment_approved): ?>
            <div class="bg-yellow-100 border border-yellow-200 rounded-lg p-4 mb-8 text-center">
                <p class="text-yellow-600 text-sm">Your membership payment is pending approval. You'll be able to apply for gigs once approved.</p>
                <a href="payments.php" class="text-primary hover:underline text-sm mt-2 inline-block">Complete Payment</a>
            </div>
        <?php endif; ?>
        
        <!-- User Info -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-12">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Your Profile</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Full Name</p>
                    <p class="font-medium text-gray-900"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium text-gray-900"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">M-Pesa Phone</p>
                    <p class="font-medium text-gray-900"><?php echo htmlspecialchars($user['phone']); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Membership Tier</p>
                    <p class="font-medium text-gray-900"><?php echo htmlspecialchars($user['membership_tier']); ?></p>
                </div>
            </div>
            <div class="mt-4 text-right">
                <a href="logout.php" class="text-primary hover:underline text-sm">Log Out</a>
            </div>
        </div>

        <!-- Earnings Summary (Placeholder) -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-12">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Earnings Summary</h3>
            <p class="text-gray-600">Total Earnings: <span class="font-semibold text-secondary">KES 0</span> (Placeholder)</p>
            <p class="text-gray-600">Completed Gigs: <span class="font-semibold">0</span> (Placeholder)</p>
        </div>

        <!-- Available Gigs -->
        <div class="mb-12">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Available Gigs</h3>
            <?php if (empty($gigs)): ?>
                <p class="text-center text-gray-600">No gigs available at the moment. Check back later!</p>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($gigs as $gig): ?>
                        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-10 h-10 <?php echo htmlspecialchars($gig['icon_bg']); ?> rounded-lg flex items-center justify-center">
                                    <i class="<?php echo htmlspecialchars($gig['icon']); ?> <?php echo htmlspecialchars($gig['icon_color']); ?>"></i>
                                </div>
                                <span class="<?php echo htmlspecialchars($gig['badge_bg']); ?> <?php echo htmlspecialchars($gig['badge_text']); ?> text-xs px-2 py-1 rounded-full font-medium"><?php echo htmlspecialchars($gig['badge']); ?></span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2"><?php echo htmlspecialchars($gig['title']); ?></h4>
                            <p class="text-sm text-gray-600 mb-4"><?php echo htmlspecialchars($gig['description']); ?></p>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500">Payment:</span>
                                    <span class="font-semibold text-secondary"><?php echo htmlspecialchars($gig['payment']); ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500">Duration:</span>
                                    <span class="text-gray-700"><?php echo htmlspecialchars($gig['duration']); ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500">Category:</span>
                                    <span class="text-gray-700"><?php echo htmlspecialchars($gig['category']); ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500">Difficulty:</span>
                                    <span class="text-gray-700"><?php echo htmlspecialchars($gig['difficulty']); ?></span>
                                </div>
                            </div>
                            <?php if ($is_payment_approved): ?>
                                <button class="w-full bg-primary text-white py-2 rounded-button font-medium text-sm hover:bg-blue-700 transition-colors mt-4">
                                    Apply Now
                                </button>
                            <?php else: ?>
                                <a href="payments.php" class="w-full bg-accent text-white py-2 rounded-button font-medium text-sm hover:bg-orange-600 transition-colors mt-4 text-center">
                                    Complete Payment to Apply
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-yellow-400 to-orange-500">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Keep Hustling!</h2>
        <p class="text-lg text-white mb-8 max-w-2xl mx-auto">Browse more gigs and start earning today with <strong>Campus Hustle Kenya</strong>.</p>
        <?php if ($is_payment_approved): ?>
            <a href="#dashboard" class="bg-white text-primary px-8 py-3 rounded-button font-semibold text-base hover:bg-gray-100 transition-colors">
                Explore Gigs
            </a>
        <?php else: ?>
            <a href="payments.php" class="bg-white text-primary px-8 py-3 rounded-button font-semibold text-base hover:bg-gray-100 transition-colors">
                Complete Payment
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Structured Data for SEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Dashboard - Campus Hustle Kenya",
    "description": "Access your Campus Hustle Kenya dashboard to browse online gigs, track earnings, and manage your account as a Kenyan student.",
    "url": "https://www.campushustle.co.ke/dashboard.php",
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
                "name": "Dashboard",
                "item": "https://www.campushustle.co.ke/dashboard.php"
            }
        ]
    }
}
</script>

<?php include 'footer.php'; ?>