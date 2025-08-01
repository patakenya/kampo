<?php
// payments.php
session_start();
require_once 'config.php';

$page_title = "Membership Payment - Campus Hustle Kenya";
$page_description = "Complete your membership payment via M-Pesa to till number 4178866 and start earning with Campus Hustle Kenya.";
$page_keywords = "Campus Hustle Kenya, membership payment, M-Pesa, Kenyan students, freelance, student jobs";
$page_author = "Campus Hustle Kenya";

// Check if user is logged in and verified
if (!isset($_SESSION['user_id']) || !isset($_SESSION['membership_tier'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$stmt = $conn->prepare("SELECT first_name, is_verified FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user['is_verified']) {
    header("Location: register.php");
    exit();
}

// Handle payment form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $membership_tier = $_POST['membership_tier'] ?? $_SESSION['membership_tier'];
    $mpesa_code = htmlspecialchars(trim($_POST['mpesa_code']));
    $errors = [];

    // Validation
    if (!in_array($membership_tier, ['Basic', 'Pro', 'Premium'])) {
        $errors[] = "Please select a valid membership tier.";
    }
    if (empty($mpesa_code) || !preg_match('/^[A-Z0-9]{10}$/', $mpesa_code)) {
        $errors[] = "Please enter a valid M-Pesa transaction code (10 alphanumeric characters).";
    }

    // Check if payment already exists for this user
    $stmt = $conn->prepare("SELECT id FROM payments WHERE user_id = ? AND status = 'Pending'");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $errors[] = "You already have a pending payment. Please wait for admin approval.";
    }
    $stmt->close();

    // If no errors, save payment
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO payments (user_id, membership_tier, mpesa_code, status) VALUES (?, ?, ?, 'Pending')");
        $stmt->bind_param("iss", $_SESSION['user_id'], $membership_tier, $mpesa_code);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Payment submitted successfully! Awaiting admin approval.";
            header("Location: dashboard.php");
            exit();
        } else {
            $errors[] = "An error occurred. Please try again.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>

<!-- Payment Section -->
<section id="payment" class="py-20 bg-gradient-to-r from-blue-600 to-green-500 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-30 z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-8 animate-fade-in">Complete Your Membership Payment</h2>
        <p class="text-lg text-gray-100 text-center mb-12 max-w-2xl mx-auto animate-fade-in">Pay your one-time membership fee via M-Pesa to till number <strong>4178866</strong> and submit the transaction code below to start earning.</p>
        
        <!-- Error/Success Messages -->
        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 border border-red-200 rounded-lg p-4 mb-8 max-w-lg mx-auto text-center animate-slide-up">
                <ul class="text-red-600 text-sm">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-2xl animate-slide-up">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">M-Pesa Payment</h3>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">How to Pay</h4>
                <ol class="text-sm text-gray-600 space-y-2">
                    <li>1. Open your M-Pesa menu on your phone.</li>
                    <li>2. Select <strong>Lipa na M-Pesa</strong> > <strong>Buy Goods And Services</strong>.</li>
                    <li>3. Enter Till Number: <strong>4178866</strong> <button type="button" onclick="copyTillNumber()" class="text-primary hover:underline ml-1">Copy</button></li>
                    <li>4. Enter Amount: <strong>
                        <?php
                        $amount = $_SESSION['membership_tier'] === 'Basic' ? 'KES 750' :
                                  ($_SESSION['membership_tier'] === 'Pro' ? 'KES 1,000' : 'KES 1,500');
                        echo $amount;
                        ?>
                    </strong></li>
                    <li>5. Enter your M-Pesa PIN and confirm.</li>
                    <li>6. Submit the transaction code below.</li>
                </ol>
            </div>
            <form method="POST" action="payments.php" class="space-y-6" onsubmit="return validatePaymentForm()">
                <div>
                    <label class="block text-sm text-gray-600 mb-2">Membership Tier</label>
                    <select
                        name="membership_tier"
                        id="membership-tier"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                        required
                        <?php echo isset($_SESSION['membership_tier']) ? 'disabled' : ''; ?>
                    >
                        <option value="Basic" <?php echo $_SESSION['membership_tier'] === 'Basic' ? 'selected' : ''; ?>>Basic (KES 750)</option>
                        <option value="Pro" <?php echo $_SESSION['membership_tier'] === 'Pro' ? 'selected' : ''; ?>>Pro (KES 1,000)</option>
                        <option value="Premium" <?php echo $_SESSION['membership_tier'] === 'Premium' ? 'selected' : ''; ?>>Premium (KES 1,500)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-2">M-Pesa Transaction Code</label>
                    <input
                        type="text"
                        name="mpesa_code"
                        id="mpesa-code"
                        placeholder="e.g., TGV2D52JIK"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                        required
                    >
                </div>
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white py-3 rounded-button font-semibold text-sm hover:shadow-lg transition-all duration-200"
                >
                    Submit Payment
                </button>
            </form>
            <p class="text-sm text-gray-600 text-center mt-6">Payment will be reviewed by our admin team. You'll be notified once approved.</p>
        </div>
    </div>
</section>

<!-- Structured Data for SEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Membership Payment - Campus Hustle Kenya",
    "description": "Complete your membership payment via M-Pesa to till number 4178866 and start earning with Campus Hustle Kenya.",
    "url": "https://www.campushustle.co.ke/payments.php",
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
                "name": "Payment",
                "item": "https://www.campushustle.co.ke/payments.php"
            }
        ]
    }
}
</script>

<?php include 'footer.php'; ?>