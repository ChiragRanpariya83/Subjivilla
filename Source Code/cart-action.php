<?php 
//session_start();
include ('admin/includes/config.php');
include('header.php');

$c_id = $_SESSION['login']['c_id'];
?>
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Thank You For Shopping</h2>
            </div>
        </div>
    </div>
</div>

<?php
if (!empty($_POST['productid']) && !empty($_POST['qty'])) {
    // Loop through all product IDs from POST
    foreach ($_POST['productid'] as $index => $product_id) {
        $qty = (int) $_POST['qty'][$index]; // Match qty with index

        // Prevent inserting invalid qty
        if ($product_id > 0 && $qty > 0) {
            $query = "INSERT INTO `manage_order_details`
                        (`customer_id`, `product_id`, `order_qty`) 
                      VALUES ($c_id, $product_id, $qty)";
            mysqli_query($conn, $query);
        }
    }
}

// Clear cart after order
unset($_SESSION['cart']);
?>

<?php include('footer.php'); ?>
