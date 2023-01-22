<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
include 'user_data.php';
$link = mysqli_connect("localhost", "root", "", "oas_db");

if(!$link){
    echo "Error";
}

else{
	$sql="SELECT * from announcements where village='$village' ORDER BY id desc"; 
	$result=$link->query($sql);

}

?>