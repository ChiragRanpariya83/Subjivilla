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
$limit = 10; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// -------- FETCH TOTAL PRODUCTS --------
$result_all = mysqli_query($conn, "SELECT * FROM product");
$total_records = mysqli_num_rows($result_all);
$total_pages = ceil($total_records / $limit);

// -------- FETCH PAGINATED DATA --------
$result = mysqli_query($conn, "SELECT * FROM product LIMIT $start, $limit");
?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Delete Items</h1>
        <div class="col-sm-12 d-flex justify-content-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Delete Items</li>
            </ol>
        </div>

        <!-- Message Display -->
        <?php if(isset($_SESSION['delete_msg'])): ?>
            <div class="alert alert-<?php echo $_SESSION['delete_status'] == 'success' ? 'success' : 'danger'; ?> mt-2">
                <?php 
                    echo $_SESSION['delete_msg']; 
                    unset($_SESSION['delete_msg']);
                    unset($_SESSION['delete_status']);
                ?>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-table me-1"></i>
                Delete Products (<?php echo $total_records; ?>)
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Category</th>
                            <th>Delete Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) { ?> 
                        <tr>
                            <td><?php echo htmlspecialchars($row['p_name']); ?></td>
                            <td><img width="50px" height="50px" src="../images/<?php echo htmlspecialchars($row['p_photo']); ?>"></td>
                            <td><?php echo htmlspecialchars($row['p_cat']); ?></td>
                            <td>
                                <a href="product_delete_process.php?id=<?php echo $row['p_id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this product?');">
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table> 

                <!-- Pagination -->
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:15px;">
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
