<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');

// Debugging ON
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = ""; // Success message


if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // delete image file also
    $res = mysqli_query($conn, "SELECT image FROM blogs WHERE id=$id");
    $data = mysqli_fetch_assoc($res);
    if (!empty($data['image']) && file_exists("blogs/" . $data['image'])) {
        unlink("blogs/" . $data['image']);
    }
    mysqli_query($conn, "DELETE FROM blogs WHERE id=$id");
    $message = "Blog deleted successfully";
}

$editData = ['id' => '', 'title' => '', 'description' => '', 'image' => ''];
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = mysqli_query($conn, "SELECT * FROM blogs WHERE id=$id");
    $editData = mysqli_fetch_assoc($res);
}

// Add/Update
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image = $_POST['old_image'] ?? '';

    // Handle Image Upload
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = "blogs/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $image = time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $image);
    }

    if ($id == '') {
        // Insert
        $query = "INSERT INTO blogs (title, description, image) VALUES ('$title','$description','$image')";
        mysqli_query($conn, $query);
        $message = "Blog added successfully";
    } else {
        // Update
        $query = "UPDATE blogs SET title='$title', description='$description', image='$image' WHERE id=$id";
        mysqli_query($conn, $query);
        $message = "Blog updated successfully";
    }

    // Reset edit data
    $editData = ['id' => '', 'title' => '', 'description' => '', 'image' => ''];
}

// FETCH BLOG LIST
$result = mysqli_query($conn, "SELECT * FROM blogs ORDER BY id ASC");
$blogs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $blogs[] = $row;
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manage Blogs</h1>
            <ol class="breadcrumb mb-3 col-sm-12 d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="home.php">home</a></li>
                <li class="breadcrumb-item active">Blogs</li>
            </ol>
            <?php if (!empty($message)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <!-- Blog Add / Update -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                    <?php echo ($editData['id'] == '' ? "Add Blog" : "Update Blog"); ?>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                        <input type="hidden" name="old_image" value="<?php echo $editData['image']; ?>">

                        <table class="table table-bordered align-middle">
                            <tr>
                                <th style="width:25%; vertical-align: middle;">Title</th>
                                <td>
                                    <input type="text" name="title" class="form-control"
                                        value="<?php echo $editData['title']; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;">Description</th>
                                <td>
                                    <textarea name="description" class="form-control" rows="5" required><?php echo $editData['description']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;">Image</th>
                                <td>
                                    <?php if (!empty($editData['image'])) { ?>
                                        <img src="blogs/<?php echo $editData['image']; ?>" style="width:150px; height:auto;" class="mb-2 border rounded"><br>
                                    <?php } ?>
                                    <input type="file" name="image" class="form-control" <?php echo ($editData['id']=='' ? 'required' : ''); ?>>
                                </td>
                            </tr>
                        </table>

                        <div class="text-end mt-3">
                            <button type="submit" name="save" class="btn btn-success">
                                <?php echo ($editData['id']=='' ? 'Add' : 'Update'); ?>
                            </button>
                            <?php if ($editData['id']!='') { ?>
                                <a href="blogs.php" class="btn btn-secondary">Cancel</a>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Blog List -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-list me-1"></i>
                    Blog List
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th width="20%">Actions</th>
                        </tr>
                        <?php if (count($blogs) > 0) {
                            foreach ($blogs as $row) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td>
                                        <?php if (!empty($row['image'])) { ?>
                                            <img src="blogs/<?php echo $row['image']; ?>" width="100">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="blog.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="blog.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                                           onclick="return confirm('Delete this blog?');">Delete</a>
                                    </td>
                                </tr>
                        <?php } } else { ?>
                            <tr><td colspan="4" class="text-center">No blogs found</td></tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php include('includes/footer.php'); ?>
</div>
