<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: deletingEmployee.php
// Description: to remove all of the data about employee across all of the tables
// First Written on: Friday, 7-Jul-2023
// Edited on: Friday, 21-Jul-2023
    include("conf.php");
    $empID = $_POST['empID'];
    $sqlDel = "DELETE e, p, rl, rlet, s
    FROM employee e
    LEFT JOIN project p ON e.employeeID = p.employeeID
    LEFT JOIN requestleave rl ON e.employeeID = rl.employeeID
    LEFT JOIN requestletter rlet ON e.employeeID = rlet.employeeID
    LEFT JOIN shift s ON e.employeeID = s.employeeID
    WHERE e.employeeID = $empID";
    if(mysqli_query($con,$sqlDel)){
        echo"Employee's Record Deleted!";
    }
    
?>