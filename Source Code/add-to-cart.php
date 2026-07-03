<?php
session_start();
include('admin/includes/config.php');

if(!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

if(isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = mysqli_query($conn, "SELECT * FROM product WHERE p_id='$id'");
    $product = mysqli_fetch_assoc($result);

    $item = array(
        'id' => $product['p_id'],
        'image' => $product['p_photo'],
        'price' => $product['p_price'],
        'name' => $product['p_name'],
        'qty' => 1 // default quantity 1
    );

    if(isset($_SESSION['cart'])) {
        $ids = array_column($_SESSION['cart'], 'id');
        if(in_array($id, $ids)) {
            $_SESSION['productadded'] = "Product Already added";
        } else {
            $_SESSION['cart'][] = $item;
            $_SESSION['productaddedsuccess'] = "Product Added Successfully";
        }
    } else {
        $_SESSION['cart'][] = $item;
        $_SESSION['productaddedsuccess'] = "Product Added Successfully";
    }

    header("location:shop.php");
    exit();
}

// Remove product
if(isset($_GET['action1']) && $_GET['action1'] == 'remove' && isset($_GET['id'])) {
    foreach($_SESSION['cart'] as $key => $val) {
        if($val['id'] == $_GET['id']) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['remove_product'] = "Your Product removed...";
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
    header("location:cart.php");
    exit();
}
?>
