<?php
session_start();
unset($_SESSION['phone']);
session_destroy();
header("location:login.html", TRUE, 301);
exit();


?>