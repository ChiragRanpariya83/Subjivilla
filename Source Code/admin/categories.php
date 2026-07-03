<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

// -------- PAGINATION SETTINGS --------
$limit = 5; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// -------- FETCH TOTAL CATEGORIES --------
$result_all = mysqli_query($conn, "SELECT * FROM categories");
$total_records = mysqli_num_rows($result_all);
$total_pages = ceil($total_records / $limit);

// -------- FETCH PAGINATED DATA --------
$result = mysqli_query($conn, "SELECT * FROM categories LIMIT $start, $limit");
?>
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Categories</h1>

            <div class="d-flex justify-content-end mb-3">
                <a href="categories_add.php" class="btn btn-primary btn-sm">Add New</a>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                    Categories List (<?php echo $total_records; ?>)
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['cat_name']; ?></td>
                                <td>
                                    <?php if(!empty($row['cat_image'])) { ?>
                                        <img src="categories/<?php echo $row['cat_image']; ?>" alt="<?php echo $row['cat_name']; ?>" width="50" height="50">
                                    <?php } else { ?>
                                        No Image
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="categories_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="categories_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:15px;">
                        <div>
                            <p>Showing <?php echo min($total_records, $start + $limit); ?> of <?php echo $total_records; ?> entries</p>
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
