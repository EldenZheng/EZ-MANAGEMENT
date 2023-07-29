<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: generateReferralLetter.php
// Description: to generate referral letter for HR
// First Written on: Wednesday, 28-June-2023
// Edited on: Friday, 21-Jul-2023
    include("session.php");
    $reqID=$_GET['letID'];
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
    if ($empRole == 3) {
        $employeeRole = "Employee";
    } elseif ($empRole == 2) {
        $employeeRole = "Supervisor";
    }
    $sqlUp="UPDATE requestletter SET generatedDate = CURDATE() WHERE letterID = $reqID;";
    mysqli_query($con,$sqlUp);
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
                .name{SSS
                    font-weight: bold;
                    text-decoration: underline;
                }
                .center {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <h1 class='center'>To Whom It May Concern</h1>
            <br><br>
            <p>This is to certify that:</p>
            <br><br>
            <div class='center'>
                <p><strong>Mr./Mrs. $empName </strong></p>
            </div>
            <br>
            <p>
                Has been employed by our company since $empHireDate, with his/her position as $employeeRole - $empDept - Team $empTeam.
            </p>
            <br>
            <p>
                During his/her working period, he/her has performed his/her duties to our satisfaction.
            </p>
            <br>
            <p>
                His/Her contract has been finished in our company and we thank him for all his/her efforts and dedications 
                to the company and wish him/her luck for his/her future appointment.
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
        $fileName = 'Referral_Letter_'.$empName.'_'.date('F j, Y');
        $htd->createDoc($letterContent, $fileName, 1);
?>