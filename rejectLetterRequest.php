<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: rejectLetterRequest.php
// Description: to notify the rejection of letter request by email
// First Written on: Sunday, 25-June-2023
// Edited on: Friday, 21-Jul-2023
    include("conf.php");
    include("session.php");
    include "mail.php";

    $reqID = $_POST['letterID'];
    $sqlrejlet="UPDATE requestletter SET approvalStatus=2 where letterID=$reqID";
    mysqli_query($con,$sqlrejlet);

    $sqlInfo="SELECT * FROM requestletter where letterID=$reqID";
    $result=mysqli_query($con,$sqlInfo);
    $row = mysqli_fetch_assoc($result);
    $empID = $row['employeeID'];
    $sqlGetDet = "SELECT * FROM employee where employeeid=$empID";
    $result2 = mysqli_query($con,$sqlGetDet);
    $rows = mysqli_fetch_assoc($result2);
    $empEmail = $rows['employeeEmail'];
    $empName = $rows['employeeName'];
    $empDept = $rows['employeeDept'];
	$empRole = $rows['employeeRole'];
    $empTeam = $rows['employeeTeam'];
    $empHireDate = $rows['employeeHireddate'];

    $to = $empEmail; // Email address of the recipient
    $subject = "Letter Rejection Email - $empName"; // Subject of the email
    $message = "Dear $empName,<br><br>";
    $message .= "We are sorry to inform you that your letter request has been rejected. <br><br>";
    $message .= "If you have any questions or need further assistance, please feel free to contact us.<br><br>";
    $message .= "Best regards,<br>";
    $message .= "$name<br>HR Department<br><br>"; // Body of the email

    
    
    if(send_mail($to,$subject,$message,$empName,$name)){
        echo "Employee's Letter Request Rejected!";
        
    }else{
        echo "Error Executing Function Please Report to IT";
    }
?>