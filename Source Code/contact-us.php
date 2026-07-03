<?php 
session_start();
include('admin/includes/config.php');
include('header.php');
?>

<!-- Start All Title Box -->
<div class="all-title-box" 
     style="background: url('images/all-bg-title1.jpg') no-repeat center center; background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Contact Us</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active"> Contact Us </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Contact Us  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>GET IN TOUCH</h2>
                    <p>You can contact us about any query related to anything by just filling this contact form. We will respond as soon as possible.</p>

                    <?php
                    if (isset($_POST['contact'])) {
                        $name = mysqli_real_escape_string($conn, $_POST['yourname']);
                        $email = mysqli_real_escape_string($conn, $_POST['yourmail']);
                        $sub = mysqli_real_escape_string($conn, $_POST['yoursub']);
                        $msg = mysqli_real_escape_string($conn, $_POST['yourmsg']);

                        $query = "INSERT INTO contact_us (con_fnm, con_email, con_sub, con_message) 
                                  VALUES ('$name','$email', '$sub', '$msg')";

                        if (mysqli_query($conn, $query)) {
                            echo "<div class='alert alert-success'> Your Message has been sent successfully. Thank You!</div>";
                        } else {
                            echo "<div class='alert alert-danger'> Failed to send message. " . mysqli_error($conn) . "</div>";
                        }
                    }
                    ?>

                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="yourname" placeholder="Your Name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" placeholder="Your Email" class="form-control" name="yourmail" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="yoursub" placeholder="Subject" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="yourmsg" placeholder="Your Message" rows="4" required></textarea>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" name="contact" type="submit">Send Message</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4 col-sm-12">
                <div class="contact-info-left">
                    <h2>CONTACT INFO</h2>
                    <ul>
                        <li>
                            <p><i class="fas fa-map-marker-alt"></i> Address: <?php echo $settings['contact_address']; ?> </p>
                        </li>
                        <li>
                            <p><i class="fas fa-phone-square"></i> Phone:
                                <a href="tel:<?php echo $settings['contact_phone']; ?>"><?php echo $settings['contact_phone']; ?></a>
                            </p>
                        </li>
                        <li>
                            <p><i class="fas fa-envelope"></i> Email:
                                <a href="mailto:<?php echo $settings['contact_email']; ?>"><?php echo $settings['contact_email']; ?></a>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Contact Us -->

<?php include('footer.php'); ?>
