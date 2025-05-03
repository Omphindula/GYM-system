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
    <title>About Us - Gym Management System</title>
    <meta name="description" content="About Us - Gym Management System">
    <meta name="keywords" content="gym, management, fitness, about us">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .header-info {
            display: inline-flex;
            align-items: center;
            margin-left: 1rem;
        }
        .header-info i {
            margin-right: 0.5rem;
        }
    </style>
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

    <!-- About Us Section -->
   <!-- About Us Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-gray-100 p-10 rounded-lg shadow-lg">
            <h2 class="text-4xl font-bold text-gray-800 mb-8 text-center">About Us</h2>
            <p class="text-xl text-gray-600 mb-6 text-center">
                Welcome to <span class="font-semibold text-indigo-600">GYM MS</span>, your ultimate fitness destination! 
                Our gym is dedicated to helping you achieve your fitness goals and transform your body and mind.
            </p>
            <p class="text-xl text-gray-600 mb-6 text-center">
                With state-of-the-art equipment, expert trainers, and a supportive community, 
                we provide the perfect environment for fitness enthusiasts of all levels.
            </p>
            <p class="text-xl text-gray-600 mb-6 text-center">
                Join us today and embark on a journey to a healthier, happier you!
            </p>
            <div class="mt-8 text-center">
                <a href="login.php" class="inline-block bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">
                    Join Us Now
                </a>
            </div>
        </div>
    </div>
</section>


    <!-- Team Section -->
    <section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Meet Our Team</h2>
        <div class="flex flex-wrap justify-center">
            <!-- Team Member 1 -->
            <div class="max-w-xs m-4 bg-white rounded-lg shadow-lg overflow-hidden" data-aos="zoom-in-right">
                <img src="img/imag.jpg" alt="Team Member 1" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold">Lucas</h3>
                    <p class="text-gray-600">Fitness Trainer</p>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="max-w-xs m-4 bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-up">
                <img src="img/img2.jpg" alt="Team Member 2" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold">Green Rose</h3>
                    <p class="text-gray-600">Nutritionist</p>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="max-w-xs m-4 bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-right">
                <img src="img/img3.jpg" alt="Team Member 3" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold">Sibisi Mzwakhe</h3>
                    <p class="text-gray-600">Personal Trainer</p>
                </div>
            </div>
            <!-- Team Member 4 -->
            <div class="max-w-xs m-4 bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-left">
                <img src="img/img4.jpg" alt="Team Member 4" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold">Thaba Kgatishi</h3>
                    <p class="text-gray-600">Coach</p>
                </div>
            </div>
            <!-- Team Member 5 (with flip-left effect) -->
            <div data-aos="zoom-in-left">
                <div class="max-w-xs m-4 bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="img/img5.jpg" alt="Team Member 5" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">Harris Mboshini</h3>
                        <p class="text-gray-600">Front-desk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

     

    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Add any custom JavaScript here
    </script>
</body>
</html>
