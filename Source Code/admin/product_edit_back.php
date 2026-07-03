<?php
session_start();
include ('includes/config.php');

$pnm    = $_POST["pname"];
$pkg    = $_POST["pkg"];
$pprice = $_POST["pprice"];
$pcat   = $_POST["pcat"];
$pid    = $_POST['pid'];

$_SESSION['error'] = array();

if (empty($pnm)) {
    $_SESSION['error']['pname']="Please Enter Product Name";
}
if (empty($pkg)) {
    $_SESSION['error']['pkg']="Please Enter Kg";
}
if (empty($pprice)) {
    $_SESSION['error']['pprice']="Please Enter Price";
}

if (!empty($_SESSION['error'])) {
    header("location:product_edit_process.php?id=$pid");
    exit();
}

// Handle file upload
if (isset($_FILES['pfile']) && $_FILES['pfile']['error'] == 0) {
    $target_dir = "../images/";
    $filename = time() . "_" . basename($_FILES["pfile"]["name"]);
    $target_file = $target_dir . $filename;
    move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file);

    $query= "UPDATE product SET 
                p_name='$pnm', 
                p_photo='$filename', 
                p_price='$pprice', 
                p_detail='$pkg', 
                p_cat='$pcat' 
             WHERE p_id='$pid'";
} else {
    $query= "UPDATE product SET 
                p_name='$pnm', 
                p_price='$pprice', 
                p_detail='$pkg', 
                p_cat='$pcat' 
             WHERE p_id='$pid'";
}

mysqli_query($conn, $query);

$_SESSION['Success']="Product Successfully Updated";
header("location:product_edit_process.php?id=$pid");
exit();
?>
