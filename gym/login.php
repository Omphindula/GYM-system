<?php
session_start();
error_reporting(0);
require_once('include/config.php');
$msg = ""; 
if(isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = md5(($_POST['password']));
  if($email != "" && $password != "") {
    try {
      $query = "select id, fname, lname, email, mobile, password, address, create_date from tbluser where email=:email and password=:password";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        $_SESSION['uid']   = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['fname'];
       header("location: index.php");
      } else {
        $msg = "Invalid username and password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both fields are required!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gym Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="images/x-icon" href="">
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

    <!-- Page top Section -->
    <section class="relative bg-cover bg-center py-32" style="background-image: url('https://hyperli.com/cdn/shop/products/FT_20Fitness_20Gym.jpg?v=1698689632');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-white mb-4">Login</h1>
            </div>
        </div>
    </section>

    <!-- Login Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
                <div class="bg-indigo-600 text-white text-center py-6">
                    <h2 class="text-3xl font-bold">User Login</h2>
                </div>
                <div class="p-6">
                    <?php if($msg): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error:</strong>
                            <span class="block sm:inline"><?php echo htmlentities($msg); ?></span>
                        </div>
                    <?php endif; ?>

                    <form class="space-y-6" method="post">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" name="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 transition duration-300">
                                Login
                            </button>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600">Don't have an account? 
                            <a href="registration.php" class="font-medium text-indigo-600 hover:text-indigo-500">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>