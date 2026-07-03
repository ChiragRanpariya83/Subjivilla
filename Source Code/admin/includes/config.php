<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "subjivilla";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	

	if(!$conn){
		die("Operation Failed = ".mysqli_connect_error());
	}
	
?>