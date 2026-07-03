<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');

$id = $_GET['id'];
$edit_result = mysqli_query($conn, "SELECT * FROM product WHERE p_id='$id'");
$row = mysqli_fetch_assoc($edit_result);
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Item</h1>
            <div class="col-sm-12 d-flex justify-content-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product_edit.php">Edit items</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i> Edit Here
                </div>
                <div class="card-body">
                    <form action="product_edit_back.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="pid" value="<?php echo $id; ?>">
                        <div class="successmsg">
                            <?php 
                            if (isset($_SESSION['Success'])) {
                                echo $_SESSION['Success']; 
                                unset($_SESSION['Success']); 
                            }
                            ?>
                        </div>
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
                                    <td><input type="text" name="pname" value="<?php echo $row['p_name']; ?>"></td>
                                    <td>
                                        <img src="../images/<?php echo $row['p_photo']; ?>" width="50" height="50"><br>
                                        <input type="file" name="pfile">
                                    </td>
                                    <td>
                                        <select name="pcat">
                                            <option value="vegetables" <?php if($row['p_cat']=="vegetables") echo "selected"; ?>>Vegetables</option>
                                            <option value="fruits" <?php if($row['p_cat']=="fruits") echo "selected"; ?>>Fruits</option>
                                            <option value="dry fruits" <?php if($row['p_cat']=="dry fruits") echo "selected"; ?>>DryFruits</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="pkg" value="<?php echo $row['p_detail']; ?>"></td>
                                    <td><input type="text" name="pprice" value="<?php echo $row['p_price']; ?>"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit-button">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                    <div style="color: red;">
                        <?php
                        if (isset($_SESSION['perror'])) {
                            echo $_SESSION['perror']; 
                            unset($_SESSION['perror']);
                        }
                        if (isset($_SESSION['error'])) {
                            foreach ($_SESSION['error'] as $err) {
                                echo $err . "<br>";
                            }
                            unset($_SESSION['error']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include('includes/footer.php'); ?>
