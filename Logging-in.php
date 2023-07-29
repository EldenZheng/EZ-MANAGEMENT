<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: Loggin-in.php
// Description: to log in the user
// First Written on: Friday, 16-June-2023
// Edited on: Friday, 21-Jul-2023
include("conf.php");
session_start();
$email=$_POST['txtEMail'];
$Pass=$_POST['txtPass'];

$sql="SELECT employeeID FROM employee WHERE employeeEmail = '$email' and employeePassword = '$Pass'";
$result=mysqli_query($con,$sql);
$count = mysqli_num_rows($result);

if($count == 1) {
	
	$sql = mysqli_query($con,"select * from employee where employeeEmail = '$email' ");

	$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
	
    $_SESSION['login_ID'] = $row['employeeID'];

    $role = $row['employeeRole'];
	
	if($role=="1"){
		echo "<script>alert('Welcome Back HR!'); window.location.href='HomeHR.php';</script>";
	}else if($role=="2"){
		echo "<script>alert('Welcome Back Supervisor!'); window.location.href='HomeSupervisor.php';</script>";
	}else{
		echo "<script>alert('Welcome Back Employee!'); window.location.href='HomeEmployee.php';</script>";
	}
	
}else {
	echo "<script>alert('Your Login Name or Password is invalid'); window.location.href='Login.html';</script>";
}
mysqli_close($con)
?>