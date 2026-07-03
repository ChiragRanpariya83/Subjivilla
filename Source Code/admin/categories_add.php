<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

$message = "";

if (isset($_POST['save'])) {
    $cat_name = $_POST['cat_name'];

    // Handle image upload
    $cat_image = "";
    if (!empty($_FILES['cat_image']['name'])) {
        $cat_image = time().'_'.$_FILES['cat_image']['name'];
        move_uploaded_file($_FILES['cat_image']['tmp_name'], 'categories/'.$cat_image);
    }

    $sql = "INSERT INTO categories (cat_name, cat_image) VALUES ('$cat_name', '$cat_image')";
    if (mysqli_query($conn, $sql)) {
        $message = "Category added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Category</h1>
            <?php if($message) echo '<div class="alert alert-success">'.$message.'</div>'; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="cat_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category Image</label>
                    <input type="file" name="cat_image" class="form-control">
                </div>
                <button type="submit" name="save" class="btn btn-primary">Save</button>
                <a href="categories.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </main>
<?php include('includes/footer.php'); ?>
</div>
