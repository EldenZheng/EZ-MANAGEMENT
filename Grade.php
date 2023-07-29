<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: Grade.php
Description: to grade team member for supervisor
First Written on: Friday, 23-June-2023
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
    <title>Grading</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .content { grid-area: content; }
    </style>
    <script>
        function gradeEmployee(prid, emid){
            var rating = $('#ratingDropdown'+prid).val();
            $.ajax({
				url: 'grading.php',
				type: 'post',
				data: {
					'projectID' : prid,
                    'employeeID' : emid,
                    'score' : rating
				},
				success: function(response){
                    if(response == "Success!"){
                        alert('Employee Rated!');
                        location.reload();
                    }
				}
			});
        }
        function disableButton(selectElement, projectID) {
            var selectedValue = $(selectElement).val();
            var gradeButton = $("#gradeButton" + projectID);
            
            if (selectedValue === "") {
                gradeButton.prop("disabled", true);
            } else {
                gradeButton.prop("disabled", false);
            }
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
                        <li>Employee Supervisor</li>
                        <li><?php echo $dept; ?> - Team <?php echo $team; ?></li>
                        <li><?php echo $email; ?></li>
                        <li><?php echo $phone; ?></li>
                        <li><?php echo $address; ?></li>
                        <br>
                    </div>
                    <li><a style="margin-top:20px;font-size:25px"href="Profile.php" title="Edit Your Profile">&nbsp;<i class="fa-solid fa-pen-to-square"></i> Edit Profile</a></li>
                    <hr>
                    <li><a href="HomeSupervisor.php" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> Home</a></li>
                    <li><a onclick="document.getElementById('reqLet').style.display='block'">&nbsp;<i class="fa-solid fa-file-lines"></i> Request Letter</a></li>        
                    <li><a onclick="document.getElementById('reqLeav').style.display='block'">&nbsp;<i class="fa-solid fa-person-walking"></i> Request Leave</a></li>
                    <!-- <li><a href="Assigntask.php" title="Assign Task for Team Member">Assign Task</a></li> -->
                    <li><a class="selected" href="Grade.php" title="Grade Team Member">&nbsp;<i class="fa-solid fa-pen-ruler"></i> | Grade Employee</a></li>
                    <br><br>
                    <hr>
                    <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
                </ul>
        </div>
        <div class="content">
            <div class="headerPage">
                <h1 class="headerContent">Rate the Employee Based on Their Task</h1>
            </div><br>
            <div id="reqLet" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; color: #0FD46B; background-color: #0D333E; border-radius:25px;">
        
            <div class="w3-center"><br>
                <span onclick="document.getElementById('reqLet').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                <h1><i class="fa-solid fa-file-lines"></i> Request Referral Letter</h1>
            </div>
        
            <form class="w3-container" action="SubmitLetter.php" method="post">
                <div class="w3-section">
                    <label style="font-size:20px">Are you sure you want to submit a request to generate a Referral letter?</label>
                    <br><br>
                    <div style="text-align:center">
                        <button style="height:50px;width: 125px" class='fltrBtn' id="SubmitLetter" type="Submit" name="BtnSubmit"><i class='fa-solid fa-check'></i> Yes</button>
                        <a onclick="document.getElementById('reqLet').style.display='none'" title="Close Modal" style="cursor: pointer; font-size:20px"><i class='fa-solid fa-xmark'></i> No</a>
                    </div>
                </div>
            </form>					
            </div>
        </div>
        </p>
            <div id="reqLeav" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; color: #0FD46B; background-color: #0D333E; border-radius:25px;">
            
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('reqLeav').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                    <h1><i class="fa-solid fa-person-walking"></i> Request Leave</h1>
                </div>
            
                <form class="w3-container" action="SubmitLeave.php" method="post">
                    <div class="w3-section" style="text-align:center; font-size:20px">
                        <br><label><b>Leave Type: </b></label><br>
                        <select name="cmbLeavetype" id="leavepick" required>
                            <option value="">Select Leave Type</option>
                            <option value="Sick">Sick Leave</option>
                            <option value="Annual">Annual Leave</option>
                        </select>
                        <br><label><b>Request Date: </b></label><br>
                        <input type="date" name="leaveDay" id="leaveDay">
                        <br><label><b>Duration: </b></label><br>
                        <select name="duration" id="duration" required>
                            <option value="">Select Leave duration</option>
                            <option value="1">1 Day</option>
                            <option value="2">2 Days</option>
                            <option value="3">3 Days</option>
                        </select><br><br>
                        <button class='fltrBtn' id="SubmitLeave" type="Submit"name="BtnSubmit"><i class='fa-solid fa-check'></i> Submit</button><br><br>
                    </div>
                </form>					
                </div>
            </div>
        <?php
            $sqlFinishedProject = "SELECT project.*, employee.employeeName
            FROM project
            LEFT JOIN employee
            ON project.employeeID = employee.employeeID
            WHERE project.projectStatus = 1 AND project.employeeRating = 0 AND employee.employeeDept = '$dept' AND employee.employeeTeam = '$team' 
            ORDER BY project.dueDate ASC";
            $result = mysqli_query($con, $sqlFinishedProject);

            // Create an associative array to store the table HTML for each unique employee
            $tables = array();

            // Loop through the query results
            while ($row = mysqli_fetch_assoc($result)) {
                $employeeID = $row['employeeID'];
                $empName = $row['employeeName'];

                // Check if the employee ID is already stored in the array
                if (!isset($tables[$employeeID])) {
                    // Create a new table HTML string for the employee
                    $tables[$employeeID] = "<h1 style='font-size:65px; text-align:center'>Employee: $employeeID - $empName</h1>
                                            <hr>
                                            <table>
                                                <tr>
                                                    <th>Project ID</th>
                                                    <th>Project Name</th>
                                                    <th>Completion Date</th>
                                                    <th>Due Date</th>
                                                    <th>Rating</th>
                                                    <th>Action</th>
                                                </tr>";
                }

                // Append the table row HTML for each project to the corresponding employee's table
                $tables[$employeeID] .= "<tr>
                                            <td>".$row['projectID']."</td>
                                            <td>".$row['projectName']."</td>
                                            <td>".$row['completionDate']."</td>
                                            <td>".$row['dueDate']."</td>
                                            <td>
                                                <select id='ratingDropdown".$row['projectID']."' onchange='disableButton(this, ".$row['projectID'].")'>
                                                    <option value=''>Select Rating</option>
                                                    <option value='1'>1</option>
                                                    <option value='2'>2</option>
                                                    <option value='3'>3</option>
                                                    <option value='4'>4</option>
                                                    <option value='5'>5</option>
                                                </select>
                                            </td>
                                            <td><button id='gradeButton".$row['projectID']."' class='apprvBtn' onclick='gradeEmployee(".$row['projectID'].", ".$row['employeeID'].")' disabled><i class='fa-solid fa-thumbs-up'></i> Grade</button></td>
                                        </tr>";
            }
            if (empty($tables)) {
                echo "<h1 style='font-size:40px; text-align:center'>- Nothing to Rate -</h1>";
            }
            // Output the tables for each employee
            foreach ($tables as $table) {
                // Close the table for each employee
                $table .= "</table><br><br><br>";
                echo $table;
            }
            ?>

        </div>
    </div>
</body>
</html>