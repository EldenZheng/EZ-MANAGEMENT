<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: shiftDuration.php
// Description: to calculate the duration of the shift
// First Written on: Tuesday, 20-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    $sqlduration = "SELECT shiftStart FROM shift WHERE employeeID='$id' AND shiftDate=CURDATE() AND shiftDuration='00:00:00'";
    $resultD = mysqli_query($con, $sqlduration);
    $counting = mysqli_num_rows($resultD);
    if ($counting == 1) {
        $Row = mysqli_fetch_assoc($resultD);
        $timeStarts = $Row["shiftStart"];
        $currentTime = date("H:i:s", strtotime("+8 hours"));
    
        $dateTimeStart = DateTime::createFromFormat('H:i:s', $timeStarts);
        $dateTimeNow = DateTime::createFromFormat('H:i:s', $currentTime);
    
        $interval = $dateTimeStart->diff($dateTimeNow);
        $timeDifference = $interval->format('%H:%I:%S');
    
        echo $timeDifference;
    }
?>