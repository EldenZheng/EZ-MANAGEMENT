<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: manageEmployee.php
Description: Manage Employee Page to see all of the employee for HR to modify
First Written on: Wednesday, 21-June-2023
Edited on: Friday, 21-Jul-2023
-->
<?php
    include("session.php");
    include("conf.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="UI.css"rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employee</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .content { grid-area: content; }
    </style>
    <script type="text/javascript">
        function modifyEmployee(employeeID){
            // Redirect the user to modifyEmployee.php with the employeeID parameter
            window.location.href = 'modifyEmployee.php?employeeID=' + employeeID;
        }
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
                <hr>
                <li><a href="HomeHR.php" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> Home</a></li>
                <li><a href="addEmployee.php" title="Add Employee">&nbsp;<i class="fa-solid fa-user-plus"></i> Add Employee</a></li>
                <li><a class="selected" href="" title="Manage Employee">&nbsp;<i class="fa-solid fa-users"></i> | Manage Employee</a></li>
                <li><a href="attendanceReport.php" title="Attendance Report">&nbsp;<i class="fa-solid fa-business-time"></i> Attendance Report</a></li>
                <li><a href="employeeRating.php" title="Employee Rating">&nbsp;<i class="fa-solid fa-thumbs-up"></i> Employee Ratings</a></li>
                <li><a href="deleteEmployee.php" title="Fire Employee">&nbsp;<i class="fa-solid fa-user-xmark"></i> Layoff Employee</a></li>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
        <div class="content">
            <div class="headerPage">
                <h1 class="headerContent">Lists of All Employee</h1>
            </div><br><br>
        <!-- <hr style='height: 2px; background-color: #0D333E; border: none;'> -->
        <?php
            $sql = "
            SELECT *
            FROM employee
            ORDER BY 
                CASE WHEN employeeDept = 'HR Department' THEN 0 ELSE 1 END ASC,
                SUBSTRING_INDEX(employeeDept, ' ', 1) ASC,
                SUBSTRING_INDEX(SUBSTRING_INDEX(employeeDept, ' ', -1), ' ', 1) ASC,
                employeeTeam ASC,
                CASE WHEN employeeRole = 2 THEN 0 ELSE 1 END ASC;
            ";

            // Execute the query
            $result = mysqli_query($con, $sql);

            // Check if any results are returned
            if (mysqli_num_rows($result) > 0) {
                $currentDept = null; // Variable to track the current department
                $currentTeam = null; // Variable to track the current team
                $hrEmployeesExist = false; // Flag to check if any HR employees exist

                // Loop through the results
                while ($row = mysqli_fetch_assoc($result)) {
                    $employeeDept = $row['employeeDept'];
                    $employeeTeam = $row['employeeTeam'];

                    // Check if a new department is encountered
                    if ($currentDept !== $employeeDept) {
                        // Close the previous department table if it exists
                        if ($currentDept !== null) {
                            echo "</table><br><br><br><br><br><br>";
                        }
                        // Output heading for the new department
                        if($employeeDept=="HR Department"){
                            echo "<h1 style='font-size:50px; text-align: center;'>$employeeDept</h1>";
                            echo "<hr>";
                        }
                        else{
                            echo "<div class='headerPage'>
                                    <h1 style='font-size:45px; text-align: center; color:#a18400 ;'>$employeeDept</h1>
                                </div><br>";
                        }

                        // Check if the department is HR
                        if ($employeeDept === 'HR Department') {
                            // Create a flag to track if any HR employees are found
                            $hrEmployeesExist = true;

                            // Output table headers for the HR department
                            echo "<table>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Modify Employee</th>
                                    </tr>";
                        } else {
                            // Output table headers for the new department
                            echo "<h1 style='font-size:45px;'>Team $employeeTeam</h1>
                            <hr>
                                <table>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Employee Role</th>
                                        <th>Modify Employee</th>
                                    </tr>";
                        }

                        // Update the current department and team
                        $currentDept = $employeeDept;
                        $currentTeam = $employeeTeam;
                    }

                    // Check if a new team is encountered within the same department
                    if ($currentTeam !== $employeeTeam && $employeeDept !== 'HR Department') {
                        // Output a new table for the new team
                        echo "</table><br><br><br>";
                        echo "<h1 style='font-size:45px;'>Team $employeeTeam</h1>
                        <hr>
                            <table>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Employee Role</th>
                                    <th>Modify Employee</th>
                                </tr>";

                        // Update the current team
                        $currentTeam = $employeeTeam;
                    }

                    // Output table row for each employee
                    if ($employeeDept === 'HR Department') {
                        // Display HR employee without team and role
                        echo "<tr>
                                <td>".$row['employeeID']."</td>
                                <td>".$row['employeeName']."</td>
                                <td><button class='apprvBtn' onclick=modifyEmployee(".$row['employeeID'].")><i class='fa-solid fa-pen-to-square'></i> Modify</button></td>
                            </tr>";
                    } else {
                        // Display non-HR employee with team and role
                        echo "<tr>
                                <td>".$row['employeeID']."</td>
                                <td>".$row['employeeName']."</td>";
                                if ($row['employeeRole'] == 2) {
                                    // Display supervisor role for role 2
                                    echo "<td>Supervisor</td>";
                                } elseif ($row['employeeRole'] == 3) {
                                    // Display employee role for role 3
                                    echo "<td>Employee</td>";
                                }
                        echo"
                                <td><button class='apprvBtn' onclick=modifyEmployee(".$row['employeeID'].")><i class='fa-solid fa-pen-to-square'></i> Modify</button></td>
                            </tr>";
                    }
                }

                // Close the last table
                echo "</table>";

                // Check if any HR employees exist
                if (!$hrEmployeesExist) {
                    echo "<p>No HR employees found.</p>";
                }
            } else {
                echo "No results found.";
            }
            ?>
        </div>
    </div>
    
</body>
</html>