<?php
session_start();
include('admin/includes/config.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

$c_id = $_SESSION['login']['c_id'];
$customer_query = mysqli_query($conn, "SELECT * FROM customer WHERE c_id='$c_id'");
$customer = mysqli_fetch_assoc($customer_query);

// Fetch last order datetime
$last_order_query = mysqli_query($conn, "SELECT order_time FROM manage_order_details WHERE customer_id='$c_id' ORDER BY order_time DESC LIMIT 1");
$last_order_row = mysqli_fetch_assoc($last_order_query);
$last_order_time = $last_order_row ? date("d-m-Y H:i:s", strtotime($last_order_row['order_time'])) : "No orders";

include('header.php');
?>

<div class="all-title-box" 
     style="background: url('images/all-bg-title1.jpg') no-repeat center center; background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>View Status</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="checkout.php">Checkout</a></li>
                    <li class="breadcrumb-item active">View Status</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4 mb-5">
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php } ?>

    <!-- Customer Info -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Customer Details</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>Name</th><td><?php echo htmlspecialchars($customer['c_username']); ?></td></tr>
                <tr><th>Email</th><td><?php echo htmlspecialchars($customer['c_email']); ?></td></tr>
                <tr><th>Phone</th><td><?php echo htmlspecialchars($customer['c_phone']); ?></td></tr>
                <tr><th>Address</th><td><?php echo htmlspecialchars($customer['c_address']); ?></td></tr>
                <tr><th>Last Order</th><td><?php echo $last_order_time; ?></td></tr>
                <tr><th>Status</th><td><span class="badge bg-info"><?php echo $customer['c_status']; ?></span></td></tr>
            </table>
        </div>
    </div>

    <!-- Orders List -->
    <?php
    $orders_query = mysqli_query($conn, "
        SELECT DISTINCT order_batch, order_time, payment_mode
        FROM manage_order_details
        WHERE customer_id = '$c_id'
        ORDER BY order_time DESC
    ");

    if (mysqli_num_rows($orders_query) > 0) {
        while ($order = mysqli_fetch_assoc($orders_query)) {
            $batch = $order['order_batch'];
            $order_time = date("d-m-Y H:i:s", strtotime($order['order_time']));
            $payment_mode = htmlspecialchars($order['payment_mode']);
    ?>
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            Order Batch: <?php echo $batch; ?> | Date: <?php echo $order_time; ?> | Payment: <?php echo $payment_mode; ?>
        </div>
        <div class="card-body">
            <?php
            $products_query = mysqli_query($conn, "
                SELECT m.*, p.p_name, p.p_price, p.p_photo
                FROM manage_order_details m
                LEFT JOIN product p ON m.product_id = p.p_id
                WHERE m.customer_id='$c_id' AND m.order_batch='$batch'
            ");
            ?>
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr><th>Image</th><th>Product Name</th><th>Price (₹)</th><th>Qty</th><th>Total (₹)</th></tr>
                </thead>
                <tbody>
                <?php
                $grand_total = 0;
                while ($row = mysqli_fetch_assoc($products_query)) {
                    $total = $row['p_price'] * $row['order_qty'];
                    $grand_total += $total;
                ?>
                    <tr>
                        <td><img src="images/<?php echo $row['p_photo']; ?>" width="60"></td>
                        <td><?php echo htmlspecialchars($row['p_name']); ?></td>
                        <td>₹ <?php echo number_format($row['p_price'], 2); ?></td>
                        <td><?php echo $row['order_qty']; ?></td>
                        <td>₹ <?php echo number_format($total, 2); ?></td>
                    </tr>
                <?php } ?>
                    <tr class="table-info">
                        <th colspan="4" class="text-end">Grand Total</th>
                        <th>₹ <?php echo number_format($grand_total, 2); ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php } } else { ?>
        <div class="alert alert-info">No orders found</div>
    <?php } ?>
</div>

<?php include('footer.php'); ?>


