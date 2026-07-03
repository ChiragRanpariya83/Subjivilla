<?php 
include('header.php'); 
include('admin/includes/config.php'); 

// Fetch latest about info
$res = mysqli_query($conn, "SELECT * FROM about_us ORDER BY about_id DESC LIMIT 1");
$about = mysqli_fetch_assoc($res);
?>

<div class="all-title-box" 
     style="background: url('images/all-bg-title1.jpg') no-repeat center center; background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>ABOUT US</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">ABOUT US</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Start About Page  -->
<div class="about-box-main">
    <div class="container">
        <div class="row">
        <div class="col-lg-6">
    <div class="banner-frame">
        <?php if (!empty($about['image'])) { ?>
            <img class="img-fluid" src="<?php echo 'admin/'.$about['image']; ?>" alt="About Us"/>
        <?php } else { ?>
            <img class="img-fluid" src="images/default.jpg" alt="About Us"/>
        <?php } ?>
    </div>
</div>

            <div class="col-lg-6">
                <h2 class="noo-sh-title-top"><?php echo $about['title']; ?> <span><?php echo $about['subtitle']; ?></span></h2>
                <p><?php echo $about['description']; ?></p>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-sm-6 col-lg-4">
                <div class="service-block-inner">
                    <h3>We are Trusted</h3>
                    <p><?php echo $about['trusted']; ?></p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="service-block-inner">
                    <h3>We are Professional</h3>
                    <p><?php echo $about['professional']; ?></p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="service-block-inner">
                    <h3>We are Expert</h3>
                    <p><?php echo $about['expert']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About Page -->

<?php include('footer.php'); ?>
