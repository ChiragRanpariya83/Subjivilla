<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

include('includes/config.php');

// Fetch the contact record based on ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM contact_us WHERE con_id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Record not found!");
    }
} else {
    header("Location: contact.php");
    exit();
}
?>

<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">View Contact</h1>
            <ol class="breadcrumb mb-3 col-sm-12 d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="contact.php">Contact</a></li>
                <li class="breadcrumb-item active">View Contact</li>
            </ol>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                    Contact Details
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped align-middle">
                        <tr>
                            <th width="20%">Full Name</th>
                            <td><?php echo htmlspecialchars($row['con_fnm']); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($row['con_email']); ?></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td><?php echo htmlspecialchars($row['con_sub']); ?></td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td><?php echo nl2br(htmlspecialchars($row['con_message'])); ?></td>
                        </tr>
                    </table>

                    <div class="mt-3 text-end">
                        <a href="contact.php" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include('includes/footer.php'); ?>

</div>