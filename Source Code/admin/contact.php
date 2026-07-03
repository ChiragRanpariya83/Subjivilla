<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');
error_reporting(0);

// -------- PAGINATION SETTINGS --------
$limit = 5; // Number of contact entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// -------- FETCH TOTAL CONTACT RECORDS --------
$result_all = mysqli_query($conn, "SELECT * FROM contact_us");
$total_records = mysqli_num_rows($result_all);
$total_pages = ceil($total_records / $limit);

// -------- FETCH PAGINATED DATA --------
$query = "SELECT * FROM contact_us ORDER BY con_id DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $query);
?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Contact Details</h1>
        <div class="col-sm-12 d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Contact Details</li>
            </ol>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') { ?>
            <div class="alert alert-success">Record deleted successfully!</div>
        <?php } ?>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-comments me-1"></i>
                Contact from Customer (<?php echo $total_records; ?>)
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $serial = $start + 1; // adjust serial for pagination
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $serial++; ?></td>
                                <td><?php echo htmlspecialchars($row['con_fnm']); ?></td>
                                <td><?php echo htmlspecialchars($row['con_email']); ?></td>
                                <td><?php echo htmlspecialchars($row['con_sub']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($row['con_message'])); ?></td>
                                <td>
                                    <a href="contact_view.php?id=<?php echo $row['con_id']; ?>" class="btn btn-sm btn-success">View</a>
                                    <a href="contact_delete.php?id=<?php echo $row['con_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:15px;">
                    <div>
                        <p>Showing <?php echo min($total_records, $start + $limit); ?> of <?php echo $total_records; ?> contact entries</p>
                    </div>
                    <div>
                        <nav>
                            <ul style="list-style:none; display:flex; gap:5px; padding:0;">
                                <?php if ($page > 1): ?>
                                    <li><a href="?page=<?php echo $page - 1; ?>" class="btn btn-sm btn-outline-primary">Previous</a></li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li>
                                        <a href="?page=<?php echo $i; ?>" class="btn btn-sm <?php echo ($page == $i) ? 'btn-primary' : 'btn-outline-primary'; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($page < $total_pages): ?>
                                    <li><a href="?page=<?php echo $page + 1; ?>" class="btn btn-sm btn-outline-primary">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<?php include('includes/footer.php'); ?>
</div>
