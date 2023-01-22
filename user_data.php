<?php
session_start();
if (!isset($_SESSION['phone'])) {
	echo "You are not logged in";
}

else{
	$link=new mysqli("localhost","root","","oas_db");
	if (!$link) {
	echo "Check database connection";
}

else{
	$sql="SELECT * FROM user WHERE phone='{$_SESSION['phone']}'";
	$result=$link->query($sql);
	
  if ($result->num_rows>0) {
    while ($row=$result->fetch_assoc()) {
      $username=$row['fullName'];
      $userid=$row['id'];
      $email=$row['email'];
      $phone=$row['phone'];
      $role=$row['role'];
      $region=$row['region'];
      $district=$row['district'];
      $ward=$row['ward'];
      $village=$row['village'];
    }
  }
  else{
    echo "No data";
  }

		
		
	
}
}
#error_reporting (E_ALL ^ E_NOTICE);
#$link=new mysqli("localhost","root","","uoa_hrms");




?>