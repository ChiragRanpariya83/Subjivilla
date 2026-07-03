<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);

// Database config
include('admin/includes/config.php');

// Fetch site settings (logo, site name)
$settings_res = mysqli_query($conn, "SELECT * FROM site_settings LIMIT 1");
$settings = mysqli_fetch_assoc($settings_res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SubjiVilla - Aapka Apna Store</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">

    <!-- Custom Style -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <!-- Top Header Section -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Links -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="our-link">
                        <ul>
                            <li><a href="my-account.php"><i class="fa fa-user s_color"></i> My Account</a></li>
                            <li><a href="contact-us.php"><i class="fas fa-location-arrow"></i> Our Location</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Right Login/Register Links -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="login-box">
                        <?php if (!isset($_SESSION['login'])) { ?>
                            <a href="register.php">Register</a>
                            <a href="login.php">Login</a>
                        <?php } else { ?>
                            <a href="logout.php">Logout</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Header Section -->

    <!-- Main Header -->
    <header class="main-header">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">

                <!-- Logo -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                        aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h1>
                        <a class="navbar-brand" href="index.php">
                            <?php if (!empty($settings['site_logo'])) { ?>
                                <img src="admin/<?php echo $settings['site_logo']; ?>" class="logo" alt="Site Logo" height="50">
                            <?php } ?>
                            <b><?php echo $settings['site_name']; ?></b>
                        </a>
                    </h1>
                </div>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
                    </ul>
                </div>

                <!-- Cart Icon with Count -->
                <div class="attr-nav">
                    <ul>
                        <li class="side-menu">
                            <a href="cart.php">
                                <i class="fa fa-shopping-bag"></i>
                                <b>
                                    <p>
                                        My Cart
                                        <?php if (!empty($_SESSION['cart'])) { ?>
                                            <span class="cart-count">(
                                                <span class="text-primary"><?php echo count($_SESSION['cart']); ?></span>
                                                )</span>
                                        <?php } ?>
                                    </p>
                                </b>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>
</body>

</html>
<!-- End Main Header -->