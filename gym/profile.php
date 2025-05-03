<?php
session_start();
error_reporting(0);
require_once('include/config.php');

// Redirect to login page if user is not logged in
if(strlen($_SESSION["uid"]) == 0) {
    header('location:login.php');
} else {
    $uid = $_SESSION['uid'];

    // Fetch user profile information from the database
    $sql = "SELECT fname, lname, mobile, city, state, address FROM tbluser WHERE id=:uid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Form handling: Update user profile
    if(isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mobile = $_POST['mobile'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $address = $_POST['address'];
        
        $update_sql = "UPDATE tbluser SET fname=:fname, lname=:lname, mobile=:mobile, city=:city, state=:state, address=:Address WHERE id=:uid";
        $update_query = $dbh->prepare($update_sql);
        $update_query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $update_query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $update_query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $update_query->bindParam(':city', $city, PDO::PARAM_STR);
        $update_query->bindParam(':state', $state, PDO::PARAM_STR);
        $update_query->bindParam(':Address', $address, PDO::PARAM_STR);
        $update_query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $update_query->execute();
        
        echo "<script>alert('Profile has been updated.');</script>";
        echo "<script>window.location.href='profile.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System | User Profile</title>
    
    <!-- Tailwind CSS and FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .form-section {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <?php include 'include/header.php'; ?>
    
    <!-- Page Top Section -->
    <section class="relative bg-cover bg-center py-32" style="background-image: url('img/page-top-bg.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Profile</h1>
        </div>
    </section>
    
    <!-- Profile Form Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="form-section bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Update Profile</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="fname" class="block text-gray-700">First Name</label>
                        <input type="text" name="fname" id="fname" class="w-full border border-gray-300 px-4 py-2 rounded" value="<?php echo htmlspecialchars($result['fname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="block text-gray-700">Last Name</label>
                        <input type="text" name="lname" id="lname" class="w-full border border-gray-300 px-4 py-2 rounded" value="<?php echo htmlspecialchars($result['lname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="block text-gray-700">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="w-full border border-gray-300 px-4 py-2 rounded" value="<?php echo htmlspecialchars($result['mobile']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="city" class="block text-gray-700">City</label>
                        <input type="text" name="city" id="city" class="w-full border border-gray-300 px-4 py-2 rounded" value="<?php echo htmlspecialchars($result['city']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="state" class="block text-gray-700">State</label>
                        <input type="text" name="state" id="state" class="w-full border border-gray-300 px-4 py-2 rounded" value="<?php echo htmlspecialchars($result['state']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="block text-gray-700">Address</label>
                        <textarea name="address" id="address" class="w-full border border-gray-300 px-4 py-2 rounded" rows="3" required><?php echo htmlspecialchars($result['address']); ?></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 transition duration-300">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'include/footer.php'; ?>

</body>
</html>
