<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: session.php
// Description: to save the user while the user is logged-in
// First Written on: Friday, 16-June-2023
// Edited on: Friday, 21-Jul-2023
	include('conf.php');
	session_start();
   
	$emID = $_SESSION['login_ID'];
   
	$sql = mysqli_query($con,"select * from employee where employeeID = '$emID' ");

	$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
    
    $id = $row['employeeID'];
	$name = $row['employeeName'];
	$dept = $row['employeeDept'];
	$role = $row['employeeRole'];
	$email = $row['employeeEmail'];
	$phone = $row['employeePhonenum'];
	$address = $row['employeeAddress'];
	$hiredDate = $row['employeeHireddate'];
	$totRating = $row['employeeTotalRating'];
	$team = $row['employeeTeam'];
	$ic = $row['employeeIC'];
	$pass = $row['employeePassword'];
	
	if(!isset($_SESSION['login_ID'])){
		header("location:login.php");
		die();
	}
?>