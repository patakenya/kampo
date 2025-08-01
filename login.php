<?php
// login.php
session_start();
require_once 'config.php';

$page_title = "Login - Campus Hustle Kenya";
$page_description = "Log in to Campus Hustle Kenya to access flexible online gigs and start earning money as a Kenyan student, paid via M-Pesa.";
$page_keywords = "Campus Hustle Kenya, login, sign in, earn money online, Kenyan students, M-Pesa, freelance, student jobs";
$page_author = "Campus Hustle Kenya";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $errors = [];

    // Basic validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // Authenticate user
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id, first_name, last_name, password, is_verified FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Check if account is verified
                if (!$user['is_verified']) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['success_message'] = "Please verify your account with the OTP sent to your phone.";
                    header("Location: register.php");
                    exit();
                }
                // Check payment status
                $stmt = $conn->prepare("SELECT status FROM payments WHERE user_id = ? AND status = 'Approved'");
                $stmt->bind_param("i", $user['id']);
                $stmt->execute();
                if ($stmt->get_result()->num_rows === 0) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['membership_tier'] = $conn->query("SELECT membership_tier FROM users WHERE id = {$user['id']}")->fetch_assoc()['membership_tier'];
                    $_SESSION['success_message'] = "Please complete your membership payment.";
                    header("Location: payments.php");
                    exit();
                }
                // Successful login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                header("Location: dashboard.php");
                exit();
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "Email not found.";
        }
        $stmt->close();
    }
}

// Check for success message from registration or payment
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);
?>

<?php include 'header.php'; ?>

<!-- Login Section -->
<section id="login" class="py-20 bg-gradient-to-r from-blue-600 to-green-500 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-30 z-0"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-8 animate-fade-in">Log In to Your Account</h2>
        <p class="text-lg text-gray-100 text-center mb-12 max-w-2xl mx-auto animate-fade-in">Access your Campus Hustle Kenya account to start earning with flexible online gigs, paid instantly via M-Pesa.</p>
        
        <!-- Success Message -->
        <?php if ($success_message): ?>
            <div class="bg-green-100 border border-green-200 rounded-lg p-4 mb-8 max-w-lg mx-auto text-center animate-slide-up">
                <p class="text-green-600 text-sm"><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <!-- Error Messages -->
        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 border border-red-200 rounded-lg p-4 mb-8 max-w-lg mx-auto text-center animate-slide-up">
                <ul class="text-red-600 text-sm">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-2xl animate-slide-up">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Log In</h3>
            <form method="POST" action="login.php" class="space-y-6">
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
                <div class="relative">
                    <label class="block text-sm text-gray-600 mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200"
                        required
                    >
                    <button type="button" onclick="togglePassword('password', 'password-toggle')" class="absolute right-3 top-10 text-gray-500 hover:text-primary">
                        <i id="password-toggle" class="ri-eye-off-line"></i>
                    </button>
                </div>
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white py-3 rounded-button font-semibold text-sm hover:shadow-lg transition-all duration-200"
                >
                    Log In
                </button>
            </form>
            <p class="text-sm text-gray-600 text-center mt-6">Don't have an account? <a href="register.php" class="text-primary hover:underline">Sign Up</a></p>
        </div>
    </div>
</section>

<!-- Structured Data for SEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Login - Campus Hustle Kenya",
    "description": "Log in to Campus Hustle Kenya to access flexible online gigs and start earning money as a Kenyan student, paid via M-Pesa.",
    "url": "https://www.campushustle.co.ke/login.php",
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
                "name": "Login",
                "item": "https://www.campushustle.co.ke/login.php"
            }
        ]
    }
}
</script>

<?php include 'footer.php'; ?>