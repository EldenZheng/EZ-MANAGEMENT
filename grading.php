<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: grading.php
// Description: to update the rating of the employee
// First Written on: Saturday, 24-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    $prid = $_POST['projectID'];
    $emid = $_POST['employeeID'];
	$score = $_POST['score'];
    $sqlsetComplete="UPDATE project SET employeeRating = '$score' WHERE projectID = $prid;";
    if(mysqli_query($con,$sqlsetComplete)){
        $sqlIncrease="UPDATE employee SET employeeTotalRating = employeeTotalRating + $score WHERE employeeID = $emid";
        if(mysqli_query($con,$sqlIncrease)){
            echo "Success!";
        }
    }  
?>