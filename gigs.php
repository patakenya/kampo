<?php
// gigs.php
session_start();
require_once 'config.php';

$page_title = "Available Gigs - Campus Hustle Kenya";
$page_description = "Browse flexible online gigs for Kenyan students, including article writing, digital marketing, transcription, and more, with instant M-Pesa payouts.";
$page_keywords = "Campus Hustle Kenya, online gigs, Kenyan students, M-Pesa, freelance, student jobs, article writing, digital marketing, transcription";
$page_author = "Campus Hustle Kenya";

// Fetch gigs from database
$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
$difficulty = isset($_GET['difficulty']) ? htmlspecialchars($_GET['difficulty']) : '';

$query = "SELECT title, icon, icon_bg, icon_color, description, payment, duration, badge, badge_bg, badge_text, category, difficulty FROM gigs";
$conditions = [];
$params = [];
$types = '';

if ($category) {
    $conditions[] = "category = ?";
    $params[] = $category;
    $types .= 's';
}
if ($difficulty) {
    $conditions[] = "difficulty = ?";
    $params[] = $difficulty;
    $types .= 's';
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$gigs_result = $stmt->get_result();
$gigs = $gigs_result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch unique categories and difficulties for filters
$categories = $conn->query("SELECT DISTINCT category FROM gigs")->fetch_all(MYSQLI_ASSOC);
$difficulties = $conn->query("SELECT DISTINCT difficulty FROM gigs")->fetch_all(MYSQLI_ASSOC);
?>

<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 to-green-500 py-20 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-30 z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight animate-fade-in">
                Find Your Perfect Gig
            </h1>
            <p class="text-lg text-gray-100 mb-6 max-w-2xl mx-auto">
                Explore a variety of online gigs tailored for Kenyan students. Earn money with flexible tasks and instant M-Pesa payouts.
            </p>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="#gigs" class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-8 py-3 rounded-button font-semibold text-base hover:shadow-lg transition-all">
                    Browse Gigs
                </a>
            <?php else: ?>
                <a href="register.php" class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-8 py-3 rounded-button font-semibold text-base hover:shadow-lg transition-all">
                    Sign Up to Start Earning
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Filters Section -->
<section id="filters" class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Filter Gigs</h2>
        <form method="GET" action="gigs.php" class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
            <div class="flex-1">
                <label class="block text-sm text-gray-600 mb-1">Category</label>
                <select name="category" class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat['category']); ?>" <?php echo $category === $cat['category'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['category']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm text-gray-600 mb-1">Difficulty</label>
                <select name="difficulty" class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">All Difficulties</option>
                    <?php foreach ($difficulties as $diff): ?>
                        <option value="<?php echo htmlspecialchars($diff['difficulty']); ?>" <?php echo $difficulty === $diff['difficulty'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($diff['difficulty']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-button font-medium text-sm hover:bg-blue-700 transition-colors">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Gigs Section -->
<section id="gigs" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Available Gigs</h2>
        <p class="text-lg text-gray-600 text-center mb-12 max-w-2xl mx-auto">Choose from a variety of online gigs designed for Kenyan students, with flexible schedules and instant payouts.</p>
        <?php if (empty($gigs)): ?>
            <p class="text-center text-gray-600">No gigs found matching your criteria. Try adjusting the filters.</p>
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
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="w-full bg-primary text-white py-2 rounded-button font-medium text-sm hover:bg-blue-700 transition-colors mt-4">
                                Apply Now
                            </button>
                        <?php else: ?>
                            <a href="register.php" class="w-full bg-accent text-white py-2 rounded-button font-medium text-sm hover:bg-orange-600 transition-colors mt-4 text-center">
                                Sign Up to Apply
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-yellow-400 to-orange-500">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Start Earning Today!</h2>
        <p class="text-lg text-white mb-8 max-w-2xl mx-auto">Join <strong>Campus Hustle Kenya</strong> to access flexible online gigs and get paid instantly via M-Pesa.</p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="#gigs" class="bg-white text-primary px-8 py-3 rounded-button font-semibold text-base hover:bg-gray-100 transition-colors">
                Explore More Gigs
            </a>
        <?php else: ?>
            <div class="flex justify-center space-x-4">
                <a href="register.php" class="bg-white text-primary px-8 py-3 rounded-button font-semibold text-base hover:bg-gray-100 transition-colors">
                    Sign Up Now
                </a>
                <a href="login.php" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-button font-semibold text-base hover:bg-white hover:text-primary transition-all">
                    Log In
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Structured Data for SEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Available Gigs - Campus Hustle Kenya",
    "description": "Browse flexible online gigs for Kenyan students, including article writing, digital marketing, transcription, and more, with instant M-Pesa payouts.",
    "url": "https://www.campushustle.co.ke/gigs.php",
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
                "name": "Gigs",
                "item": "https://www.campushustle.co.ke/gigs.php"
            }
        ]
    }
}
</script>

<?php include 'footer.php'; ?>