<?php
	$catname =  $_POST['catname'];
    include('admin/includes/config.php');
	if($catname == 'no'){
		$qry= "SELECT * FROM product";
	}else{

	$qry= "SELECT * FROM product WHERE p_cat='$catname'";
	}
	$res= mysqli_query($conn, $qry);
	$numdata = mysqli_num_rows($res);
?>
<?php
if($numdata>0){
while ($row = mysqli_fetch_array($res)) 
	
    {
    	?>
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <div class="products-single fix">
                <div class="box-img-hover">
                    <div class="type-lb">
                        <p class="sale">Sale</p>
                    </div>
                    <img src="images/<?php echo $row['p_photo']?>" class="img-fluid" alt="Image">
                    <div class="mask-icon">
                        <a class="cart" href="#">Add to Cart</a>
                    </div>
                </div>
                <div class="why-text">
                    <h4><?php echo $row['p_name'] ?></h4>
                    <h5> ₹<?php echo $row['p_price']?></h5>
                </div>
            </div>
        </div>
        <?php } }else{ echo  'no product found'; } ?>


