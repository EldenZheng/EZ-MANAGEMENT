<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: HomeSupervisor.php
Description: Home Page for supervisor
First Written on: Friday, 16-June-2023
Edited on: Friday, 21-Jul-2023
-->
<?php
    include("session.php");
    include("conf.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="UI.css"rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .content { grid-area: content; }
    </style>
    <script src="nameresize.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
			<?php
                $sqlshi = "SELECT employeeID FROM shift WHERE employeeID='$id' AND shiftDate = CURDATE()";
                $result = mysqli_query($con, $sqlshi);
                $count = mysqli_num_rows($result);
                
                if ($count == 1) {
                    $sqlduration = "SELECT employeeID FROM shift WHERE employeeID='$id' AND shiftDate = CURDATE() AND shiftDuration='0'";
                    $resultD = mysqli_query($con, $sqlduration);
                    $counting = mysqli_num_rows($resultD);
                    
                    if ($counting == 1) {
                        $sqltime = "SELECT * FROM shift WHERE employeeID='$id' AND shiftDate = CURDATE()";
                        $result1 = mysqli_query($con, $sqltime);
                        $Row = mysqli_fetch_assoc($result1);
                        $timeStarts = $Row["shiftStart"];
                        $currentTime = date("H:i:s", strtotime("+8 hours"));
                        $dateTimeStart = DateTime::createFromFormat('H:i:s', $timeStarts);
                        $dateTimeNow = DateTime::createFromFormat('H:i:s', $currentTime);
                
                        $interval = $dateTimeStart->diff($dateTimeNow);
                        $timeDifference = $interval->format('%H:%I:%S');
                        
                        echo '$(".shift").hide();';
                        echo '$(".shiftStarts").show();';
                        echo '$("#shiftDuration").text("Shift Duration: '.$timeDifference.'");';
                    } else {
                        echo '$("#shiftStatus").text("Shift Already Completed!");';
                        echo '$("#startShiftBtn").hide();';
                    }
                } else {
                    echo '$("#shiftStatus").text("Shift Have Not Started");';
                } 
			?>
		});
        </script>
        <script type="text/javascript">
        function startShift(){
            $(".shift").hide();
            $(".shiftStarts").show();
            $.ajax({
                url: "startShift.php", // PHP script to handle startShift request
                method: "POST",
                success: function(response) {
                    // Handle the response from the PHP script
                    console.log(response);
                    $("#shiftDuration").text("Shift Duration: Just Started");
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                }
            });
        }
        function endShift(){
            $(".shiftStarts").hide();
            $(".shift").show();
            $.ajax({
                url: "endShift.php", // PHP script to handle endShift request
                method: "POST",
                success: function(response) {
                    // Handle the response from the PHP script
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                }
            });
            $("#shiftStatus").text("Shift Already Completed!");
            $("#startShiftBtn").hide();
        }
        setInterval(function() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "shiftDuration.php", false);
            xmlhttp.send(null);
            $("#shiftDuration").text("Shift Duration: "+xmlhttp.responseText+"");
        }, 1000);
        function assignTask(empID, empName){
            document.getElementById('txtID').value = empID;
            document.getElementById('txtIDisplay').textContent = empID+" - ";
            document.getElementById('txtName').textContent = empName;
            document.getElementById('id02').style.display='block';
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
                <li><a class="selected" href="" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> | Home</a></li>
                <li><a onclick="document.getElementById('reqLet').style.display='block'">&nbsp;<i class="fa-solid fa-file-lines"></i> Request Letter</a></li>        
                <li><a onclick="document.getElementById('reqLeav').style.display='block'">&nbsp;<i class="fa-solid fa-person-walking"></i> Request Leave</a></li>
                <!-- <li><a href="Assigntask.php" title="Assign Task for Team Member">Assign Task</a></li> -->
                <li><a href="Grade.php" title="Grade Team Member">&nbsp;<i class="fa-solid fa-pen-ruler"></i> Grade Employee</a></li>
                <br><br>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
    
    <div class="content">
        <div class="shift">
            <h1 id="shiftStatus"></h1>
            <button type="button" id="startShiftBtn" class="startShiftBtn" onclick="startShift()"><i class="fa-solid fa-clock"></i> &nbsp;&nbsp;Start Shift</button>
        </div>
        <div class="shiftStarts" style="display: none;">
            <h1 id="shiftDuration"></h1>
            <!-- <a onclick="refreshDuration()">Refresh Time</a> -->
            <button type="button" class="endShiftBtn" onclick="endShift()"><i class="fa-solid fa-stopwatch"></i> &nbsp;&nbsp;End Shift</button>
        </div>
        <div id="id02" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; color: #0FD46B; background-color: #0D333E; border-radius:25px;">
                
                    <div class="w3-center"><br>
                    <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                    <h1 style="color:gold"><i class="fa-solid fa-user-pen"></i> Asssign Task</h1>
                    </div>
            
                    <form class="w3-container" action="assigningTask.php" method="post">
                    <div class="w3-section" style="text-align:center; font-size:20px">
                        <input type="hidden" name="txtID" id="txtID" value="">
                        <div style="color: #0D333E;background-color: #0FD46B;border-radius:25px;padding:20px;">
                            <label>Employee Details:</label><br>
                            <label name="txtIDisplay" id="txtIDisplay"></label>
                            <label name="txtName" id="txtName"></label>
                        </div>
                        <br><br>
                        <label>Task Name:</label><br>
                        <input type="text" name="txtTask" id="task" placeholder="Input Task Name" required>
                        <br><br>
                        <label>Due Date:</label><br><br>
                        <input type="date" name="dueDate" id="dueDate" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required><br>
                        <button style='width:200px' class='fltrBtn'id="assign" type="Submit" name="assign"><i class="fa-regular fa-square-check"></i> Assign Task</button><br><br>
                    </div>
                    </form>					
                </div>
                </div>
        <!-- <hr style='height: 2px; background-color: #0D333E; border: none;'> -->
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
                        <input type="date" name="leaveDay" id="leaveDay" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
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
        <div class="dashboard">
            <br>
            <h1 style="font-size:45px">Team <?php echo $team; ?> Member's Task(s)</h1>
        <?php
                $sqlTeamMember = "SELECT e.employeeID, e.employeeName, p.projectName, p.dueDate, p.projectStatus
                FROM employee e
                LEFT JOIN project p ON e.employeeID = p.employeeID AND (p.projectStatus = 0 OR p.dueDate >= CURDATE())
                WHERE e.employeeDept = '$dept' AND e.employeeTeam = '$team' AND e.employeeID <> '$id' AND e.employeeRole <> 2
                ORDER BY p.dueDate ASC";

                $result = mysqli_query($con, $sqlTeamMember);
                echo mysqli_error($con);

                // Create an associative array to store the projects for each employee
                $employeeProjects = array();

                // Loop through the query results
                while ($row = mysqli_fetch_assoc($result)) {
                    $employeeID = $row['employeeID'];

                    // Check if the employee ID is already stored in the array
                    if (!isset($employeeProjects[$employeeID])) {
                        // Initialize the array for the employee's projects
                        $employeeProjects[$employeeID] = array();
                    }

                    // Add the project details to the employee's projects array
                    $employeeProjects[$employeeID][] = $row;
                }

                // Display the results
                if (!empty($employeeProjects)) {
                    foreach ($employeeProjects as $employeeID => $projects) {
                        // Get the employee details from the first project (they will be the same for all projects)
                        $employeeName = $projects[0]['employeeName'];
                        $task = $projects[0]['projectName'];

                        echo "<hr>";
                        echo "<div class='headerPage'>";
                        echo "<div class='homeSupervisor-container'>";
                        echo "<div class='teammateSide' style='font-size: 40px'>";
                        echo "<span style='color:gold'>Employee: " . $employeeID . " - " . $employeeName . "</span><br>";
                        echo "Task(s):<br>";
                        echo "</div>";
                        echo "<div class='asssignSide'>";
                        echo "<button style='width:200px'class='startShiftBtn' type='button' onclick='assignTask(" . $employeeID . ", \"" . $employeeName . "\")'><i class='fa-solid fa-user-pen'></i> Assign Task</button>";
                        echo "</div></div>";
                        if ($task==""){
                            echo"No Task Found</div>";
                        }
                        else{
                            echo"<div class='projects-container'>";
                            foreach ($projects as $project) {
                                $projectStatus = $project['projectStatus'];
                                $projectClass = ($projectStatus == 0) ? 'project-not-completed' : 'project-completed';
                                // Check if the project is due
                                if ($projectStatus == 0 && $project['dueDate'] < date('Y-m-d')) {
                                    echo "<div class='project-due'>";
                                } else {
                                    echo "<div class='$projectClass'>";
                                }
                                echo "<span style='font-size:20px'>Project: " . $project['projectName'] . "</span><br>";
                                echo "Due Date: " . $project['dueDate'] . "<br>";
                                if ($projectStatus == 0 && $project['dueDate'] < date('Y-m-d')) {
                                    echo "Status: Overdue";
                                } else {
                                    echo "Status: " . ($projectStatus == 0 ? "Not Completed" : "Completed");
                                }
                                echo "</div><br><br>";
                            }
                            echo "</div></div>";
                        }
                    }
                        
                } else {
                    echo "No employees found.";
                }
            ?>
        </div>
    </div>
    </div>
    
</body>
</html>