<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: SubmitLeave.php
// Description: to submit leave request for employee and supervisor
// First Written on: Saturday, 24-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    $type=$_POST['cmbLeavetype'];
    $date=$_POST['leaveDay'];
    $duration=$_POST['duration'];
    $sqlReqLeav = "INSERT INTO requestleave(employeeID, leaveType, leaveDate, leaveDuration, approvalStatus) VALUES ($id, '$type', '$date', '$duration', 0)";
    $result=mysqli_query($con,$sqlReqLeav);
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