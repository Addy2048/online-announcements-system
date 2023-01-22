<?php

session_start();
error_reporting (E_ALL ^ E_NOTICE);
$link=mysqli_connect("localhost","root", "", "oas_db");

if(!$link){
    echo "Error";
}

else {
    include 'user_data.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
  

    $sql = "INSERT INTO announcements (title, content, user_id, region, district, ward, village) VALUES ('$title','$content','$userid','$region','$district','$ward','$village')";
    $result=$link->query($sql);
    if(!$result){
    	echo "error";
    }
    else{
    	header("location:admin.php", TRUE, 301);
    	exit();
    }
}


?>