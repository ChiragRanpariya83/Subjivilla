<?php
session_start();
error_reporting(0);
include('header.php');
include('admin/includes/config.php');

if (isset($_GET['cat'])) {
    $cat = $_GET['cat'];;
    $query = "SELECT * FROM product WHERE p_cat='$cat'";
    $result = mysqli_query($conn, $query);
} else {
    $result = mysqli_query($conn, "select * FROM product");
}

$result1 = mysqli_query($conn, "select * FROM product");
$total = mysqli_num_rows($result1);
$veg_result = mysqli_query($conn, "select p_cat FROM product WHERE p_cat='vegetables'");
$veg_total = mysqli_num_rows($veg_result);

$frt_result = mysqli_query($conn, "select p_cat FROM product WHERE p_cat='fruits'");
$frt_total = mysqli_num_rows($frt_result);

$dry_result = mysqli_query($conn, "select p_cat FROM product WHERE p_cat='dry fruits'");
$dry_total = mysqli_num_rows($dry_result);
?>

<!-- Start All Title Box -->
<div class="all-title-box"
    style="background: url('images/all-bg-title1.jpg') no-repeat center center; background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Shop</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Page  -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                <div style="background: #f5f5f5; font-size: 20px; color: green; font-weight: 600;">
                    <?php
                        echo $_SESSION['productadded'];
                        unset($_SESSION['productadded']);
                    ?>
                    <?php 
                        echo $_SESSION['productaddedsuccess'];
                        unset($_SESSION['productaddedsuccess']); 
                    ?>
                </div>
                <div class="right-product-box">
                    <div class="product-categorie-box">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                <div class="row mycatdata">
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <img src="images/<?php echo $row['p_photo'] ?>" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <a class="cart" href="add-to-cart.php?id=<?php echo $row['p_id']; ?>&action=1">Add to Cart</a>
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                    <h4><?php echo $row['p_name'] ?></h4>
                                                    <h5> ₹<?php echo $row['p_price'] ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categori">
                    <div class="filter-sidebar-left">
                        <div class="title-left">
                            <h3>Categories</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">

                            <div class="list-group-collapse sub-men">
                                <a class="list-group-item list-group-item-action" href="shop.php?all">All
                                    <small class="text-muted">(<?php echo $total; ?>)</small>
                                    <a class="list-group-item list-group-item-action" href="shop.php?cat=vegetables">Vegetables
                                        <small class="text-muted">(<?php echo $veg_total; ?>)</small>
                                    </a>
                            </div>
                            <a href="shop.php?cat=fruits" class="list-group-item list-group-item-action"> Fruits <small class="text-muted">(<?php echo $frt_total; ?>) </small></a>
                            <a href="shop.php?cat=dry fruits" class="list-group-item list-group-item-action"> Dry Fruits <small class="text-muted">(<?php echo $dry_total; ?>) </small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shop Page -->

<?php include('footer.php'); ?>