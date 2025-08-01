<?php
// header.php

// Ensure variables are defined
$page_title = isset($page_title) ? htmlspecialchars($page_title) : "Campus Hustle Kenya";
$page_description = isset($page_description) ? htmlspecialchars($page_description) : "Earn money online as a Kenyan student with flexible gigs.";
$page_keywords = isset($page_keywords) ? htmlspecialchars($page_keywords) : "Campus Hustle Kenya, earn money online, Kenyan students";
$page_author = isset($page_author) ? htmlspecialchars($page_author) : "Campus Hustle Kenya";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $page_description; ?>">
    <meta name="keywords" content="<?php echo $page_keywords; ?>">
    <meta name="author" content="<?php echo $page_author; ?>">
    <meta name="robots" content="index, follow">
    <title><?php echo $page_title; ?></title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#16a34a',
                        accent: '#f59e0b'
                    },
                    borderRadius: {
                        'none': '0px',
                        'sm': '4px',
                        DEFAULT: '8px',
                        'md': '12px',
                        'lg': '16px',
                        'xl': '20px',
                        '2xl': '24px',
                        '3xl': '32px',
                        'full': '9999px',
                        'button': '8px'
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Campus Hustle Kenya",
        "url": "https://www.campushustle.co.ke",
        "description": "Platform for Kenyan students to earn money through online gigs with M-Pesa payouts.",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://www.campushustle.co.ke/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
</head>
<body class="bg-slate-50 font-['Inter'] min-h-screen">
    <header class="bg-white shadow-sm sticky top-0 z-50 backdrop-blur-lg bg-opacity-90">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center space-x-2 transition-transform duration-200 hover:scale-105">
                        <h1 class="font-['Pacifico'] text-3xl text-primary">Campus Hustle Kenya</h1>
                    </a>
                </div>
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8" aria-label="Main navigation">
                    <a href="how_it_works.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">How It Works</a>
                    <a href="pricing.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Pricing</a>
                    <a href="gigs.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Gigs</a>
                    <a href="faq.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">FAQ</a>
                    <a href="contact.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Contact</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="dashboard.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Dashboard</a>
                        <a href="logout.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Log Out</a>
                    <?php else: ?>
                        <a href="login.php" class="bg-primary text-white  hover:bg-gray-200 hover:text-primary px-6 py-2 rounded-button font-medium text-base transition-all duration-200">Login</a>
                        <a href="register.php" class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white  px-6 py-2 rounded-button font-medium text-base hover:shadow-lg transition-all duration-200">Sign Up</a>
                    <?php endif; ?>
                </nav>
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-600 hover:text-primary focus:outline-none" aria-label="Toggle mobile menu">
                    <i class="ri-menu-line text-2xl"></i>
                </button>
            </div>
            <!-- Mobile Navigation -->
            <nav id="mobile-menu" class="hidden md:hidden bg-white flex-col space-y-4 py-6 px-6 border-t border-gray-200 transition-all duration-300" aria-label="Mobile navigation">
                <a href="how_it_works.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">How It Works</a>
                <a href="pricing.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Pricing</a>
                <a href="gigs.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Gigs</a>
                <a href="faq.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">FAQ</a>
                <a href="contact.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Contact</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Dashboard</a>
                    <a href="logout.php" class="text-gray-600 hover:text-primary font-medium text-base transition-colors duration-200">Log Out</a>
                <?php else: ?>
                    <a href="login.php" class="bg-primary text-white hover:bg-gray-200 hover:text-primary px-6 py-2 rounded-button font-medium text-base transition-all duration-200 text-center">Log In</a>
                    <a href="register.php" class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-6 py-2 rounded-button font-medium text-base hover:shadow-lg transition-all duration-200 text-center">Sign Up</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Inline JavaScript for Mobile Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                // Toggle the menu icon between hamburger and close
                const icon = mobileMenuButton.querySelector('i');
                icon.classList.toggle('ri-menu-line');
                icon.classList.toggle('ri-close-line');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                    // Reset to hamburger icon
                    const icon = mobileMenuButton.querySelector('i');
                    icon.classList.remove('ri-close-line');
                    icon.classList.add('ri-menu-line');
                }
            });
        });
    </script>
</body>
</html>