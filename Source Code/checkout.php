<?php
session_start();
include('admin/includes/config.php');
include('header.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

// If cart empty
if (empty($_SESSION['cart'])) {
    echo "<script>alert('Your cart is empty!'); window.location='cart.php';</script>";
    exit();
}

//  NEW: Update cart quantities if posted (even if cart page not changed)
if (isset($_POST['qty'])) {
    foreach ($_POST['qty'] as $index => $qty) {
        $qty = intval($qty);
        if ($qty > 0 && isset($_SESSION['cart'][$index])) {
            $_SESSION['cart'][$index]['qty'] = $qty;
        }
    }
}

// Customer ID
$c_id = $_SESSION['login']['c_id'];
?>

<div class="all-title-box" 
     style="background: url('images/all-bg-title1.jpg') no-repeat center center; background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Checkout</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="checkout-box-main">
    <div class="container">
        <form action="place-order.php" method="POST">
            <div class="row">
                <!-- Billing Details -->
                <div class="col-md-6 col-sm-12">
                    <h3>Billing Details</h3>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM customer WHERE c_id='$c_id'");
                    $customer = mysqli_fetch_assoc($query);
                    ?>
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $customer['c_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $customer['c_email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="<?php echo $customer['c_mobile']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" required><?php echo $customer['c_address']; ?></textarea>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-6 col-sm-12">
                    <h3>Your Order</h3>
                    <table class="table table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Total (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grand_total = 0;
                            foreach ($_SESSION['cart'] as $item) {
                                $subtotal = $item['price'] * $item['qty'];
                                $grand_total += $subtotal;
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo $item['qty']; ?></td>
                                <td>₹ <?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                            <?php } ?>
                            <tr class="table-info">
                                <th colspan="2" class="text-end">Grand Total</th>
                                <th>₹ <?php echo number_format($grand_total, 2); ?></th>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <label>Payment Method</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="">-- Select Payment --</option>
                            <option value="COD">Cash on Delivery</option>
                            <option value="Online">Online Payment</option>
                        </select>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
