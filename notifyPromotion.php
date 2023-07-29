<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: notifyPromotion.php
// Description: to notify employee about their promotion this is for HR
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
    $subject = "Notification for Promotion - $empName"; // Subject of the email
    $message = "Dear $empName,<br><br>";
    $message .= "We are thrilled to inform you that your hard work, dedication, and outstanding performance have been recognized. It is with great pleasure that we announce your promotion within our company.<br><br>";
    $message .= "Your commitment, professionalism, and exceptional contributions to our team have not gone unnoticed. Your promotion to supervisor of $empDept - Team $empTeam is a testament to your skills, expertise, and the value you bring to our organization. ";
    $message .= "With this promotion, you will assume your new responsibilities and continue to make a significant impact on our team and company as a whole. We are confident that you will excel in this role, leading by example and inspiring your colleagues along the way. ";
    $message .= "we also want to express our appreciation for your ongoing dedication and the positive influence you have on our workplace culture. Your continued growth and success are integral to our company's achievements, and we look forward to witnessing your further accomplishments.<br><br>";
    $message .= "Once again, congratulations on your well-deserved promotion! We believe this is just the beginning of a remarkable journey for you, and we are proud to have you as part of our team. ";
    $message .= "Come pick up the printed promotional letter for negotiation and terms in the HR office<br><br>";
    $message .= "NOTE: Please finish all of the task assigned to you by your current supervisor first and confirm it to the HR Department to be promoted to your new role<br><br>";
    $message .= "If you have any questions or need further assistance, please feel free to contact us.<br><br>";
    $message .= "Best regards,<br>";
    $message .= "$name<br>HR Department<br><br>"; // Body of the email
    
    if(send_mail($to,$subject,$message,$empName,$name)){
        $sqlExceed="UPDATE employee
        SET employeeTotalRating = 5001
        WHERE employeeID = $empID";
        if(mysqli_query($con,$sqlExceed)){
            echo "Employee's Promotion Notified!";
        }
    }else{
        echo "<script>alert('Error Executing Function Please Report to IT');</script>";
    }
?>