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
				<h2>Login</h2>&nbsp;&nbsp;
				<h2 style="color: yellow;"><?php echo $_SESSION['Success'];
											unset($_SESSION['Success']); ?></h2>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Login</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End All Title Box -->
<style type="text/css">
	#login .container1 #login-row #login-column #login-box {
		max-width: 600px;
		height: 350px;
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
								<h3 class="text-center text-info">Login</h3>
								<div class="form-group">
									<label for="username" class="text-info">Email:</label><br>
									<input type="email" name="email" id="username" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="password" class="text-info">Password:</label><br>
									<input type="password" name="pwd" id="password" class="form-control" required>
									<div for="username" class="text-info-warning"><?php echo $_SESSION['wrong'];
																					unset($_SESSION['wrong']); ?></div>
								</div>
								<div class="form-group">
									<label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
									<input type="submit" name="login" class="btn btn-info btn-md" value="Login">
								</div>
								<div id="register-link" class="text-right">
									<a href="register.php" class="text-info">Register here</a>
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