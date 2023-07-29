<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: finishTask.php
// Description: to set the task as completed for Employees
// First Written on: Thursday, 22-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    $sql = "UPDATE project SET projectStatus = 1, completionDate = CURDATE() WHERE employeeID = '$id' AND projectStatus = 0 ORDER BY dueDate ASC LIMIT 1";
    $result = mysqli_query($con,$sql);
    echo "<script>alert('Task Finished!');window.location.href='HomeEmployee.php';</script>";
?>