<?php
session_start();
include('admin/includes/config.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

$c_id = $_SESSION['login']['c_id'];

if (isset($_POST['place_order'])) {

    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile   = mysqli_real_escape_string($conn, $_POST['mobile']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);
    $payment  = mysqli_real_escape_string($conn, $_POST['payment_method']);

    $order_time = date("Y-m-d H:i:s");
    $order_batch = time() . rand(100, 999); // unique batch

    // Insert each product into manage_order_details
    if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $pid = intval($item['id']);
            $qty = intval($item['qty']);
            $price = floatval($item['price']);

            $insert = "INSERT INTO manage_order_details 
                (customer_id, product_id, order_qty, order_price, order_time, payment_mode, order_batch) 
                VALUES ('$c_id', '$pid', '$qty', '$price', '$order_time', '$payment', '$order_batch')";
            mysqli_query($conn, $insert);
        }
    }

    // Update customer details
    $update = "UPDATE customer 
               SET c_username='$name', c_email='$email', c_phone='$mobile', c_address='$address', c_order='$order_batch'
               WHERE c_id='$c_id'";
    mysqli_query($conn, $update);

    $_SESSION['success'] = "Your order has been placed successfully!";
    unset($_SESSION['cart']);

    header("location:view-order-status.php");
    exit();
}
?>
