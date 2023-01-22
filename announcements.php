<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
$link = mysqli_connect("localhost", "root", "", "oas_db");

if(!$link){
    echo "Error";
}

else{
	$sql="SELECT * from announcements ORDER BY id desc"; 
	$result=$link->query($sql);

}

?>