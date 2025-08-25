<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu</title>
	<link rel="stylesheet" type="text/css" 
          href="css/style.css?<?php echo time(); ?>">
</head>
<body>
<nav class="navbar">
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Information</a>
                <div class="dropdown-content">
                    <a href="aboutus.php">About Us</a>
                    <a href="vision.php">Our Vision</a>
                    <a href="campaigns.php">Campaigns</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Popular Apps</a>
                <div class="dropdown-content">
                    <a href="apps.php">Social Media Apps</a>
                    <a href="safety.php">Safety Tips</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Guidelines</a>
                <div class="dropdown-content">
                    <a href="tips.php">Parents Tips</a>
                    <a href="guidelines.php">Legislation and Guidance</a>
                </div>
            </li>
            <li><a href="livestreaming.php">Livestreaming</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Account</a>
                <div class="dropdown-content">
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                    <a href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
</body>
</html>

