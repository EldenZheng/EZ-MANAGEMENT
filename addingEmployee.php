<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: addingEmployee.php
// Description: add employee to database
// First Written on: Friday, 16-June-2023
// Edited on: Friday, 21-Jul-2023
include("conf.php");
if (isset($_POST['email_check']))
{
	$eMail = $_POST['email'];
	$query = "SELECT * FROM employee WHERE employeeEmail='$eMail'";
	$results = mysqli_query($con,$query);
	if (mysqli_num_rows($results)> 0){
		echo "not_available";
	}
	else {
		echo "available";
	}
	exit();
}
if(isset($_POST['BtnAdd']))
{
	$name = $_POST["txtUsername"];
    $pass = $_POST["txtPass"];
    $ic = $_POST["txtIC"];
	$dept = $_POST["txtDept"];
	$role = $_POST["txtRole"];
	$team = $_POST["txtTeam"];
    $email = $_POST["email"];
	$phone = $_POST["txtPN"];
	$address = $_POST["txtAddress"];
    $hiredDate = date("Y-m-d");
	if($role=="1"){
        $team="0";
        $dept="HR Department";
    }elseif ($dept === "HR Department") {
		$role = "1";
		$team = "0";
	}
	$sql="INSERT INTO `employee` (employeeName,employeePassword,employeeIC,employeeDept,employeeRole,employeeEmail,employeePhonenum,employeeAddress,employeeHireddate,employeeTotalRating,employeeTeam) 
	VALUES('$name','$pass','$ic','$dept','$role','$email','$phone','$address','$hiredDate','0','$team')";
	$result = mysqli_query($con,$sql);
	if ($result === false) {
		die("Query failed: " . mysqli_error($con));
	} else{
		echo "Employee Updated!";
	}
	exit();
}
mysqli_close($con)
?>