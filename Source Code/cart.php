<?php
session_start();
include('admin/includes/config.php');
include('header.php');

if(!isset($_SESSION['login'])) {
    header("location:login.php");
    exit();
}

// Handle cart quantity updates
if(isset($_POST['update_cart'])){
    foreach($_POST['qty'] as $index => $qty){
        $qty = intval($qty);
        if($qty > 0){
            $_SESSION['cart'][$index]['qty'] = $qty;
        }
    }
    header("Location: cart.php");
    exit();
}

// Proceed to checkout
if(isset($_POST['checkout'])){
    foreach($_POST['qty'] as $index => $qty){
        $qty = intval($qty);
        if($qty > 0){
            $_SESSION['cart'][$index]['qty'] = $qty;
        }
    }
    header("Location: checkout.php");
    exit();
}
?>

<div class="all-title-box" 
     style="background: url('images/all-bg-title1.jpg') no-repeat center center; background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cart</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="cart-box-main">
    <form action="checkout.php" method="POST">
        <div class="container">
            <?php if(isset($_SESSION['remove_product'])){ ?>
                <div class="alert alert-danger"><?php echo $_SESSION['remove_product']; unset($_SESSION['remove_product']); ?></div>
            <?php } ?>

            <div class="table-main table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Images</th>
                            <th>Product Name</th>
                            <th>Price (₹)</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grand_total = 0;
                        if(!empty($_SESSION['cart'])){
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $total = $value['price'] * $value['qty'];
                                $grand_total += $total;
                        ?>
                        <tr class="cart-item">
                            <td><img src="images/<?php echo $value['image']; ?>" width="60"></td>
                            <td>
                                <?php echo $value['name']; ?>
                                <input type="hidden" name="productid[]" value="<?php echo $value['id']; ?>">
                            </td>
                            <td class="price-pr" data-price="<?php echo $value['price']; ?>">₹ <?php echo $value['price']; ?></td>
                            <td><input type="number" class="qty" name="qty[<?php echo $key; ?>]" value="<?php echo $value['qty']; ?>" min="1" max="15"></td>
                            <td class="total-pr">₹ <?php echo number_format($total,2); ?></td>
                            <td><a href="add-to-cart.php?id=<?php echo $value['id']; ?>&action1=remove"><i class="fas fa-times"></i></a></td>
                        </tr>
                        <?php } } else { ?>
                        <tr><td colspan="6" style="text-align:center;">Your cart is empty</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="row my-4">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5 gtotal">₹ <?php echo number_format($grand_total,2); ?></div>
                        </div>
                        <hr>
                        <?php if(!empty($_SESSION['cart'])){ ?>
                        <div class="d-flex justify-content-between">
                            <input type="submit" name="update_cart" class="btn btn-secondary" value="Update Cart">
                            <input type="submit" name="checkout" class="btn btn-primary" value="Proceed To Checkout">
                        </div>
                        <?php } else { ?>
                            <div class="btn hvr-hover w-100">Cart is Empty</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Update totals dynamically when quantity changes
function updateTotals(){
    let grandTotal = 0;
    document.querySelectorAll(".cart-item").forEach(function(row){
        let price = parseFloat(row.querySelector(".price-pr").dataset.price);
        let qty = parseInt(row.querySelector(".qty").value) || 1;
        let total = price * qty;
        row.querySelector(".total-pr").textContent = "₹ " + total.toFixed(2);
        grandTotal += total;
    });
    document.querySelector(".gtotal").textContent = "₹ " + grandTotal.toFixed(2);
}
document.querySelectorAll(".qty").forEach(input => input.addEventListener("input", updateTotals));
updateTotals();
</script>

<?php include('footer.php'); ?>
