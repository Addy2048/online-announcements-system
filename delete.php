<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
$link = mysqli_connect("localhost", "root", "", "oas_db");

if(!$link){
    echo "Error";
}

else{
    $id = $_POST['id'];
	$sql="DELETE  from announcements where id=$id "; 
	$result=$link->query($sql);
    header("location:admin.php", TRUE, 301);

}

?>