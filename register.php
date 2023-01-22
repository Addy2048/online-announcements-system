<?php

session_start();
error_reporting (E_ALL ^ E_NOTICE);
$link=mysqli_connect("localhost","root", "", "oas_db");

if(!$link){
    echo "Error";
}

else {

    $name = $_POST['name'];
    $nida = $_POST['nida'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $region = $_POST['region'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $village = $_POST['village'];

    $sql = "INSERT INTO user (fullName, nida, phone, email, role,  password, region, district, ward, village) VALUES ('$name','$nida','$phone','$email','$role','$password','$region','$district','$ward','$village')";
    $result=$link->query($sql);
    if(!$result){
    	echo "error";
    }
    else{
    	echo "Data saved";
    	header("location:login.html", TRUE, 301);
    }
}


?>