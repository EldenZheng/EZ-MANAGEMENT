<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: Logout.php
// Description: to logout the user
// First Written on: Saturday, 24-June-2023
// Edited on: Friday, 21-Jul-2023
include("conf.php");
session_start();

if(isset($_SESSION['login_user'])){
	session_destroy();
	echo "<script>location.href='Login.html'</script>";
}
else{
	echo "<script>location.href='Login.html'</script>";
}
?>