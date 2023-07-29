<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: deleteEmployee.php
Description: delete employee page for HR
First Written on: Friday, 7-Jul-2023
Edited on: Friday, 21-Jul-2023
-->
<?php
    include ("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="UI.css"rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Lay Off</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .content { grid-area: content; }
    </style>
    <script>
        $(document).ready(function(){
            $(".Delete").hide();
        });
        function enableApproveButton(ID) {
            var approveButton = document.getElementById('approveButton_' + ID);
            approveButton.disabled = false;
        }
        function notifyLayoff(id){
            document.getElementById('id02').style.display='block';
            $.ajax({
                url: "notifyLayoff.php",
                method: "POST",
                data: {
					'empID' : id
				},
                success: function(response) {
                    // Handle the response from the PHP script
                    if(response=="Employee's Layoff Notified!"){
                        alert("Employee's Layoff Notified!");
                        location.reload();
                    }
                    else{
                        alert("Employee's Layoff Notified!");
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                    location.reload();
                }
            });
        }
        function deleteEmployee(id){
            $.ajax({
                url: "deletingEmployee.php",
                method: "POST",
                data: {
					'empID' : id
				},
                success: function(response) {
                    // Handle the response from the PHP script
                    if(response=="Employee's Record Deleted!"){
                        alert("Employee's Record Deleted!");
                        location.reload();
                    }
                    else{
                        alert("Employee's Record Deleted!");
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                    location.reload();
                }
            });
        }
        function showNotify(){
            $(".Delete").hide();
            $(".Notify").show();
        }
        function showDelete(){
            $(".Notify").hide();
            $(".Delete").show();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="sideNav">
            <ul>
                <div class="information" title="Your Information">
                    <li class="nameEmp"><?php echo $name; ?></li>
                    <li>Employee ID: <?php echo $id; ?></li>
                    <li><?php echo $ic; ?></li>
                    <li><?php echo $dept; ?></li>
                    <li><?php echo $email; ?></li>
                    <li><?php echo $phone; ?></li>
                    <li><?php echo $address; ?></li>
                    &nbsp;
                </div>
                <li><a style="margin-top:20px;font-size:25px"href="Profile.php" title="Edit Your Profile">&nbsp;<i class="fa-solid fa-pen-to-square"></i> Edit Profile</a></li>
                <hr>
                <li><a href="HomeHR.php" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> Home</a></li>
                <li><a href="addEmployee.php" title="Add Employee">&nbsp;<i class="fa-solid fa-user-plus"></i> Add Employee</a></li>
                <li><a href="manageEmployee.php" title="Manage Employee">&nbsp;<i class="fa-solid fa-users"></i> Manage Employee</a></li>
                <li><a href="attendanceReport.php" title="Attendance Report">&nbsp;<i class="fa-solid fa-business-time"></i> Attendance Report</a></li>
                <li><a href="employeeRating.php" title="Employee Rating">&nbsp;<i class="fa-solid fa-thumbs-up"></i> Employee Ratings</a></li>
                <li><a class="selected" href="" title="Fire Employee">&nbsp;<i class="fa-solid fa-user-xmark"></i> | Layoff Employee</a></li>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
        <div class="content">
            <div class="tab">
                <button type="button" onclick="showNotify()">Notify</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" onclick="showDelete()">Delete</button>
            </div>
            </p>
                <div id="id02" class="w3-modal">
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; color: #0FD46B; background-color: #0D333E; border-radius:25px;">
                        <div class="w3-center"><br>
                            <div class="w3-section">
                                <img style="width:50%" src = "Images/giphy.gif" alt = "Loading">
                                <h1>Please Wait</h1>
                            </div>
                        </div>			
                    </div>
                </div>
            <hr><br>
            <div class="Notify">
                <?php
                    // Perform the SQL query to fetch employee data, sorting by employeeRole
                    $sql = "SELECT *
                    FROM employee
                    WHERE NOT EXISTS (
                    SELECT 1
                    FROM emplayoff
                    WHERE emplayoff.empID = employee.employeeID
                    )
                    ORDER BY CASE WHEN employeeRole = 1 THEN 0 ELSE 1 END, employeeID ASC;
                    ";
                    $result = mysqli_query($con, $sql);

                    // Check if there are any employees with employeeRole 1
                    $hasEmployeeRole1 = false;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['employeeRole'] == 1) {
                            $hasEmployeeRole1 = true;
                            break;
                        }
                    }

                    // Display the table for employeeRole 1
                    if ($hasEmployeeRole1) {
                        echo "<div class='headerPage'>
                                    <h1 class='headerContent'>HR Department</h1>
                                </div><br>
                        <table style='width: 100%'>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Generate Layoff Letter</th>
                                    <th>Notify</th>
                                </tr>";

                        mysqli_data_seek($result, 0); // Reset the result set pointer

                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['employeeRole'] == 1) {
                                $employeeID = $row['employeeID'];
                                $employeeName = $row['employeeName'];
                                $employeeDept = $row['employeeDept'];

                                echo "<tr>
                                        <td>$employeeID</td>
                                        <td>$employeeName</td>
                                        <td><a href='generateLayoffLetter.php?empID=$employeeID' target='_blank' onclick='enableApproveButton($employeeID)'><i class='fa-solid fa-file-arrow-down'></i> Generate Letter</a></td>
                                        <td>
                                            <button style='width:150px' class='apprvBtn' id='approveButton_$employeeID' onclick='notifyLayoff($employeeID)' disabled><i class='fa-solid fa-bell'></i> Notify User</button>
                                        </td>
                                    </tr>";
                            }
                        }

                        echo "</table>";
                    }

                    // Display the table for other employees
                    mysqli_data_seek($result, 0); // Reset the result set pointer

                    echo "<br><br><br>
                        <div class='headerPage'>
                                <h1 class='headerContent'>Other Employees</h1>
                            </div><br>
                    <table style='width: 100%;'>
                            <tr>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Role</th>
                                <th>Employee Department</th>
                                <th>Employee Team</th>
                                <th>Generate Layoff Letter</th>
                                <th>Notify and Delete</th>
                            </tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['employeeRole'] != 1) {
                            $employeeID = $row['employeeID'];
                            $employeeName = $row['employeeName'];
                            $employeeDept = $row['employeeDept'];
                            $employeeTeam = $row['employeeTeam'];
                            $employeeRole = ($row['employeeRole'] == 2) ? "Supervisor" : "Employee";

                            echo "<tr>
                                    <td>$employeeID</td>
                                    <td>$employeeName</td>
                                    <td>$employeeRole</td>
                                    <td>$employeeDept</td>
                                    <td>Team $employeeTeam</td>
                                    <td><a href='generateLayoffLetter.php?empID=$employeeID' target='_blank' onclick='enableApproveButton($employeeID)'><i class='fa-solid fa-file-arrow-down'></i> Generate Letter</a></td>
                                    <td>
                                        <button style='width:150px' class='apprvBtn' id='approveButton_$employeeID' onclick='notifyLayoff($employeeID)' disabled><i class='fa-solid fa-bell'></i> Notify User</button>
                                    </td>
                                </tr>";
                        }
                    }

                    echo "</table>";
                ?>
            </div>
            <div class="Delete">
                <h1>Notified Employee That Can Be Deleted</h1>
                <!-- <hr style='height: 2px; background-color: #0D333E; border: none;'> -->
                <?php
                    $sqlNotified = "SELECT e.employeeID, e.employeeName, r.retiredID, r.empID 
                                    FROM emplayoff r 
                                    INNER JOIN employee e ON e.employeeID = r.empID";
                    $result2 = mysqli_query($con, $sqlNotified);

                    if (mysqli_num_rows($result2) > 0) {
                        echo "<table style='width: 100%'>";
                        echo "<tr>";
                        echo "<th>Retired ID</th>";
                        echo "<th>Employee ID</th>";
                        echo "<th>Employee Name</th>";
                        echo "<th>Delete</th>";
                        echo "</tr>";

                        while ($row = mysqli_fetch_assoc($result2)) {
                            echo "<tr>";
                            echo "<td>".$row['retiredID']."</td>";
                            echo "<td>".$row['empID']."</td>";
                            echo "<td>".$row['employeeName']."</td>";
                            echo "<td><button class='rjctBtn' onclick='deleteEmployee(".$row['empID'].")'><i class='fa-solid fa-circle-xmark'></i> Delete</button></td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "<h1>No Employee Notified</h1>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>