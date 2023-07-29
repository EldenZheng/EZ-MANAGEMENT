<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: emailCheck.php
// Description: to check whether employee has unique email or not
// First Written on: Thursday, 22-June-2023
// Edited on: Friday, 21-Jul-2023
include("conf.php");
include("session.php");
if (isset($_POST['email_check']))
{
	$eMail = $_POST['email'];
	$query = "SELECT * FROM employee WHERE employeeEmail='$eMail' AND employeeEmail != '$eMail'";
	$results = mysqli_query($con,$query);
	if (mysqli_num_rows($results)> 0){
		echo "not_available";
	}
	else {
		echo "available";
	}
	exit();
}
?>