<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE);
$link=new mysqli("localhost","root","","oas_db");
if (!$link) {
	header("Location: index.php",TRUE, 301);
	exit();
	echo "Error connecting to database";
}
else{
	$phone=$_POST['phone'];
	$password=$_POST['password']; 

	$sql="SELECT * FROM user WHERE phone='$phone' AND password='$password'";
	$result=$link->query($sql);

    if ($alldata=$result->fetch_assoc()) {
    	$_SESSION['phone']=$phone;
    	$user=$_SESSION['phone'];
    	header("Location: admin.php", TRUE, 301);
    	exit();
    }

    else{
    	echo "Login Error";
		header("location:login.html", TRUE, 301);
    }
}


?>