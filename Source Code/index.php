<?php 
include('header.php'); 
include('admin/includes/config.php');

// Fetch latest products (limit 12)
$result = mysqli_query($conn, "SELECT * FROM product LIMIT 12");

// Fetch all categories dynamically
$cat_result = mysqli_query($conn, "SELECT * FROM categories");

// Fetch all offer images
$offers_res = mysqli_query($conn, "SELECT * FROM manage_offers");
?>

<!-- Start Categories -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            <?php while($cat = mysqli_fetch_assoc($cat_result)) { ?>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="admin/categories/<?php echo $cat['cat_image']; ?>" alt="<?php echo $cat['cat_name']; ?>" />
                        <a class="btn hvr-hover" href="shop.php?cat_id=<?php echo $cat['id']; ?>">
                            <?php echo $cat['cat_name']; ?>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Categories -->

<!-- Start Offers -->
<div class="box-add-products">
    <div class="container">
        <div class="row">
            <?php while($offer = mysqli_fetch_assoc($offers_res)) { ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="offer-box-products">
                        <img class="img-fluid" src="admin/homeimages/<?php echo $offer['image']; ?>" alt="Offer" />
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Offers -->

<!-- Start Products -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Fruits & Vegetables</h1>
                    <p>We are developing green house technology that promotes vegetable plants growth organically that will help for us.</p>
                </div>
            </div>
        </div>

        <div class="row special-list">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-3 col-md-6 special-grid best-seller">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <img src="admin/../images/<?php echo $row['p_photo']; ?>" class="img-fluid" alt="<?php echo $row['p_name']; ?>">
                        </div>
                        <div class="why-text">
                            <h4><?php echo $row['p_name']; ?></h4>
                            <h5>₹<?php echo $row['p_price']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php } ?>  
        </div>
    </div>
</div>
<!-- End Products -->

<!-- Start Blog -->
<div class="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Vegetables</h1>
                    <p>We always follow organic methods because it's good & beneficial for health.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $blogs_res = mysqli_query($conn, "SELECT * FROM blogs ORDER BY id ASC");
            while ($row = mysqli_fetch_assoc($blogs_res)) {
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="admin/blogs/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3><?php echo $row['title']; ?></h3>
                                <p><?php echo $row['description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Blog -->

<?php include('footer.php'); ?>
