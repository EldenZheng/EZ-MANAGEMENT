<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: startShift.php
// Description: to start the shift for all user
// First Written on: Tuesday, 20-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    $sqlStartShift="INSERT INTO shift (employeeID,shiftDate,shiftStart,shiftDuration) VALUES('$id',CURDATE(),CURTIME(),'00:00:00')";
    if (mysqli_query($con, $sqlStartShift)) {
        echo "Shift started successfully!";
    } else {
        echo "Error starting shift: " . mysqli_error($con);
    }
?>