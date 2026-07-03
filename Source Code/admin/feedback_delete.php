<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

include('includes/config.php');

$id = intval($_GET['id']);
$query = "DELETE FROM feedback WHERE f_id = $id";
if (mysqli_query($conn, $query)) {
    $_SESSION['msg'] = "Feedback deleted successfully.";
} else {
    $_SESSION['msg'] = "Error deleting feedback.";
}

header("location:feedback.php");
exit();
