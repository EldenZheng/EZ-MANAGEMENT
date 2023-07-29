<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: generatePromotionLetter.php
// Description: to generate promotion letter for HR
// First Written on: Friday, 7-Jul-2023
// Edited on: Friday, 21-Jul-2023
    include("conf.php");
    include("session.php");
    $empID=$_GET['empID'];
    $sqlGetDet = "SELECT * FROM employee where employeeid=$empID";
    $result = mysqli_query($con,$sqlGetDet);
    $rows = mysqli_fetch_assoc($result);
    $empEmail = $rows['employeeEmail'];
    $empName = $rows['employeeName'];
    $empDept = $rows['employeeDept'];
    $empTeam = $rows['employeeTeam'];
    $empHireDate = $rows['employeeHireddate'];
    $sqlUpdate = "INSERT INTO requestletter(employeeID, letterType, generatedDate, approvalStatus) VALUES ($empID, 'Promotional', CURDATE(), 1)";
    mysqli_query($con,$sqlUpdate);
    // Load library 
    include_once 'HtmlToDoc.class.php';  
                
    // Initialize class 
    $htd = new HTML_TO_DOC();
    $letterContent = "
    <html>
        <head>
            <style>
                body {
                    font-family: Arial;
                    font-size: 16px;
                    text-align: justify;
                    text-justify: inter-word;
                }
                h1 {
                    font-size: 23.5px;
                    font-weight: bold;
                    text-decoration: underline;
                }
                .name{
                    font-weight: bold;
                    text-decoration: underline;
                }
                .center {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <h1 class='center'>Promotional Letter</h1>
            <p>Dear, $empName</p>
            <br><br>
            <p>
                We hereby inform you that the Management has decided to grant a promotion with the following details:
            </p>
            <p>Name: $empName</p>
            <p>IC: $empDept</p>
            <p>Role: Employee</p>
            <p>Dept: $empDept - Team $empTeam</p>
            <br>
            <p>Promoted to:</p>
            <p>Role: Supervisor</p>
            <p>Dept: $empDept - Team $empTeam</p>
            <br>
            <p>
                If there are any errors or changes regarding the content of this decision in the future, this decision letter will be reviewed.
            </p>
            <p>
                NOTE: Please finish all of the task assigned to you by your current supervisor first and confirm it to the HR Department to be promoted to your new role
            </p>
            <br>
            <div>
                <p>Malaysia, " . date('F j, Y') . "</p>
                <br /><br /><br /><br /><br /><br />
                <p class='name'>$name</p>
                <p>HR Department</p>
            </div>
        </body>
    </html>
        ";
        $fileName = 'Promotion_Letter_'.$empName.'_'.date('F j, Y');
        $htd->createDoc($letterContent, $fileName, 1);
?>