<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: assigningTask.php
// Description: for supervisor to assign task to their team
// First Written on: Friday, 23-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    if(isset($_POST['assign']))
    {
        $empID = $_POST["txtID"];
        $taskName = $_POST["txtTask"];
        $dueDate = $_POST["dueDate"];

        $sql="INSERT INTO project (projectName,employeeID,dueDate,projectStatus,employeeRating) VALUES('$taskName','$empID','$dueDate','0','0')";
        mysqli_query($con,$sql);
        echo "<script>alert('Task Assigned!');window.location.href='HomeSupervisor.php';</script>";
    }
?>