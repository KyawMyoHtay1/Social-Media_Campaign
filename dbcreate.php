<?php
	
	$host = "localhost"; //ip address
	$username = "root";
	$password = ""; //no password

	$connection = mysqli_connect($host,$username,$password);
	
	if($connection) 
		echo "Database Connected!";
	else 
		echo "Connection Fail!";

	$sql = "create database smcdb";

	if(mysqli_query($connection,$sql))
		echo "Database is created!";
	else 
		echo "Creation Database Error!";

?>