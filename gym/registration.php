<?php
error_reporting(0);
require_once('include/config.php');

if(isset($_POST['submit']))
{ 
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$state=$_POST['state'];
$city=$_POST['city'];
$Password=$_POST['password'];
$pass=md5($Password);
$RepeatPassword = $_POST['RepeatPassword'];

// Email id Already Exit

$usermatch=$dbh->prepare("SELECT mobile,email FROM tbluser WHERE (email=:usreml || mobile=:mblenmbr)");
$usermatch->execute(array(':usreml'=>$email,':mblenmbr'=>$mobile)); 
while($row=$usermatch->fetch(PDO::FETCH_ASSOC))
{
$usrdbeml= $row['email'];
$usrdbmble=$row['mobile'];
}


if(empty($fname))
{
  $nameerror="Please Enter First Name";
}

 else if(empty($mobile))
 {
 $mobileerror="Please Enter Mobile No";
 }

 else if(empty($email))
 {
 $emailerror="Please Enter Email";
 }

else if($email==$usrdbeml || $mobile==$usrdbmble)
 {
  $error="Email Id or Mobile Number Already Exists!";
 }
  else if($Password=="" || $RepeatPassword=="")
 {
    
   $error="Password And Confirm Password Not Empty!";
 
 }
 else if($_POST['password'] != $_POST['RepeatPassword'])
 {
  
   $error="Password And Confirm Password Not Matched";
 }

 
else{
$sql="INSERT INTO tbluser (fname,lname,email,mobile,state,city,password) Values(:fname,:lname,:email,:mobile,:state,:city,:Password)";

$query = $dbh -> prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':state',$state,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':Password',$pass,PDO::PARAM_STR);

$query -> execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId>0)
{
echo "<script>alert('Registration successfull. Please login');</script>";
echo "<script> window.location.href='login.php';</script>";
}
else 
{
$error ="Registration Not successfully";
 }
}
 }
 
 ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Gym Management System</title>
	<meta charset="UTF-8">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/nice-select.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>	
	<!-- bootstrap     -->
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
		
        .header-info {
            display: inli;
            align-items: left;
            margin-left: 1rem;
        }
        .header-info i {
            margin-right: 0.5rem;
        }
    </style>
	<link rel="stylesheet" href="css/style.css"/>

</head>
<body>
	<!-- Page Preloder -->
	

	<header class="bg-indigo-600 text-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Move the logo (GYM MS) to the right -->
            <div class="flex-1 text-left">
                <a href="index.php" class="text-2xl font-bold">
                    GYM MS
                    <small class="block text-sm">Gym Management System</small>
                </a>
            </div>
            <!-- Right-side user info and profile links -->
            <div class="flex items-left">
                <?php if(strlen($_SESSION['uid']) == 0): ?>
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
        <!-- Move nav to the left -->
        <nav class="py-4">
            <ul class="flex space-x-6 justify-start">
                <li><a href="index.php" class="hover:text-gray-200">Home</a></li>
                <li><a href="about.php" class="hover:text-gray-200">About</a></li>
                <li><a href="contact.php" class="hover:text-gray-200">Contact</a></li>
                <?php if(strlen($_SESSION['uid']) == 0): ?>
                    <li><a href="./admin/index.php" class="hover:text-gray-200">Admin</a></li>
                <?php else: ?>
                    <li><a href="booking-history.php" class="hover:text-gray-200">Booking History</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

	<!-- Header Section end -->
	                                                                              
	<!-- Page top Section -->
	<section class="relative bg-cover bg-center py-32" style="background-image: url('https://hyperli.com/cdn/shop/products/FT_20Fitness_20Gym.jpg?v=1698689632');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-white mb-4">Registration</h1>
            </div>
        </div>
    </section>
	<!-- Page top Section end -->

	<!-- Contact Section -->
	<section class="contact-page-section spad overflow-hidden">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <?php if($error){?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Error</p>
                    <p><?php echo htmlentities($error); ?></p>
                </div>
            <?php } 
            else if($succmsg){?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Success</p>
                    <p><?php echo htmlentities($succmsg); ?></p>
                </div>
            <?php }?>
            
            <div class="p-8">
                <h2 class="text-3xl font-bold text-center mb-8">Registration</h2>
                <form class="singup-form contact-form" method="post">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <input type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off" value="<?php echo $fname;?>" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <input type="text" name="lname" id="lname" placeholder="Last Name" autocomplete="off" value="<?php echo $lname;?>" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <input type="email" name="email" id="email" placeholder="Your Email" autocomplete="off" value="<?php echo $email;?>" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <input type="tel" name="mobile" id="mobile" maxlength="10" placeholder="Mobile Number" autocomplete="off" value="<?php echo $mobile;?>" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <input type="text" name="state" id="state" placeholder="Your Province" autocomplete="off" value="<?php echo $state;?>" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <input type="text" name="city" id="city" placeholder="Your City" autocomplete="off" value="<?php echo $city;?>" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <input type="password" name="RepeatPassword" id="RepeatPassword" placeholder="Confirm Password" autocomplete="off" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="mt-8 text-center">
                        <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                            Register Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
	<!-- Trainers Section end -->



	<!-- Footer Section -->
<?php include 'include/footer.php'; ?>
	<!-- Footer Section end -->
	
	<div class="back-to-top" style="background-color:blue;"><img src="img/icons/up-arrow.png" alt=""></div>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
 <style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #dd3d36;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #5cb85c;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>