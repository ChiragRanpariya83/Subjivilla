<?php 
    session_start();
    error_reporting(0);
    include ('includes/config.php');

    if (isset($_SESSION['login'])) {

    }
    else
    {
        header("location:login.php");
    }

    $result = mysqli_query($conn, "select * FROM product");
    $total = mysqli_num_rows($result);

    $veg_result = mysqli_query($conn, "select p_cat FROM product WHERE p_cat='vegetables'");
    $veg_total = mysqli_num_rows($veg_result);

    $frt_result = mysqli_query($conn, "select p_cat FROM product WHERE p_cat='fruits'");
    $frt_total = mysqli_num_rows($frt_result);

    $dry_result = mysqli_query($conn, "select p_cat FROM product WHERE p_cat='dry fruits'");
    $dry_total = mysqli_num_rows($dry_result);

    $contact_result = mysqli_query($conn, "select * FROM contact_us");
    $contact_total = mysqli_num_rows($contact_result);

    $feedback_result = mysqli_query($conn, "select * FROM feedback");
    $feedback_total = mysqli_num_rows($feedback_result);

    $vieworder_result = mysqli_query($conn, "select * FROM customer");
    $vieworder_total = mysqli_num_rows($vieworder_result);

?>
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Grocery Items</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                            <?php   
                                                echo "<div style='font-size: 22px; font-weight: 700;'>".$total."</div>"; 
                                            ?>
                                            <i class="fas fa-shopping-cart fa-2x" style="opacity: 0.8;"></i>
                                    </div>
                                    <a href="product_add.php" class="small-box-footer" style="color: black;">Manage <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Vegetables</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <?php   
                                            echo "<div style='font-size: 22px; font-weight: 700;'>".$veg_total."</div>"; 
                                        ?>
                                        <i class="fas fa-leaf fa-2x"></i>   
                                    </div>
                                    <a href="product_add.php" class="small-box-footer" style="color: black;">Manage <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Fruits</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <?php   
                                            echo "<div style='font-size: 22px; font-weight: 700;'>".$frt_total."</div>"; 
                                        ?>
                                        <i class="fas fa-apple-alt fa-2x"></i>
                                    </div>
                                    <a href="product_add.php" class="small-box-footer" style="color: black;">Manage <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Dry Fruits</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                            <?php   
                                                echo "<div style='font-size: 22px; font-weight: 700;'>".$dry_total."</div>"; 
                                            ?>
                                            <i class="fas fa-seedling fa-2x"></i> 
                                    </div>
                                    <a href="product_add.php" class="small-box-footer" style="color: black;">Manage <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Contact</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <?php   
                                            echo "<div style='font-size: 22px; font-weight: 700;'>".$contact_total."</div>"; 
                                        ?>
                                        <i class="fas fa-mobile-alt fa-2x"></i>
                                    </div>
                                    <a href="contact.php" class="small-box-footer" style="color: black;">Manage <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Feedback</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <?php   
                                            echo "<div style='font-size: 22px; font-weight: 700;'>".$feedback_total."</div>"; 
                                        ?>
                                        <i class="fas fa-users fa-2x"></i> 
                                    </div>
                                    <a href="feedback.php" class="small-box-footer" style="color: black;">Manage <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">View Order</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <?php   
                                            echo "<div style='font-size: 22px; font-weight: 700;'>".$vieworder_total."</div>"; 
                                        ?>
                                        <i class="fas fa-boxes"></i> 
                                    </div>
                                    <a href="customer.php" class="small-box-footer" style="color: black;">Manage <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
<?php include('includes/footer.php'); ?>