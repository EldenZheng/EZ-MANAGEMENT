<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: attendanceReport.php
Description: attendance report page for HR
First Written on: Thursday, 22-June-2023
Edited on: Friday, 21-Jul-2023
-->
<?php 
    include("session.php");
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
    <title>Attendance Report</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .content { grid-area: content; }
    </style>
    <script>
        window.addEventListener('scroll', function() {
            var searchDiv = document.getElementById('searchDiv');
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > 0) {
            searchDiv.style.height = '50px'; // Set the desired smaller height when scrolling
            } else {
            searchDiv.style.height = ''; // Restore the original height when at the top of the page
            }
        });
        </script>
</head>
<body>
    <div class="container">
        <div class="sideNav">
            <ul>
                <!-- <li class="EZmanagement"><img style = "width: 80px;" src = "Images/EZgold.png" alt = "Logo">   EZ Management</li>
                &nbsp; -->
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
                <hr style="height: 2px; background-color: #a18400; border: none;">
                <li><a href="HomeHR.php" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> Home</a></li>
                <li><a href="addEmployee.php" title="Add Employee">&nbsp;<i class="fa-solid fa-user-plus"></i> Add Employee</a></li>
                <li><a href="manageEmployee.php" title="Manage Employee">&nbsp;<i class="fa-solid fa-users"></i> Manage Employee</a></li>
                <li><a class="selected" href="" title="Attendance Report">&nbsp;<i class="fa-solid fa-business-time"></i> | Attendance Report</a></li>
                <li><a href="employeeRating.php" title="Employee Rating">&nbsp;<i class="fa-solid fa-thumbs-up"></i> Employee Ratings</a></li>
                <li><a href="deleteEmployee.php" title="Fire Employee">&nbsp;<i class="fa-solid fa-user-xmark"></i> Layoff Employee</a></li>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
        <div class="content">
            <div style="width:74%; color: #a18400;background-color: #0D333E;border-radius:25px;padding:20px; position:fixed">
                <h1 style="font-size:50px; color:gold;">Search Employee by Filter</h1>
                <form method="GET" action="" style="font-size: 30px;">
                    <label for="txtEmployeeName">Employee Name:</label>
                    <input style="width:400px"type="text" name="txtEmployeeName" id="txtEmployeeName" value="<?php echo isset($_GET['txtEmployeeName']) ? $_GET['txtEmployeeName'] : ''; ?>">
                    &nbsp;
                    <label for="txtShiftDate">Shift Date:</label>
                    <input type="date" name="txtShiftDate" id="txtShiftDate" value="<?php echo isset($_GET['txtShiftDate']) ? $_GET['txtShiftDate'] : ''; ?>">
                    <button class='fltrBtn' type="submit"><i class='fa-solid fa-magnifying-glass'></i> Filter</button>
                </form>
            </div>
            <br><br><br><br><br><br><br><br><br>
            <!-- <hr style='height: 2px; background-color: #0D333E; border: none;'> -->
            <?php
                $sql = "
                SELECT employee.employeeID, employee.employeeName, shift.shiftID, shift.shiftDate, shift.shiftStart, shift.shiftDuration
                FROM employee
                LEFT JOIN shift ON employee.employeeID = shift.employeeID
                WHERE 1=1 ";
            
            if (!empty($_GET['txtEmployeeName'])) {
                $employeeName = $_GET['txtEmployeeName'];
                $sql .= "AND employee.employeeName LIKE '%$employeeName%' ";
            }
            
            if (!empty($_GET['txtShiftDate'])) {
                $shiftDate = $_GET['txtShiftDate'];
                $sql .= "AND shift.shiftDate = '$shiftDate' ";
            }
            
            $sql .= "ORDER BY employee.employeeID, shift.shiftDate ASC";
            $currentEmployeeID = null;
            $result= mysqli_query($con,$sql);
                while ($row = mysqli_fetch_assoc($result)) {
                $employeeID = $row['employeeID'];
                $employeeName = $row['employeeName'];

                // Check if a new employee is encountered
                if ($currentEmployeeID !== $employeeID) {
                    // Close the previous employee table if it exists
                    if ($currentEmployeeID !== null) {
                    echo "</table>";
                    }

                    // Output heading for the new employee
                    echo "<br><br><br><h1 style='text-align:center'>Employee: $employeeID - $employeeName</h1>";
                    echo "<hr style='height: 2px; background-color: #0D333E; border: none;'>";
                    echo "<table>
                            <tr>
                            <th>Shift ID</th>
                            <th>Shift Date</th>
                            <th>Shift Start</th>
                            <th>Shift Duration</th>
                            </tr>";

                    // Update the current employee ID
                    $currentEmployeeID = $employeeID;
                }

                // Output table row for each shift
                echo "<tr>
                        <td>".$row['shiftID']."</td>
                        <td>".$row['shiftDate']."</td>
                        <td>".$row['shiftStart']."</td>
                        <td>".$row['shiftDuration']."</td>
                        </tr>";
                }

                // Close the last employee table
                if ($currentEmployeeID !== null) {
                echo "</table>";
                } else {
                echo "No results found.";
                }

            ?>
        </div>
    </div>
</body>
</html>