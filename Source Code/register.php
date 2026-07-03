<?php
session_start();
error_reporting(0);
include('header.php');
?>
<!-- Start All Title Box -->
<div class="all-title-box"
	style="background: url('images/all-bg-title1.jpg') no-repeat center center; background-size:cover;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>Register</h2>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Register</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End All Title Box -->
<style type="text/css">
	#login .container1 #login-row #login-column #login-box {
		max-width: 600px;
		min-height: 650px;

		border: 1px solid #9C9C9C;
		background-color: #EAEAEA;
	}

	#login .container1 #login-row #login-column #login-box #login-form {
		padding: 20px;
	}

	#login .container1 #login-row #login-column #login-box #login-form #register-link {
		margin-top: -85px;
	}

	.text-info-warning {
		color: red;
	}
</style>
<div class="shop-box-inner">
	<div class="container">
		<div id="login">
			<div class="container1">
				<div id="login-row" class="row justify-content-center align-items-center">
					<div id="login-column" class="col-md-6">
						<div id="login-box" class="col-md-12">
							<form id="login-form" class="form" action="user-process.php" method="post">
								<h3 class="text-center text-info">Register</h3>
								<div class="form-group">
									<label for="username" class="text-info">Username:</label><br>
									<input type="text" name="username" id="username" class="form-control">
									<div for="username" class="text-info-warning"><?php echo $_SESSION['error']['uname'];
																					unset($_SESSION['error']['uname']); ?></div>
								</div>
								<div class="form-group">
									<label for="username" class="text-info">Email:</label><br>
									<input type="email" name="email" id="username" class="form-control">
									<div for="username" class="text-info-warning"><?php echo $_SESSION['error']['email'];
																					unset($_SESSION['error']['email']); ?></div>
								</div>
								<div class="form-group">
									<label for="password" class="text-info">Password:</label><br>
									<input type="password" name="pass" id="password" class="form-control">
									<div for="username" class="text-info-warning"><?php echo $_SESSION['error']['pwd'];
																					unset($_SESSION['error']['pwd']); ?></div>
								</div>
								<div class="form-group">
									<label for="password" class="text-info">Confirm Password:</label><br>
									<input type="password" name="cpass" id="password" class="form-control">
								</div>
								<div class="form-group">
									<label for="password" class="text-info">Contact Number:</label><br>
									<input type="text" name="mnum" id="password" class="form-control" maxlength="10" minlength="10">
									<div for="username" class="text-info-warning"><?php echo $_SESSION['error']['mnum'];
																					unset($_SESSION['error']['mnum']); ?></div>
								</div>
								<div class="form-group">
									<label for="password" class="text-info">Shipping/Delivery Address:</label><br>
									<textarea class="form-control" name="address"></textarea>
									<div for="username" class="text-info-warning"><?php echo $_SESSION['error']['adrs'];
																					unset($_SESSION['error']['adrs']); ?></div>
								</div>
								<div class="form-group">
									<input type="submit" name="register" class="btn btn-info btn-md" value="Register">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>