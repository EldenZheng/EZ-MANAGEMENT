<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: endShift.php
// Description: end shift for all user
// First Written on: Tuesday, 20-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    $sqltime="SELECT * FROM shift WHERE employeeID='$id' and shiftDate=CURDATE()";
    $result1= mysqli_query($con,$sqltime);
    $Row = mysqli_fetch_assoc($result1);
    $timeStart = $Row["shiftStart"];
    $timeNow = date("H:i:s", strtotime("+8 hours"));

    $dateTimeStart = DateTime::createFromFormat('H:i:s', $timeStart);
    $dateTimeNow = DateTime::createFromFormat('H:i:s', $timeNow);

    $interval = $dateTimeStart->diff($dateTimeNow);
    $timeDifference = $interval->format('%H:%I:%S');
    $sqlEndShift="UPDATE shift SET shiftDuration = '$timeDifference' WHERE employeeID='$id' and shiftDate=CURDATE()";
    if (mysqli_query($con, $sqlEndShift)) {
        echo "Shift ended successfully!";
    } else {
        echo "Error ending shift: " . mysqli_error($con);
    }
?>