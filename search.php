<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
$link = mysqli_connect("localhost", "root", "", "oas_db");

if(!$link){
    echo "Error";
}

else{
    $searchTerm = $_POST['keyword'];
	$sql="SELECT * from announcements WHERE title like '%$searchTerm%' OR village like '%$searchTerm%' ORDER BY id desc"; 
	$result= mysqli_query($link,$sql);
}

?>