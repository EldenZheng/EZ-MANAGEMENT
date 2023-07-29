
<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: approveLeaveRequest.php
// Description: approving employee's leave request and sending letter
// First Written on: Sunday, 25-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    include "mail.php";

    $reqID = $_POST['leaveID'];
    $sqlapproveleav="UPDATE requestleave SET approvalStatus=1 where leaveID=$reqID";
    mysqli_query($con,$sqlapproveleav);

    $sqlInfo="SELECT * FROM requestleave where leaveID=$reqID";
    $result=mysqli_query($con,$sqlInfo);
    $row = mysqli_fetch_assoc($result);
    $leavetype = $row['leaveType'];
    $leavedate = $row['leaveDate'];
    $leaveduration = $row['leaveDuration'];
    $empID = $row['employeeID'];
    $sqlGetDet = "SELECT * FROM employee where employeeid=$empID";
    $result2 = mysqli_query($con,$sqlGetDet);
    $rows = mysqli_fetch_assoc($result2);
    $empEmail = $rows['employeeEmail'];
    $empName = $rows['employeeName'];

    $to = $empEmail; // Email address of the recipient
    $subject = "Leave Approval Email - $empName"; // Subject of the email
    $message = "Dear $empName,<br><br>";
    $message .= "We are pleased to inform you that your leave request has been approved. Please find the details below:<br><br>";
    $message .= "Leave Type: $leavetype<br>";
    $message .= "Start Date: $leavedate<br>";
    $message .= "Leave Duration: $leaveduration day(s)<br><br>";
    $message .= "If you have any questions or need further assistance, please feel free to contact us.<br><br>";
    $message .= "Best regards,<br>";
    $message .= "$name<br>HR Department<br><br>"; // Body of the email

    
    if(send_mail($to,$subject,$message,$empName,$name)){
        echo "Employee's Leave Request Approved!";
    }else{
        echo "Error Executing Function Please Report to IT";
    }
?>