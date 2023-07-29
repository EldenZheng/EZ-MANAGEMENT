<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: UpdateEmployee.php
// Description: to update the employee's profile
// First Written on: Wednesday, 21-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    $empID = $_POST["txtID"];
    $name = $_POST["txtUsername"];
    $passw = $_POST["txtPass"];
    $ic = $_POST["txtIC"];
	$dept = $_POST["txtDept"];
	$rolee = $_POST["txtRole"];
	$team = $_POST["txtTeam"];
    $email = $_POST["email_check"];
	$phone = $_POST["txtPN"];
	$address = $_POST["txtAddress"];
    if($rolee=="1"){
        $team="0";
        $dept="HR Department";
    }elseif ($dept === "HR Department") {
		$rolee = "1";
		$team = "0";
	}
    $sql="UPDATE employee
    SET employeeName = '$name',
        employeePassword = '$passw',
        employeeIC = '$ic',
        employeeDept = '$dept',
        employeeRole = '$rolee',
        employeeEmail = '$email',
        employeePhonenum = '$phone',
        employeeAddress = '$address',
        employeeTeam = '$team'
    WHERE employeeID = $empID;";
	
    if(mysqli_query($con,$sql)){
        if ($role == 1) {
            // Redirect to manageEmployee.php for role 1
            echo "<script>alert('Employee Updated!'); window.location.href='HomeHR.php';</script>";
        } elseif ($role == 2) {
            // Redirect to HomeSupervisor.php for role 2
            echo "<script>alert('Profile Updated!'); window.location.href='HomeSupervisor.php';</script>";
        } elseif ($role == 3) {
            // Redirect to HomeEmployee.php for role 3
            echo "<script>alert('Profile Updated!'); window.location.href='HomeEmployee.php';</script>";
        }
    }else {
        // Query failed, display an error message
        echo "<script>Error:  ". mysqli_error($con)."</script>";
    }
    
?>