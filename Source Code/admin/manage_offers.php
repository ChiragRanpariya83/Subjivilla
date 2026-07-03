<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

$msg = "";

// ADD OFFER
if(isset($_POST['add_offer'])){
    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    if($image_name != ""){
        move_uploaded_file($tmp_name, "homeimages/".$image_name);
        mysqli_query($conn, "INSERT INTO manage_offers (image) VALUES ('$image_name')");
        $msg = "Offer added successfully!";
    }
}

// EDIT OFFER 
if(isset($_POST['edit_offer'])){
    $id = $_POST['id'];
    $new_image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    if($new_image != ""){
        // Delete old image
        $res = mysqli_query($conn, "SELECT image FROM manage_offers WHERE id=$id");
        $row = mysqli_fetch_assoc($res);
        if(file_exists("homeimages/".$row['image'])){
            unlink("homeimages/".$row['image']);
        }

        move_uploaded_file($tmp_name, "homeimages/".$new_image);
        mysqli_query($conn, "UPDATE manage_offers SET image='$new_image' WHERE id=$id");
        $msg = "Offer updated successfully!";
    }
}

// DELETE OFFER
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $res = mysqli_query($conn, "SELECT image FROM manage_offers WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    if(file_exists("homeimages/".$row['image'])){
        unlink("homeimages/s/".$row['image']);
    }
    mysqli_query($conn, "DELETE FROM manage_offers WHERE id=$id");
    $msg = "Offer deleted successfully!";
}

// Fetch all offers
$result = mysqli_query($conn, "SELECT * FROM manage_offers");
?>
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manage Offers</h1>

            <?php if($msg != "") { ?>
                <div class="alert alert-success"><?php echo $msg; ?></div>
            <?php } ?>

            <!-- Add Offer Form -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-plus me-1"></i>
                    Add New Offer
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" class="d-flex gap-2">
                        <input type="file" name="image" required class="form-control">
                        <button type="submit" name="add_offer" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>

            <!-- Offers Table -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                      Manage Offers List
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td>
                                    <?php if(!empty($row['image'])) { ?>
                                        <img src="homeimages/<?php echo $row['image']; ?>" alt="Offer" width="100">
                                    <?php } else { ?>
                                        No Image
                                    <?php } ?>
                                </td>
                                <td>
                                    <!-- Edit Form -->
                                    <form method="post" enctype="multipart/form-data" style="display:inline-block;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="file" name="image" required>
                                        <button type="submit" name="edit_offer" class="btn btn-success btn-sm">Edit</button>
                                    </form>
                                    <!-- Delete Link -->
                                    <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
<?php include('includes/footer.php'); ?>
</div>
