<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

$id = $_GET['id'];

// Delete image file
$res = mysqli_query($conn, "SELECT * FROM categories WHERE id='$id'");
$row = mysqli_fetch_assoc($res);
if ($row['cat_image'] != "" && file_exists('categories/'.$row['cat_image'])) {
    unlink('categories/'.$row['cat_image']);
}

// Delete from database
mysqli_query($conn, "DELETE FROM categories WHERE id='$id'");
header("location:categories.php");
exit;
