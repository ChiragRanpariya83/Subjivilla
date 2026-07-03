<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');

// Debugging ke liye error reporting ON
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = ""; // Success message

// Fetch existing data
$result = mysqli_query($conn, "SELECT * FROM about_us ORDER BY about_id DESC LIMIT 1");
$about = mysqli_fetch_assoc($result);

// Add / Update
if (isset($_POST['save'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $trusted = mysqli_real_escape_string($conn, $_POST['trusted']);
    $professional = mysqli_real_escape_string($conn, $_POST['professional']);
    $expert = mysqli_real_escape_string($conn, $_POST['expert']);

    // Image handle
    $image = $about['image'] ?? '';
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $image = $uploadDir . time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }

    if ($about) {
        // Update record
        $id = $about['about_id'];
        $query = "UPDATE about_us SET 
                    title='$title', description='$description',
                    image='$image', trusted='$trusted', professional='$professional', expert='$expert'
                  WHERE about_id=$id";
        mysqli_query($conn, $query);
        $message = "About Us updated successfully";
    } else {
        // Insert only if no record exists
        $check = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM about_us");
        $row = mysqli_fetch_assoc($check);
        if ($row['cnt'] == 0) {
            $query = "INSERT INTO about_us (title,description, image, trusted, professional, expert)
                      VALUES ('$title','$description','$image','$trusted','$professional','$expert')";
            mysqli_query($conn, $query);
            $message = "About Us added successfully";
        } else {
            $message = "Error: Only one About Us record is allowed";
        }
    }

    // Refresh data
    $result = mysqli_query($conn, "SELECT * FROM about_us ORDER BY about_id DESC LIMIT 1");
    $about = mysqli_fetch_assoc($result);
}

// Delete
if (isset($_POST['delete'])) {
    $id = $about['about_id'];
    mysqli_query($conn, "DELETE FROM about_us WHERE about_id=$id");
    $about = null; // reset
    $message = "About Us deleted successfully! Now you can add again.";
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manage About Us</h1>
            <ol class="breadcrumb mb-3 col-sm-12 d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="home.php">home</a></li>
                <li class="breadcrumb-item active">About Us</li>
            </ol>
            <?php if (!empty($message)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                    <?php echo $about ? "Update About Us" : "Add About Us"; ?>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <table class="table table-bordered align-middle">
                            <tr>
                                <th style="width:25%; vertical-align: middle;">Title</th>
                                <td>
                                    <input type="text" name="title" class="form-control"
                                        value="<?php echo $about['title'] ?? ''; ?>" required>
                                </td>
                            </tr>
                           
                            <tr>
                                <th style="vertical-align: middle;">Description</th>
                                <td>
                                    <textarea name="description" class="form-control" rows="5" required><?php echo $about['description'] ?? ''; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;">Image</th>
                                <td>
                                    <?php if (!empty($about['image'])) { ?>
                                        <img src="<?php echo $about['image']; ?>" style="width:150px; height:auto;" class="mb-2 border rounded"><br>
                                    <?php } ?>
                                    <input type="file" name="image" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;">Trusted Section</th>
                                <td>
                                    <textarea name="trusted" class="form-control" rows="3" required><?php echo $about['trusted'] ?? ''; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;">Professional Section</th>
                                <td>
                                    <textarea name="professional" class="form-control" rows="3" required><?php echo $about['professional'] ?? ''; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;">Expert Section</th>
                                <td>
                                    <textarea name="expert" class="form-control" rows="3" required><?php echo $about['expert'] ?? ''; ?></textarea>
                                </td>
                            </tr>
                        </table>

                        <div class="text-end mt-3">
                            <?php if (!$about) { ?>
                                <button type="submit" name="save" class="btn btn-success">Add</button>
                            <?php } else { ?>
                                <button type="submit" name="save" class="btn btn-warning">Update</button>
                                <button type="submit" name="delete" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this?');">
                                    Delete
                                </button>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
    <?php include('includes/footer.php'); ?>
</div>