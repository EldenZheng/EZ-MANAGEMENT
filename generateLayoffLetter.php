<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: generateLayoffLetter.php
// Description: to generate lay off letter for HR
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
    $empRole = $rows['employeeRole'];
    if ($empRole == 3) {
        $employeeRole = "Employee";
    } elseif ($empRole == 2) {
        $employeeRole = "Supervisor";
    }
    $sqlUpdate = "INSERT INTO requestletter(employeeID, letterType, generatedDate, approvalStatus) VALUES ($empID, 'LayOff', CURDATE(), 1)";
    mysqli_query($con,$sqlUpdate);
    $nextWeek = strtotime('+1 week');
    $expire = date('F j, Y', $nextWeek);
    $adaynextweek = strtotime('+8 days');
    $effective = date('F j, Y', $adaynextweek);
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
                .name {
                    font-weight: bold;
                    text-decoration: underline;
                }
                .center {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <h1 class='center'>Notification of Contract Termination</h1>
            <br><br><br>
            <p>Dear $empName,</p>
            <br><br>
            <p>
                We hereby inform you that your employment will expire on $expire, and the Management has decided not to extend your employment. Therefore, effective from $effective, you will no longer be employed as a $employeeRole for $empDept - Team $empTeam.
            </p>
            <br>
            <p>
                We would like to express our utmost gratitude for your cooperation during your tenure with the company.
            </p>
            <br><br>
            <p>
                NOTE: Please finish all of the task assigned to you by your current supervisor first and confirm it to the HR Department to get the severence package and support from the HR Department
            </p>
            <br>
            <p>
                Best regards,
            </p>
            <br /><br /><br /><br /><br /><br /><br />
            <p class='name'>$name</p>
            <p>HR Department</p>
        </body>
        </html>
        ";

        $fileName = 'LayOff_Letter_'.$empName.'_'.date('F j, Y');
        $htd->createDoc($letterContent, $fileName, 1);
?>