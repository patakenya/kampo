<?php
// index.php
session_start();
require_once 'config.php';

$page_title = "Campus Hustle Kenya - Earn Money as a Student";
$page_description = "Campus Hustle Kenya: Earn money online as a Kenyan student with flexible gigs like article writing, digital marketing, and transcription. Get paid via M-Pesa. Join now!";
$page_keywords = "Campus Hustle Kenya, earn money online, Kenyan students, online gigs, M-Pesa, freelance, student jobs, article writing, digital marketing";
$page_author = "Campus Hustle Kenya";

// Handle sign-up form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email.";
    }

    if (empty($errors)) {
        $_SESSION['signup_email'] = $email;
        header("Location: register.php");
        exit();
    }
}

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

// Fetch gigs from database
$gigs = [];
$result = $conn->query("SELECT title, icon, icon_bg, icon_color, description, payment, duration, badge, badge_bg, badge_text FROM gigs LIMIT 8");
while ($row = $result->fetch_assoc()) {
    $gigs[] = $row;
}
$result->close();
?>

<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 to-green-500 py-20 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-30 z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Left: Headline & CTA -->
            <div class="text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight animate-fade-in">
                    Turn Your Skills into Cash as a Kenyan Student
                </h1>
                <p class="text-lg text-gray-100 mb-6 max-w-lg mx-auto md:mx-0 animate-fade-in">
                    Join <span class="font-semibold">Campus Hustle Kenya</span> and earn money online with flexible gigs like writing, marketing, and more. Get paid instantly via M-Pesa!
                </p>
                <!-- Sign-Up Form -->
                <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-md mx-auto md:mx-0 animate-slide-up">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Start Earning Today</h3>
                    <?php if (!empty($errors)): ?>
                        <div class="bg-red-100 border border-red-200 rounded-lg p-4 mb-6 text-center">
                            <ul class="text-red-600 text-sm">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="index.php" class="space-y-4" onsubmit="return validateSignupForm()">
                        <input
                            type="email"
                            name="email"
                            id="signup-email"
                            placeholder="Enter your email"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                            aria-label="Email address"
                            required
                        >
                        <button
                            type="submit"
                            id="signup-button"
                            class="w-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white py-3 rounded-button font-semibold text-sm hover:shadow-lg transition-all duration-200"
                            aria-label="Sign Up for Free"
                        >
                            Sign Up Now
                        </button>
                    </form>
                    <p class="text-sm text-gray-600 mt-4 text-center">
                        <a href="pricing.php" class="text-primary hover:underline">See Membership Plans</a>
                    </p>
                </div>
                <!-- Social Proof -->
                <div class="flex items-center justify-center md:justify-start mt-6 space-x-4 animate-fade-in">
                    <div class="flex -space-x-2">
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white"></div>
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white"></div>
                        <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-white"></div>
                    </div>
                    <p class="text-sm text-gray-100">
                        Join <span class="font-semibold">5,000+</span> students earning online
                    </p>
                </div>
            </div>
            <!-- Right: Visual -->
            <div class="relative hidden md:block">
                <img
                    src="pic.png"
                    alt="Kenyan student working online with Campus Hustle Kenya"
                    class="rounded-2xl shadow-2xl max-w-full h-auto animate-slide-in-right"
                >
                <div class="absolute -top-6 -left-6 w-24 h-24 bg-accent rounded-full opacity-50 animate-pulse"></div>
                <div class="absolute -bottom-6 -right-6 w-16 h-16 bg-secondary rounded-full opacity-50 animate-pulse"></div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12 animate-fade-in">How Campus Hustle Kenya Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center animate-slide-up">
                <div class="w-16 h-16 bg-primary rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="ri-user-add-line text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Sign Up</h3>
                <p class="text-gray-600 text-sm">Create an account using your email and M-Pesa number.</p>
            </div>
            <div class="text-center animate-slide-up">
                <div class="w-16 h-16 bg-secondary rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="ri-briefcase-line text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Browse Gigs</h3>
                <p class="text-gray-600 text-sm">Explore a variety of online gigs tailored to your skills and schedule.</p>
            </div>
            <div class="text-center animate-slide-up">
                <div class="w-16 h-16 bg-accent rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="ri-checkbox-circle-line text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Apply & Work</h3>
                <p class="text-gray-600 text-sm">Apply for gigs, complete tasks, and submit your work for approval.</p>
            </div>
            <div class="text-center animate-slide-up">
                <div class="w-16 h-16 bg-primary rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="ri-money-pound-circle-line text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Get Paid</h3>
                <p class="text-gray-600 text-sm">Receive instant payments via M-Pesa upon task completion.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12 animate-fade-in">Why Choose Campus Hustle Kenya?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center animate-slide-up">
                <div class="w-16 h-16 bg-primary rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="ri-money-pound-circle-line text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Earn with M-Pesa</h3>
                <p class="text-gray-600 text-sm">Get paid instantly via M-Pesa for online gigs like writing, marketing, and transcription.</p>
            </div>
            <div class="text-center animate-slide-up">
                <div class="w-16 h-16 bg-secondary rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="ri-calendar-check-line text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Flexible Gigs</h3>
                <p class="text-gray-600 text-sm">Choose online tasks that fit your skills and schedule, from quick gigs to longer projects.</p>
            </div>
            <div class="text-center animate-slide-up">
                <div class="w-16 h-16 bg-accent rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="ri-shield-star-line text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Student-Focused</h3>
                <p class="text-gray-600 text-sm">Built for Kenyan students, with gigs tailored to your skills.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12 animate-fade-in">Choose Your One-Time Membership Plan</h2>
        <p class="text-lg text-gray-600 text-center mb-12 max-w-2xl mx-auto animate-fade-in">Unlock flexible online gigs with a single payment. No recurring fees, just instant access to earning opportunities tailored for Kenyan students!</p>
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
                <form method="POST" action="index.php">
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
                <form method="POST" action="index.php">
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
                <form method="POST" action="index.php">
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

<!-- Gigs Section -->
<section id="gigs" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12 animate-fade-in">Explore Popular Online Gigs</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($gigs as $gig): ?>
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-xl transition-all duration-200 animate-slide-up">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 <?php echo htmlspecialchars($gig['icon_bg']); ?> rounded-lg flex items-center justify-center">
                            <i class="<?php echo htmlspecialchars($gig['icon']); ?> <?php echo htmlspecialchars($gig['icon_color']); ?> text-xl"></i>
                        </div>
                        <span class="<?php echo htmlspecialchars($gig['badge_bg']); ?> <?php echo htmlspecialchars($gig['badge_text']); ?> text-xs px-2 py-1 rounded-full font-medium"><?php echo htmlspecialchars($gig['badge']); ?></span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2"><?php echo htmlspecialchars($gig['title']); ?></h3>
                    <p class="text-sm text-gray-600 mb-4"><?php echo htmlspecialchars($gig['description']); ?></p>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Payment:</span>
                        <span class="font-semibold text-secondary"><?php echo htmlspecialchars($gig['payment']); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Duration:</span>
                        <span class="text-gray-700"><?php echo htmlspecialchars($gig['duration']); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-8">
            <a
                href="gigs.php"
                class="bg-primary text-white px-8 py-3 rounded-button font-semibold text-sm hover:bg-blue-700 transition-all duration-200"
                aria-label="View All Gigs"
            >
                View All Gigs
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12 animate-fade-in">What Students Are Saying</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 animate-slide-up">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-900">Jane W.</p>
                        <p class="text-sm text-gray-600">University Student</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">"I earned KES 5,000 last month writing articles and doing data entry. The M-Pesa payouts are super fast!"</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-6 animate-slide-up">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-900">Michael O.</p>
                        <p class="text-sm text-gray-600">University Student</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">"The Pro plan gave me access to high-paying digital marketing gigs. Totally worth it!"</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-6 animate-slide-up">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-900">Grace N.</p>
                        <p class="text-sm text-gray-600">University Student</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">"I love how easy it is to find online gigs that fit my schedule. Campus Hustle is a game-changer!"</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section id="cta" class="py-16 bg-gradient-to-r from-yellow-400 to-orange-500">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 animate-fade-in">Start Earning Today!</h2>
        <p class="text-lg text-white mb-8 max-w-2xl mx-auto animate-fade-in">Join thousands of Kenyan students already earning with <strong>Campus Hustle Kenya</strong>. Sign up now and access online gigs that pay via M-Pesa!</p>
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
    "name": "Campus Hustle Kenya - Earn Money as a Student",
    "description": "Campus Hustle Kenya: Earn money online as a Kenyan student with flexible gigs like article writing, digital marketing, and transcription. Get paid via M-Pesa. Join now!",
    "url": "https://www.campushustle.co.ke/index.php",
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "https://www.campushustle.co.ke/index.php"
            }
        ]
    }
}
</script>

<?php include 'footer.php'; ?>