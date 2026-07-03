<?php
session_start();
if (!isset($_SESSION['login'])) header("location:login.php");

include('includes/config.php');

if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM manage_order_details WHERE customer_id=$deleteId");
    mysqli_query($conn, "DELETE FROM customer WHERE c_id=$deleteId");
    $_SESSION['Success'] = "Customer and orders deleted!";
    header("location:customer.php"); exit();
}

if (isset($_POST['update_status'])) {
    $customerId = intval($_POST['customer_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    mysqli_query($conn, "UPDATE customer SET c_status='$status' WHERE c_id=$customerId");
    $_SESSION['Success'] = "Status updated!";
    header("location:customer.php"); exit();
}

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page-1)*$limit;
$total_records = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM customer"));
$total_pages = ceil($total_records/$limit);
$result = mysqli_query($conn, "SELECT * FROM customer LIMIT $start,$limit");

include('includes/header.php');
include('includes/sidebar.php');
?>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
<h1>Customer Details</h1>

<?php if(isset($_SESSION['Success'])) { ?>
<div class="alert alert-success"><?php echo $_SESSION['Success']; unset($_SESSION['Success']); ?></div>
<?php } ?>

<table class="table table-bordered">
<thead><tr>
<th>Name</th><th>Phone</th><th>Address</th><th>Orders</th><th>Status</th><th>Last Order</th><th>Action</th>
</tr></thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($result)) {
$last_order = mysqli_fetch_assoc(mysqli_query($conn,"SELECT order_time FROM manage_order_details WHERE customer_id={$row['c_id']} ORDER BY order_time DESC LIMIT 1"));
$latest_time = $last_order ? date("d-m-Y H:i:s", strtotime($last_order['order_time'])) : "No orders";
?>
<tr>
<td><?php echo $row['c_username']; ?></td>
<td><?php echo $row['c_phone']; ?></td>
<td><?php echo $row['c_address']; ?></td>
<td><a href="manage_order_details.php?id=<?php echo $row['c_id']; ?>"><button class="btn btn-primary btn-sm">View Orders</button></a></td>
<td>
<form method="POST" style="display:flex; gap:5px;">
<input type="hidden" name="customer_id" value="<?php echo $row['c_id']; ?>">
<select name="status" class="form-select form-select-sm">
<option value="Pending" <?php if($row['c_status']=='Pending') echo 'selected'; ?>>Pending</option>
<option value="Approved" <?php if($row['c_status']=='Approved') echo 'selected'; ?>>Approved</option>
<option value="Processing" <?php if($row['c_status']=='Processing') echo 'selected'; ?>>Processing</option>
<option value="Rejected" <?php if($row['c_status']=='Rejected') echo 'selected'; ?>>Rejected</option>
<option value="Completed" <?php if($row['c_status']=='Completed') echo 'selected'; ?>>Completed</option>
</select>
<button type="submit" name="update_status" class="btn btn-success btn-sm">Update</button>
</form>
</td>
<td><?php echo $latest_time; ?></td>
<td><a href="customer.php?delete=<?php echo $row['c_id']; ?>" onclick="return confirm('Delete customer and orders?')"><button class="btn btn-danger btn-sm">Delete</button></a></td>
</tr>
<?php } ?>
</tbody>
</table>

<nav><ul class="pagination">
<?php for($i=1;$i<=$total_pages;$i++){ ?>
<li class="page-item <?php if($i==$page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php } ?>
</ul></nav>
</div>
</main>
<?php include('includes/footer.php'); ?>
