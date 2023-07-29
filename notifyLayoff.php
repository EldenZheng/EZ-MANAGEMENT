<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: notifyLayoff.php
// Description: to send email to employee about their layoff this is for HR
// First Written on: Friday, 7-Jul-2023
// Edited on: Friday, 21-Jul-2023
    include("conf.php");
    include("session.php");
    include "mail.php";
                
        
    $empID = $_POST['empID'];
    $sqlGetDet = "SELECT * FROM employee where employeeid=$empID";
    $result = mysqli_query($con,$sqlGetDet);
    $rows = mysqli_fetch_assoc($result);
    $empEmail = $rows['employeeEmail'];
    $empName = $rows['employeeName'];
    $empDept = $rows['employeeDept'];
	$empRole = $rows['employeeRole'];
    $empTeam = $rows['employeeTeam'];

    $to = $empEmail; // Email address of the recipient
    $subject = "Notification of Layoff - $empName"; // Subject of the email
    $message = "Dear $empName,<br><br>";
    $message .= "We regret to inform you that due to unforeseen circumstances and business restructuring, the management has made the difficult decision to implement a layoff process. Unfortunately, this decision also affects your employment with our company<br><br>";
    $message .= "During your time with us, you have made valuable contributions to the company, and we sincerely appreciate your dedication and hard work. However, the current situation requires us to make necessary adjustments to ensure the company's long-term viability. ";
    $message .= "Effective next week, your employment with our company will be terminated. We understand that this news may come as a shock, and we want to assure you that this decision was not taken lightly. ";
    $message .= "We are committed to providing you with support during this transition period. Our Human Resources department will assist you with the necessary paperwork, including information on your final paycheck, benefits, and any severance package, if applicable.<br><br>";
    $message .= "We encourage you to reach out to our HR department to address any questions or concerns you may have regarding the layoff process. They will be available to provide guidance and assistance to help make this transition as smooth as possible. ";
    $message .= "We want to express our gratitude for your contributions to our company. Your hard work and dedication have been invaluable, and we wish you the best in your future endeavors<br><br>";
    $message .= "The HR Department will deliver to your desk the Lay Off letter for better details and information about the process<br><br>";
    $message .= "Thank you for your understanding.<br><br>";
    $message .= "NOTE: Please finish all of the task assigned to you by your current supervisor first and confirm it to the HR Department to get the severence package and support from the HR Department<br><br>";
    $message .= "If you have any questions or need further assistance, please feel free to contact us.<br><br>";
    $message .= "Best regards,<br>";
    $message .= "$name<br>HR Department<br><br>"; // Body of the email
    
    if(send_mail($to,$subject,$message,$empName,$name)){
        $sqlExceed="INSERT INTO `emplayoff` (empID) VALUES ($empID)";
        if(mysqli_query($con,$sqlExceed)){
            echo "Employee's Layoff Notified!";
        }
    }else{
        echo "<script>alert('Error Executing Function Please Report to IT');</script>";
    }
?>