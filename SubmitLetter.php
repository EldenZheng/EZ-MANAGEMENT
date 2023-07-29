<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: submitLetter.php
// Description: to submit letter request for employee and supervisor
// First Written on: Saturday, 24-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    // $type=$_POST['cmbLettertype'];
    $sqlReqLett="INSERT INTO requestletter(employeeID, letterType) VALUES ($id, 'Referral')";
    $result=mysqli_query($con,$sqlReqLett);
    if($result){
        if ($role == 2) {
            echo "<script>alert('Request Submitted!'); window.location.href='HomeSupervisor.php';</script>";
        } elseif ($role == 3) {
            echo "<script>alert('Request Submitted!'); window.location.href='HomeEmployee.php';</script>";
        }
    }else{
        echo "Error executing query: " . mysqli_error($con);
    }
?>