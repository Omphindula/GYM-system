<?php
session_start();
error_reporting(0);
include 'include/config.php';
$uid = $_SESSION['uid'];

if (isset($_POST['submit'])) {
    $pid = $_POST['pid'];
    $sql = "INSERT INTO tblbooking (package_id, userid) VALUES (:pid, :uid)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Package has been booked.');</script>";
    echo "<script>window.location.href='booking-history.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System</title>
    <meta name="description" content="Gym Management System">
    <meta name="keywords" content="gym, management, fitness">
    
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .pricing-item {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .pricing-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
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

    <!-- Hero Section -->
<section class="relative bg-cover bg-center py-32" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLSAM2YNfOQ9r3swIGFzXxyRcjMBeWM5o1Ew&s');">
        <div class=" inset-0 bg-black opacity-50absolute"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-white mb-4">Welcome to Our Gym</h1>
                <p class="text-xl text-white">Transform Your Body, Transform Your Life</p>
            </div>
        </div>
    </section>    

    <!-- Pricing Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Choose Your Plan</h2>
                <p class="text-xl text-gray-600">Find the perfect package for your fitness journey</p>
            </div>
            <div class="flex flex-wrap -mx-4 justify-center">
                <?php
                $sql = "SELECT id, titlename, PackageDuratiobn, Price, Description FROM tbladdpackage";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                ?>
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="pricing-item bg-white rounded-lg overflow-hidden shadow-lg">
                        <div class="bg-indigo-600 text-white text-center py-6">
                            <h3 class="text-2xl font-bold"><?php echo htmlspecialchars($result->titlename); ?></h3>
                        </div>
                        <div class="p-8">
                            <div class="text-center mb-6">
                                <span class="text-4xl font-bold">R<?php echo htmlspecialchars($result->Price); ?></span>
                                <span class="text-gray-600">/<?php echo htmlspecialchars($result->PackageDuratiobn); ?></span>
                            </div>
                            <ul class="text-gray-700 mb-6">
                                <?php
                                $description = explode("\n", $result->Description);
                                foreach ($description as $item) {
                                    echo "<li class='mb-2'><i class='fas fa-check text-green-500 mr-2'></i>" . htmlspecialchars(trim($item)) . "</li>";
                                }
                                ?>
                            </ul>
                            <?php if (strlen($_SESSION['uid']) == 0): ?>
                                <a href="login.php" class="block text-center bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 transition duration-300">Sign Up Now</a>
                            <?php else: ?>
                                <form method="post">
                                    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($result->id); ?>">
                                    <button type="submit" name="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 transition duration-300" onclick="return confirm('Do you really want to book this package?');">
                                        Book Now
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-gray-200 py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Why Choose Us</h2>
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="text-center">
                        <i class="fas fa-dumbbell text-5xl text-indigo-600 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">State-of-the-art Equipment</h3>
                        <p class="text-gray-600">Access to the latest fitness technology and equipment</p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="text-center">
                        <i class="fas fa-users text-5xl text-indigo-600 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">Expert Trainers</h3>
                        <p class="text-gray-600">Personalized guidance from certified fitness professionals</p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="text-center">
                        <i class="fas fa-clock text-5xl text-indigo-600 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">Flexible Hours</h3>
                        <p class="text-gray-600">Open 24/7 to fit your busy schedule</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- <style>#toggleChatbot{background-color: aqua;} !impo</style> -->


<script defer>
    const append = (tag, props, parent = document.body) => parent.appendChild(Object.assign(document.createElement(tag), props));
    
    ['https://ai.nextgensell.com/static/style.css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css']
    .forEach(href => append('link', { rel: 'stylesheet', href: href }, document.head  ));
    
    setTimeout(() => append('button', { id: 'toggleChatbot', innerHTML: '<i class="fas fa-comment-dots"></i>' }), 1950);
    
    append('div', { id: 'chatbot', innerHTML: '<iframe src="https://ai.nextgensell.com/chatbot?param=0&param2=1&accessToken=$udwnurery43gfbhfbuy4" style="width:100%;height:100%;border:none;"  allow="microphone" ></iframe>' });
    
    document.addEventListener('click', e => {
        if (e.target.id === 'toggleChatbot') {
            document.getElementById('chatbot').classList.toggle('chatbot-visible');
        }
    });
</script>
    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Add any custom JavaScript here
    </script>
</body>
</html>