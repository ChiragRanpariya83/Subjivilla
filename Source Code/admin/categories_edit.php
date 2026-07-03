<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

$id = $_GET['id'];
$message = "";

// Fetch category data
$res = mysqli_query($conn, "SELECT * FROM categories WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {
    $cat_name = $_POST['cat_name'];
    $cat_image = $row['cat_image'];

    // If new image uploaded
    if (!empty($_FILES['cat_image']['name'])) {
        $cat_image = time().'_'.$_FILES['cat_image']['name'];
        move_uploaded_file($_FILES['cat_image']['tmp_name'], 'categories/'.$cat_image);
    }

    $sql = "UPDATE categories SET cat_name='$cat_name', cat_image='$cat_image' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        $message = "Category updated successfully!";
        header("location:categories.php");
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
            <h1 class="mt-4">Edit Category</h1>
            <?php if($message) echo '<div class="alert alert-danger">'.$message.'</div>'; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="cat_name" class="form-control" value="<?php echo $row['cat_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category Image</label><br>
                    <?php if($row['cat_image']) { ?>
                        <img src="categories/<?php echo $row['cat_image']; ?>" width="100" height="100" alt=""><br><br>
                    <?php } ?>
                    <input type="file" name="cat_image" class="form-control">
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <a href="categories.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </main>
<?php include('includes/footer.php'); ?>
</div>
