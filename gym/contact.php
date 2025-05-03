<?php 
session_start();
error_reporting(0);
include 'include/config.php';
$uid = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Gym Management System</title>
    <meta name="description" content="Contact Us - Gym Management System">
    <meta name="keywords" content="gym, management, fitness, contact us">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-indigo-600 text-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div>
                    <a href="index.php" class="text-2xl font-bold">
                        GYM MS
                        <small class="block text-sm">Gym Management System</small>
                    </a>
                </div>
                <div class="flex items-center">
                    <?php if(strlen($_SESSION['uid'])==0): ?>
                        <div class="header-info">
                            <i class="material-icons">account_circle</i>
                            <a href="login.php" class="hover:text-gray-200">Login</a>
                        </div>
                    <?php else: ?>
                        <div class="header-info">
                            <i class="material-icons">account_circle</i>
                            <a href="profile.php" class="hover:text-gray-200">My Profile</a>
                        </div>
                        <div class="header-info">
                            <i class="material-icons">brightness_7</i>
                            <a href="changepassword.php" class="hover:text-gray-200">Change Password</a>
                        </div>
                        <div class="header-info">
                            <i class="material-icons">logout</i>
                            <a href="logout.php" class="hover:text-gray-200">Logout</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <nav class="py-4">
                <ul class="flex space-x-6">
                    <li><a href="index.php" class="hover:text-gray-200">Home</a></li>
                    <li><a href="about.php" class="hover:text-gray-200">About</a></li>

                    <li><a href="contact.php" class="hover:text-gray-200">Contact</a></li>
                    <?php if(strlen($_SESSION['uid'])==0): ?>
                        <li><a href="./admin/index.php" class="hover:text-gray-200">Admin</a></li>
                    <?php else: ?>
                        <li><a href="booking-history.php" class="hover:text-gray-200">Booking History</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contact Us Section -->
    <section class="pricing-section spad bg-gray-100 py-20">
        <div class="container mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-indigo-600 mb-4">Contact Us</h2>
                <p class="text-lg text-gray-700 mb-4">
                    <strong>Email:</strong> <a href="mailto:info@yourdomain.com" class="text-indigo-600">info@yourdomain.com</a>
                </p>
                <p class="text-lg text-gray-700 mb-4">
                    <strong>Contact No:</strong> <span class="text-indigo-600">1234567890, 1122334455</span>
                </p>
                <p class="text-lg text-gray-700 mb-4">
                    <strong>Address:</strong> <span class="text-indigo-600">Test Address</span>
                </p>
                <div class="mt-8">
                    <a href="contact-form.php" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition duration-300">
                        Send Us a Message
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
