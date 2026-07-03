<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
}
include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');
error_reporting(0);

// fetch categories from DB
$cat_result = mysqli_query($conn, "SELECT * FROM categories ORDER BY cat_name ASC");
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Items</h1>
            <div class="col-sm-12 d-flex justify-content-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product_add.php">View Items</a></li>
                    <li class="breadcrumb-item active">Add Items</li>
                </ol>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                    Add Vegetables/Fruits/DryFruits Here
                </div>

                <div class="card-body">
                    <form action="product_add_process.php" method="POST" enctype="multipart/form-data">
                        <div class="successmsg"><?php echo $_SESSION['Success']; unset($_SESSION['Success']); ?></div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Category</th>
                                    <th>KG</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="pname" required></td>
                                    <td><input type="file" name="pfile" id="fileToUpload" required></td>
                                    <td>
                                        <select name="pcat" required>
                                            <option value="">-- Select Category --</option>
                                            <?php while($cat = mysqli_fetch_assoc($cat_result)) { ?>
                                                <option value="<?php echo $cat['cat_name']; ?>">
                                                    <?php echo ucfirst($cat['cat_name']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input type="text" name="pkg" required></td>
                                    <td><input type="text" name="pprice" required></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit-button">
                            <button type="submit" name="Submit" class="btn btn-primary btn-sm">Add</button>
                        </div>
                    </form>
                    <div>
                        <div style="color: red;"><?php echo $_SESSION['perror']; unset($_SESSION['perror']); ?></div>
                        <div style="color: red;"><?php echo $_SESSION['error']['pname']; unset($_SESSION['error']['pname']); ?></div>
                        <div style="color: red;"><?php echo $_SESSION['error']['pfile']; unset($_SESSION['error']['pfile']); ?></div>
                        <div style="color: red;"><?php echo $_SESSION['error']['pkg']; unset($_SESSION['error']['pkg']); ?></div>
                        <div style="color: red;"><?php echo $_SESSION['error']['pprice']; unset($_SESSION['error']['pprice']); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('includes/footer.php'); ?>
