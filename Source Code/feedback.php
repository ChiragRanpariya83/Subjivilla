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
                <h2>Feedback</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Feedback</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Feedback Page -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <!-- Feedback Form -->
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>WE VALUE YOUR FEEDBACK</h2>
                    <p>Please share your experience or suggestions with us. Your feedback helps us improve our services.</p>

                    <?php
                    if (isset($_POST['feedback'])) {
                        $name = mysqli_real_escape_string($conn, $_POST['fname']);
                        $email = mysqli_real_escape_string($conn, $_POST['femail']);
                        $rating = (int) $_POST['frating'];
                        $message = mysqli_real_escape_string($conn, $_POST['fmessage']);

                        $query = "INSERT INTO feedback (f_name, f_email, f_rating, f_message) 
                                  VALUES ('$name', '$email', '$rating', '$message')";

                        if (mysqli_query($conn, $query)) {
                            echo "<div class='alert alert-success'> Thank you! Your feedback has been submitted.</div>";
                        } else {
                            echo "<div class='alert alert-danger'> Failed to submit feedback. " . mysqli_error($conn) . "</div>";
                        }
                    }
                    ?>

                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="fname" placeholder="Your Name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="femail" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="frating" required>
                                        <option value="">Rate Us</option>
                                        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                        <option value="4">⭐⭐⭐⭐ Good</option>
                                        <option value="3">⭐⭐⭐ Average</option>
                                        <option value="2">⭐⭐ Poor</option>
                                        <option value="1">⭐ Very Bad</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="fmessage" placeholder="Your Feedback" rows="4" required></textarea>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" name="feedback" type="submit">Submit Feedback</button>
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
<!-- End Feedback Page -->

<?php include('footer.php'); ?>
