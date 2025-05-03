<header class="bg-indigo-600 text-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div>
                <a href="index.php" class="text-2xl font-bold">
                    GYM MS
                    <small class="block text-sm">Gym Management System</small>
                </a>
            </div>
            <!-- User Info Section -->
            <div class="flex items-center">
                <?php if(strlen($_SESSION['uid'])==0): ?>
                    <!-- If not logged in, show login option -->
                    <div class="header-info flex items-center space-x-2">
                        <i class="material-icons">account_circle</i>
                        <a href="login.php" class="hover:text-gray-200">Login</a>
                    </div>
                <?php else: ?>
                    <!-- If logged in, show profile, change password, and logout options -->
                    <div class="header-info flex items-center space-x-2">
                        <i class="material-icons">account_circle</i>
                        <a href="profile.php" class="hover:text-gray-200">My Profile</a>
                    </div>
                    <div class="header-info flex items-center space-x-2">
                        <i class="material-icons">lock</i>
                        <a href="changepassword.php" class="hover:text-gray-200">Change Password</a>
                    </div>
                    <div class="header-info flex items-center space-x-2">
                        <i class="material-icons">logout</i>
                        <a href="logout.php" class="hover:text-gray-200">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Navigation Menu -->
        <nav class="py-4">
            <ul class="flex space-x-6">
                <li class="flex items-center space-x-2">
                    <i class="material-icons">home</i>
                    <a href="index.php" class="hover:text-gray-200">Home</a>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="material-icons">info</i>
                    <a href="about.php" class="hover:text-gray-200">About</a>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="material-icons">phone</i>
                    <a href="contact.php" class="hover:text-gray-200">Contact</a>
                </li>
                <?php if(strlen($_SESSION['uid'])==0): ?>
                    <li class="flex items-center space-x-2">
                        <i class="material-icons">admin_panel_settings</i>
                        <a href="./admin/index.php" class="hover:text-gray-200">Admin</a>
                    </li>
                <?php else: ?>
                    <li class="flex items-center space-x-2">
                        <i class="material-icons">history</i>
                        <a href="booking-history.php" class="hover:text-gray-200">Booking History</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
