<?php
// register.php
session_start();
require_once 'config.php';

$page_title = "Register - Campus Hustle Kenya";
$page_description = "Sign up for Campus Hustle Kenya to start earning money online with flexible gigs tailored for Kenyan students, paid via M-Pesa.";
$page_keywords = "Campus Hustle Kenya, register, sign up, earn money online, Kenyan students, M-Pesa, freelance, student jobs";
$page_author = "Campus Hustle Kenya";

// Placeholder function for SMS sending (replace with actual SMS gateway API)
function sendSMS($phone, $message) {
    // Simulate SMS sending (replace with Africa's Talking or Twilio API)
    // Example: Africa's Talking API (requires composer require africastalking/africastalking)
    /*
    require 'vendor/autoload.php';
    use AfricasTalking\SDK\AfricasTalking;
    $username = 'your_username';
    $apiKey = 'your_api_key';
    $AT = new AfricasTalking($username, $apiKey);
    $sms = $AT->sms();
    $sms->send(['to' => $phone, 'message' => $message, 'from' => 'CampusHustle']);
    */
    return true; // Return true for development simulation
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $membership_tier = $_POST['membership_tier'];
    $errors = [];

    // Validation
    if (empty($first_name)) {
        $errors[] = "First name is required.";
    }
    if (empty($last_name)) {
        $errors[] = "Last name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email.";
    }
    if (!preg_match('/^\+254\d{9}$/', $phone)) {
        $errors[] = "Please enter a valid M-Pesa phone number (e.g., +254700123456).";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    if (!in_array($membership_tier, ['Basic', 'Pro', 'Premium'])) {
        $errors[] = "Please select a valid membership tier.";
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $errors[] = "Email already registered.";
    }
    $stmt->close();

    // If no errors, proceed with registration
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $otp = sprintf("%06d", mt_rand(100000, 999999)); // Generate 6-digit OTP
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, password, membership_tier, otp, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, FALSE)");
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone, $hashed_password, $membership_tier, $otp);
        if ($stmt->execute()) {
            // Store user ID and OTP in session for verification
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['otp'] = $otp;
            $_SESSION['membership_tier'] = $membership_tier;

            // Send OTP via SMS
            $message = "Your Campus Hustle Kenya OTP is: $otp. Use this code to verify your account.";
            if (sendSMS($phone, $message)) {
                $_SESSION['success_message'] = "Registration successful! Please verify your account with the OTP sent to your phone.";
            } else {
                $errors[] = "Failed to send OTP. Please try again.";
            }
        } else {
            $errors[] = "An error occurred. Please try again.";
        }
        $stmt->close();
    }
}

// Handle OTP verification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_otp'])) {
    $entered_otp = trim($_POST['otp']);
    $errors = [];

    if (empty($entered_otp)) {
        $errors[] = "Please enter the OTP.";
    } elseif ($entered_otp !== $_SESSION['otp']) {
        $errors[] = "Invalid OTP. Please try again.";
    } else {
        // Verify user
        $stmt = $conn->prepare("UPDATE users SET is_verified = TRUE, otp = NULL WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Account verified! Please proceed to payment.";
            unset($_SESSION['otp']);
            header("Location: payments.php");
            exit();
        } else {
            $errors[] = "An error occurred during verification. Please try again.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>

<!-- Register Section -->
<section id="register" class="py-20 bg-gradient-to-r from-blue-600 to-green-500 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-30 z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-8 animate-fade-in">Join Campus Hustle Kenya</h2>
        <p class="text-lg text-gray-100 text-center mb-12 max-w-2xl mx-auto animate-fade-in">Create your account to start earning money online with flexible gigs tailored for Kenyan students, paid instantly via M-Pesa.</p>
        
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
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="bg-green-100 border border-green-200 rounded-lg p-4 mb-8 max-w-lg mx-auto text-center animate-slide-up">
                <p class="text-green-600 text-sm"><?php echo $_SESSION['success_message']; ?></p>
                <?php if (isset($_SESSION['otp'])): ?>
                    <p class="text-gray-600 text-sm mt-2">Development OTP: <strong><?php echo $_SESSION['otp']; ?></strong></p>
                <?php endif; ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        
        <div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-2xl animate-slide-up">
            <?php if (isset($_SESSION['otp']) && isset($_SESSION['user_id'])): ?>
                <!-- OTP Verification Form -->
                <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Verify Your Phone</h3>
                <form method="POST" action="register.php" class="space-y-6">
                    <div>
                        <label class="block text-sm text-gray-600 mb-2">Enter OTP</label>
                        <input
                            type="text"
                            name="otp"
                            placeholder="Enter 6-digit OTP"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                            required
                        >
                    </div>
                    <button
                        type="submit"
                        name="verify_otp"
                        class="w-full bg-primary text-white py-3 rounded-button font-semibold text-sm hover:bg-blue-700 transition-colors duration-200"
                    >
                        Verify OTP
                    </button>
                </form>
                <p class="text-sm text-gray-600 text-center mt-6">Didn't receive an OTP? <a href="#" class="text-primary hover:underline">Resend OTP</a></p>
            <?php else: ?>
                <!-- Registration Form -->
                <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Create Your Account</h3>
                <form method="POST" action="register.php" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">First Name</label>
                            <input
                                type="text"
                                name="first_name"
                                placeholder="e.g., John"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Last Name</label>
                            <input
                                type="text"
                                name="last_name"
                                placeholder="e.g., Doe"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                                required
                            >
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-2">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="e.g., johndoe@example.com"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-2">M-Pesa Phone Number</label>
                        <input
                            type="tel"
                            name="phone"
                            placeholder="e.g., +254 700 123 456"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                            required
                        >
                    </div>
                    <div class="relative">
                        <label class="block text-sm text-gray-600 mb-2">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="At least 8 characters"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                            required
                        >
                        <button type="button" onclick="togglePassword('password', 'password-toggle')" class="absolute right-3 top-10 text-gray-500 hover:text-primary">
                            <i id="password-toggle" class="ri-eye-off-line"></i>
                        </button>
                    </div>
                    <div class="relative">
                        <label class="block text-sm text-gray-600 mb-2">Confirm Password</label>
                        <input
                            type="password"
                            name="confirm_password"
                            id="confirm-password"
                            placeholder="Confirm your password"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                            required
                        >
                        <button type="button" onclick="togglePassword('confirm-password', 'confirm-password-toggle')" class="absolute right-3 top-10 text-gray-500 hover:text-primary">
                            <i id="confirm-password-toggle" class="ri-eye-off-line"></i>
                        </button>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-2">Membership Tier</label>
                        <select
                            name="membership_tier"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                            required
                        >
                            <option value="" disabled selected>Select a plan</option>
                            <option value="Basic">Basic (KES 750)</option>
                            <option value="Pro">Pro (KES 1,000)</option>
                            <option value="Premium">Premium (KES 1,500)</option>
                        </select>
                    </div>
                    <button
                        type="submit"
                        name="register"
                        class="w-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white py-3 rounded-button font-semibold text-sm hover:shadow-lg transition-all duration-200"
                    >
                        Create Account
                    </button>
                </form>
                <p class="text-sm text-gray-600 text-center mt-6">Already have an account? <a href="login.php" class="text-primary hover:underline">Log In</a></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Structured Data for SEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Register - Campus Hustle Kenya",
    "description": "Sign up for Campus Hustle Kenya to start earning money online with flexible gigs tailored for Kenyan students, paid via M-Pesa.",
    "url": "https://www.campushustle.co.ke/register.php",
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
                "name": "Register",
                "item": "https://www.campushustle.co.ke/register.php"
            }
        ]
    }
}
</script>

<?php include 'footer.php'; ?>