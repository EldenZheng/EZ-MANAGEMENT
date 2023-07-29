<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: employeeRating.php
Description: see all employee total ratings for HR
First Written on: Thursday, 6-Jul-2023
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
    <title>Employee Rating</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .content { grid-area: content; }
    </style>
    <script>
        function enableApproveButton(ID) {
            var approveButton = document.getElementById('approveButton_' + ID);
            approveButton.disabled = false;
        }
        function notifyPromotion(id){
            document.getElementById('id02').style.display='block';
            $.ajax({
                url: "notifyPromotion.php",
                method: "POST",
                data: {
					'empID' : id
				},
                success: function(response) {
                    // Handle the response from the PHP script
                    if(response=="Employee's Promotion Notified!"){
                        alert("Employee's Promotion Notified!");
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                }
            });
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
                <li><a class="selected" href="employeeRating.php" title="Employee Rating">&nbsp;<i class="fa-solid fa-thumbs-up"></i> | Employee Ratings</a></li>
                <li><a href="deleteEmployee.php" title="Fire Employee">&nbsp;<i class="fa-solid fa-user-xmark"></i> Layoff Employee</a></li>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
        <div class="content">
            <div class="headerPage">
                <h1 class="headerContent">List of Employees and Their Total Rating</h1>
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
            <!-- <hr style='height: 2px; background-color: #0D333E; border: none;'> -->
            <?php
                // Perform the SQL query to fetch employee data
                $sql = "SELECT * FROM employee where employeeRole=3 HAVING employeeTotalRating <= 5000";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table style='width: 100%'>
                            <tr>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Employee Department</th>
                                <th>Employee Team</th>
                                <th>Total Rating</th>
                                <th style='width:200px'>Progress</th>
                                <th>Generate Promotion Letter</th>
                                <th>Notify</th>
                            </tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        $employeeID = $row['employeeID'];
                        $employeeName = $row['employeeName'];
                        $employeeDept = $row['employeeDept'];
                        $employeeTeam = $row['employeeTeam'];
                        $totalRating = $row['employeeTotalRating'];

                        echo "<tr>
                                <td>$employeeID</td>
                                <td>$employeeName</td>
                                <td>$employeeDept</td>
                                <td>Team $employeeTeam</td>
                                <td>$totalRating / 5000</td>
                                <td>
                                    <div class='progress'>
                                        <div class='progress-bar' style='width: " . ($totalRating / 5000) * 100 . "%;'></div>
                                    </div>
                                </td>
                                <td>";

                        if ($totalRating >= 5000) {
                            echo "<a href='generatePromotionLetter.php?empID=$employeeID' target='_blank' onclick='enableApproveButton($employeeID)'><i class='fa-solid fa-file-arrow-down'></i> Generate Letter</a>";
                        } else {
                            echo "N/A";
                        }

                        echo "</td>
                                <td>
                                    <button class='apprvBtn' id='approveButton_$employeeID' onclick='notifyPromotion($employeeID)' disabled><i class='fa-solid fa-bell'></i> Notify User</button>
                                </td>
                            </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No employees found.";
                }
            ?>
        </div>
    </div>
</body>
</html>