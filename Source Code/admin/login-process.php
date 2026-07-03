<?php
	session_start();
	include ('includes/config.php');	
	$name= $_POST['username'];
	$pwd= $_POST['pwd'];

	$qry= "SELECT * FROM admin where username='$name' and pwd='".md5($pwd)."'";
	$res= mysqli_query($conn, $qry);
	$row= mysqli_fetch_assoc($res);


	if(isset($row)){
		$_SESSION['login']=$row;
		header("location:home.php");
	}
	else
	{
		$_SESSION['invalid']="Username or Password Wrong";
		header("location:login.php");
	}
?>