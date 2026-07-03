<?php
session_start();
include('includes/config.php');

if (isset($_POST['Submit'])) {
    $pnm   = mysqli_real_escape_string($conn, $_POST["pname"]);
    $pkg   = mysqli_real_escape_string($conn, $_POST["pkg"]);
    $pprice = mysqli_real_escape_string($conn, $_POST["pprice"]);
    $pcat  = mysqli_real_escape_string($conn, $_POST["pcat"]);

    $_SESSION['error'] = array();

    // Validation
    if (empty($pnm)) {
        $_SESSION['error']['pname'] = "Please Enter Product Name";
    }
    if (empty($_FILES['pfile']['name'])) {
        $_SESSION['error']['pfile'] = "Please Select Photo";
    }
    if (empty($pkg)) {
        $_SESSION['error']['pkg'] = "Please Enter Kg";
    }
    if (empty($pprice)) {
        $_SESSION['error']['pprice'] = "Please Enter Price";
    }

    if (!empty($_SESSION['error'])) {
        header("location:product_add.php");
        exit();
    }

    // Check duplicate product
    $qry = "SELECT p_name FROM product WHERE p_name='$pnm'";
    $res = mysqli_query($conn, $qry);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION['perror'] = "Product Already Added";
        header("location:product_add.php");
        exit();
    }

    // File Upload
    $target_dir = "../images/";
    $file_name = time() . "_" . basename($_FILES["pfile"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file)) {
        // Insert product
        $query = "INSERT INTO product(p_name, p_photo, p_price, p_detail, p_cat) 
                  VALUES('$pnm', '$file_name', '$pprice', '$pkg', '$pcat')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['Success'] = "Product Successfully Added";
        } else {
            $_SESSION['perror'] = "Database Error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['perror'] = "File Upload Failed";
    }

    header("location:product_add.php");
} else {
    header("location:product_add.php");
}
?>
