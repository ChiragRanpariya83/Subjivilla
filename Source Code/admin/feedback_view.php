<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');

$id = intval($_GET['id']);
$query = "SELECT * FROM feedback WHERE f_id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">View Feedback</h1>
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-eye me-1"></i>
                    Feedback Details
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($row['f_name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['f_email']); ?></p>
                    <p><strong>Rating:</strong> <?php echo str_repeat("⭐", $row['f_rating']); ?></p>
                    <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($row['f_message'])); ?></p>
                    <p><strong>Date:</strong> <?php echo $row['created_at']; ?></p>
                    <a href="feedback.php" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </main>
<?php include('includes/footer.php'); ?>
