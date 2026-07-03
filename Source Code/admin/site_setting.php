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
$result = mysqli_query($conn, "SELECT * FROM site_settings ORDER BY id DESC LIMIT 10");
$settings = mysqli_fetch_assoc($result);

// Add / Update
if (isset($_POST['save'])) {
    $site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
    $site_url = mysqli_real_escape_string($conn, $_POST['site_url']);
    $fruits_title     = mysqli_real_escape_string($conn, $_POST['fruits_title']);
    $fruits_desc      = mysqli_real_escape_string($conn, $_POST['fruits_desc']);
    $vegetables_title = mysqli_real_escape_string($conn, $_POST['vegetables_title']);
    $vegetables_desc  = mysqli_real_escape_string($conn, $_POST['vegetables_desc']);
    $business_time = mysqli_real_escape_string($conn, $_POST['business_time']);
    $social_google = mysqli_real_escape_string($conn, $_POST['social_google']);
    $social_whatsapp = mysqli_real_escape_string($conn, $_POST['social_whatsapp']);
    $social_instagram = mysqli_real_escape_string($conn, $_POST['social_instagram']);
    $social_twitter = mysqli_real_escape_string($conn, $_POST['social_twitter']);
    $social_facebook = mysqli_real_escape_string($conn, $_POST['social_facebook']);
    $about_text = mysqli_real_escape_string($conn, $_POST['about_text']);
    $contact_address = mysqli_real_escape_string($conn, $_POST['contact_address']);
    $contact_phone = mysqli_real_escape_string($conn, $_POST['contact_phone']);
    $contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);

    // Image handle
    $site_logo = $settings['site_logo'] ?? '';
    if (!empty($_FILES['site_logo']['name'])) {
        $uploadDir = "siteimages/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $site_logo = $uploadDir . time() . "_" . basename($_FILES["site_logo"]["name"]);
        move_uploaded_file($_FILES["site_logo"]["tmp_name"], $site_logo);
    }

    if ($settings) {
        // Update record
        $id = $settings['id'];
        $query = "UPDATE site_settings SET 
                    site_name='$site_name', site_logo='$site_logo', site_url='$site_url',
                    fruits_title='$fruits_title', fruits_desc='$fruits_desc',
                    vegetables_title='$vegetables_title', vegetables_desc='$vegetables_desc',
                    business_time='$business_time',
                    social_google='$social_google', social_whatsapp='$social_whatsapp',
                    social_instagram='$social_instagram', social_twitter='$social_twitter',
                    social_facebook='$social_facebook',
                    about_text='$about_text',
                    contact_address='$contact_address', contact_phone='$contact_phone', contact_email='$contact_email'
                  WHERE id=$id";
        mysqli_query($conn, $query);
        $message = "Site Settings updated successfully!";
    } else {
        // Insert only if no record exists
        $check = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM site_settings");
        $row = mysqli_fetch_assoc($check);
        if ($row['cnt'] == 0) {
            $query = "INSERT INTO site_settings 
                      (site_name, site_logo, site_url,fruits_title, fruits_desc,vegetables_title, vegetables_desc, business_time, social_google, social_whatsapp, social_instagram, social_twitter, social_facebook, about_text, contact_address, contact_phone, contact_email)
                      VALUES 
                      ('$site_name','$site_logo','$site_url','$fruits_title','$fruits_desc','$vegetables_title','$vegetables_desc','$business_time','$social_google','$social_whatsapp','$social_instagram','$social_twitter','$social_facebook','$about_text','$contact_address','$contact_phone','$contact_email')";
            mysqli_query($conn, $query);
            $message = "Site Settings added successfully!";
        } else {
            $message = "Error: Only one Site Settings record is allowed";
        }
    }

    // Refresh data
    $result = mysqli_query($conn, "SELECT * FROM site_settings ORDER BY id DESC LIMIT 10");
    $settings = mysqli_fetch_assoc($result);
}

// Delete
if (isset($_POST['delete'])) {
    $id = $settings['id'];
    mysqli_query($conn, "DELETE FROM site_settings WHERE id=$id");
    $settings = null; // reset
    $message = "Site Settings deleted successfully! Now you can add again.";
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manage Site Settings</h1>
            <ol class="breadcrumb mb-3 col-sm-12 d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Site Settings</li>
            </ol>
            <?php if (!empty($message)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-cog me-1"></i>
                    <?php echo $settings ? "Update Site Settings" : "Add Site Settings"; ?>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <table class="table table-bordered align-middle">
                            <tr>
                                <th style="width:25%;">Site Name</th>
                                <td><input type="text" name="site_name" class="form-control"
                                        value="<?php echo $settings['site_name'] ?? ''; ?>" required></td>
                            </tr>
                            <tr>
                                <th>Site Logo</th>
                                <td>
                                    <?php if (!empty($settings['site_logo'])) { ?>
                                        <img src="<?php echo $settings['site_logo']; ?>" style="width:150px;" class="mb-2 border rounded"><br>
                                    <?php } ?>
                                    <input type="file" name="site_logo" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th>Site URL</th>
                                <td><input type="text" name="site_url" class="form-control"
                                        value="<?php echo $settings['site_url'] ?? ''; ?>" required></td>
                            </tr>
                            <tr>
                                <th>Fruits & Vegetables Section Title</th>
                                <td><input type="text" name="fruits_title" class="form-control"
                                        value="<?php echo $settings['fruits_title'] ?? ''; ?>"></td>
                            </tr>
                            <tr>
                                <th>Fruits & Vegetables Section Description</th>
                                <td><textarea name="fruits_desc" class="form-control" rows="3"><?php echo $settings['fruits_desc'] ?? ''; ?></textarea></td>
                            </tr>
                            <tr>
                                <th>Vegetables Section Title</th>
                                <td><input type="text" name="vegetables_title" class="form-control"
                                        value="<?php echo $settings['vegetables_title'] ?? ''; ?>"></td>
                            </tr>
                            <tr>
                                <th>Vegetables Section Description</th>
                                <td><textarea name="vegetables_desc" class="form-control" rows="3"><?php echo $settings['vegetables_desc'] ?? ''; ?></textarea></td>
                            </tr>
                            <tr>
                                <th>Business Time (use | for new line)</th>
                                <td><textarea name="business_time" class="form-control" rows="3"><?php echo $settings['business_time'] ?? ''; ?></textarea></td>
                            </tr>
                            <tr>
                                <th>Google Link</th>
                                <td><input type="text" name="social_google" class="form-control"
                                        value="<?php echo $settings['social_google'] ?? ''; ?>"></td>
                            </tr>
                            <tr>
                                <th>Whatsapp Link</th>
                                <td><input type="text" name="social_whatsapp" class="form-control"
                                        value="<?php echo $settings['social_whatsapp'] ?? ''; ?>"></td>
                            </tr>
                            <tr>
                                <th>Instagram Link</th>
                                <td><input type="text" name="social_instagram" class="form-control"
                                        value="<?php echo $settings['social_instagram'] ?? ''; ?>"></td>
                            </tr>
                            <tr>
                                <th>Twitter Link</th>
                                <td><input type="text" name="social_twitter" class="form-control"
                                        value="<?php echo $settings['social_twitter'] ?? ''; ?>"></td>
                            </tr>
                            <tr>
                                <th>Facebook Link</th>
                                <td><input type="text" name="social_facebook" class="form-control"
                                        value="<?php echo $settings['social_facebook'] ?? ''; ?>"></td>
                            </tr>
                            <tr>
                                <th>About Text</th>
                                <td><textarea name="about_text" class="form-control" rows="4"><?php echo $settings['about_text'] ?? ''; ?></textarea></td>
                            </tr>
                            <tr>
                                <th>Contact Address</th>
                                <td><textarea name="contact_address" class="form-control" rows="3"><?php echo $settings['contact_address'] ?? ''; ?></textarea></td>
                            </tr>
                            <tr>
                                <th>Contact Phone</th>
                                <td><input type="text" name="contact_phone" class="form-control"
                                        value="<?php echo $settings['contact_phone'] ?? ''; ?>"></td>
                            </tr>
                            <tr>
                                <th>Contact Email</th>
                                <td><input type="email" name="contact_email" class="form-control"
                                        value="<?php echo $settings['contact_email'] ?? ''; ?>"></td>
                            </tr>
                        </table>

                        <div class="text-end mt-3">
                            <?php if (!$settings) { ?>
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