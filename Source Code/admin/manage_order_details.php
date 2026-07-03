<?php
session_start();
include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');

$cid = intval($_GET['id']);
$cust = mysqli_fetch_assoc(mysqli_query($conn, "SELECT c_username FROM customer WHERE c_id = $cid"));
$cust_name = $cust ? $cust['c_username'] : "Unknown";
?>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
<h1 class="mt-4">Order Details - <?php echo htmlspecialchars($cust_name); ?></h1>

<?php
$orders_query = mysqli_query($conn, "
    SELECT DISTINCT order_batch, order_time, payment_mode
    FROM manage_order_details
    WHERE customer_id = $cid
    ORDER BY order_time DESC
");

if(mysqli_num_rows($orders_query) > 0){
    while($order = mysqli_fetch_assoc($orders_query)){
        $batch = $order['order_batch'];
        $order_time = date("d-m-Y H:i:s", strtotime($order['order_time']));
        $payment_mode = htmlspecialchars($order['payment_mode']);
?>
<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <span>Order Batch: <?php echo $batch; ?> | Date: <?php echo $order_time; ?></span>
        <span>Payment: <?php echo $payment_mode; ?></span>
    </div>
    <div class="card-body">
        <button class="btn btn-success mb-3" onclick="printDiv('printArea<?php echo $batch; ?>')">
            <i class="fas fa-print"></i> Print
        </button>

        <div id="printArea<?php echo $batch; ?>">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr><th>Photo</th><th>Product</th><th>Qty</th><th>Price (₹)</th><th>Total (₹)</th><th>Status</th></tr>
                </thead>
                <tbody>
                <?php
                $products_query = mysqli_query($conn, "
                    SELECT m.*, p.p_name, p.p_price, p.p_photo
                    FROM manage_order_details m
                    LEFT JOIN product p ON m.product_id = p.p_id
                    WHERE m.customer_id=$cid AND m.order_batch='$batch'
                ");
                $grand_total = 0;
                while($row = mysqli_fetch_assoc($products_query)){
                    $line_total = $row['order_price'] * $row['order_qty'];
                    $grand_total += $line_total;

                    $status_color = "secondary";
                    switch ($row['order_status']) {
                        case "Pending": $status_color = "warning"; break;
                        case "Processing": $status_color = "info"; break;
                        case "Completed": $status_color = "success"; break;
                        case "Rejected": $status_color = "danger"; break;
                        case "Approved": $status_color = "primary"; break;
                    }
                ?>
                    <tr>
                        <td><img width="60" height="60" src="../images/<?php echo $row['p_photo']; ?>"></td>
                        <td><?php echo htmlspecialchars($row['p_name']); ?></td>
                        <td><?php echo $row['order_qty']; ?></td>
                        <td>₹<?php echo number_format($row['p_price'],2); ?></td>
                        <td>₹<?php echo number_format($line_total,2); ?></td>
                        <td><span class="badge bg-<?php echo $status_color; ?>"><?php echo $row['order_status']; ?></span></td>
                    </tr>
                <?php } ?>
                    <tr class="table-info">
                        <td colspan="4" class="text-end"><b>Grand Total</b></td>
                        <td colspan="2"><b>₹<?php echo number_format($grand_total,2); ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } } else { ?>
<div class="alert alert-danger">No orders found for this customer!</div>
<?php } ?>
</div>
</main>

<?php include('includes/footer.php'); ?>
<script>
function printDiv(divId){
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = '<style>table{width:100%;border-collapse:collapse;}th,td{border:1px solid #000;padding:8px;text-align:center;}th{background:#f2f2f2;}img{border-radius:8px;} .badge{padding:5px 10px; border-radius:6px;}</style>' + printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
