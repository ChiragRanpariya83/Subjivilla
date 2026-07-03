<?php
session_start();
include('includes/config.php');

if(!isset($_GET['id']) || empty($_GET['id'])){
    $_SESSION['delete_msg'] = "Invalid Product ID.";
    $_SESSION['delete_status'] = "error";
    header("location:product_delete.php");
    exit();
}

$id = intval($_GET['id']); // Convert to integer for safety

// Delete product
$delete = mysqli_query($conn, "DELETE FROM product WHERE p_id = '$id'");

if($delete){
    $_SESSION['delete_msg'] = "Product successfully deleted.";
    $_SESSION['delete_status'] = "success";
} else {
    $_SESSION['delete_msg'] = "Error deleting product: " . mysqli_error($conn);
    $_SESSION['delete_status'] = "error";
}

header("location:product_delete.php");
exit();
?>
