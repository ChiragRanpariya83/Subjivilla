<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

// -------- PAGINATION SETTINGS --------
$limit = 10; // Number of entries per page
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $limit;

// -------- FETCH TOTAL PRODUCTS --------
$result_all = mysqli_query($conn, "SELECT * FROM product");
$total_records = mysqli_num_rows($result_all);
$total_pages = ceil($total_records / $limit);

// -------- FETCH PAGINATED DATA --------
$result = mysqli_query($conn, "SELECT * FROM product LIMIT $start, $limit");

// -------- CATEGORY COUNTS --------
$veg_total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE p_cat='vegetables'"));
$frt_total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE p_cat='fruits'"));
$dry_total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE p_cat='dryfruits'"));
?>

<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>

        <!-- Add New Button aligned to the right -->    
        <div class="d-flex justify-content-end mb-3">
            <a href="product_add_back.php" class="btn btn-primary btn-sm">Add New</a>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-table me-1"></i>
                Total Products (<?php echo $total_records; ?>)
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Category</th>
                            <th>KG</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['p_name']); ?></td>
                            <td><img width="50" height="50" src="../images/<?php echo htmlspecialchars($row['p_photo']); ?>"></td>
                            <td><?php echo htmlspecialchars($row['p_cat']); ?></td>
                            <td><?php echo htmlspecialchars($row['p_detail']); ?></td>
                            <td><?php echo htmlspecialchars($row['p_price']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p>Showing 
                            <?php echo min($total_records, $start + $limit); ?> 
                            of <?php echo $total_records; ?> entries
                        </p>
                    </div>

                    <div>
                        <nav>
                            <ul style="list-style:none; display:flex; gap:5px; padding:0;">
                                <?php if ($page > 1): ?>
                                    <li><a href="?page=<?php echo $page - 1; ?>" class="btn btn-sm btn-outline-primary">Previous</a></li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li>
                                        <a href="?page=<?php echo $i; ?>" 
                                           class="btn btn-sm <?php echo ($page == $i) ? 'btn-primary' : 'btn-outline-primary'; ?>">
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
