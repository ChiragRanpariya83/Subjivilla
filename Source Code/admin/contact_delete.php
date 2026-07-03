<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

include('includes/config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM contact_us WHERE con_id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: contact.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: contact.php");
    exit();
}
?>
