<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: HomeEmployee.php
Description: Home Page for Employees
First Written on: Friday, 16-June-2023
Edited on: Friday, 21-Jul-2023
-->
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
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
        // function refreshDuration(){
        //     $.ajax({
        //         url: "shiftDuration.php",
        //         method: "POST",
        //         success: function(response) {
        //             // Handle the response from the PHP script
        //             $("#shiftDuration").text("Shift Duration: "+response+"");
        //         },
        //         error: function(xhr, status, error) {
        //             // Handle errors
        //             console.log("Error: " + error);
        //         }
        //     });
        // }
        setInterval(function() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "shiftDuration.php", false);
            xmlhttp.send(null);
            $("#shiftDuration").text("Shift Duration: "+xmlhttp.responseText+"");
        }, 1000);
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
                <li>Employee</li>
                <li><?php echo $dept; ?> - Team <?php echo $team; ?></li>
                <li><?php echo $email; ?></li>
                <li><?php echo $phone; ?></li>
                <li><?php echo $address; ?></li>
                <li>Rating Progress Bar:</li>
                <li>
                    <div class="progress-information">
                        <div class="progress-bar" style="width: <?php echo ($totRating / 5000) * 100; ?>%;"></div>
                    </div>
                    <div style="text-align:center"><?php echo $totRating?> / 5000</div>
                </li>
            </div>
            <li><a style="margin-top:20px;font-size:25px"href="Profile.php" title="Edit Your Profile">&nbsp;<i class="fa-solid fa-pen-to-square"></i> Edit Profile</a></li>
            <hr>
            <li><a class="selected" href="" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> | Home</a></li>
            <li><a onclick="document.getElementById('reqLet').style.display='block'">&nbsp;<i class="fa-solid fa-file-lines"></i> Request Letter</a></li>        
            <li><a onclick="document.getElementById('reqLeav').style.display='block'">&nbsp;<i class="fa-solid fa-person-walking"></i> Request Leave</a></li>
            <br><br>
            <hr>
            <li><a href="logout.php" title = "Logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
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
        <div class="EmpDivider">
            <div style="display:flex">
                <div class="selftask" style="width:90%">
                    <?php
                        $sqlTask = "SELECT *
                                    FROM project
                                    WHERE employeeID = '$id' AND projectStatus = 0
                                    ORDER BY dueDate ASC";
            
                        // Execute the query
                        $taskList = mysqli_query($con, $sqlTask);
            
                        // Check if any tasks are returned
                        if (mysqli_num_rows($taskList) > 0) {
                            // Flag to track the closest due project
                            $priotityTask = true;
                            $priotityTaskDisplayed = false;
            
                            // Loop through the results and display the projects
                            while ($row = mysqli_fetch_assoc($taskList)) {
                                $projectName = $row['projectName'];
                                $dueDate = $row['dueDate'];
            
                                // Check if the project is the closest due project
                                if ($priotityTask) {
                                    echo"<div style='width:95%;' class='headerPage'>
                                            <h1 class='headerContent'>Priority Task</h1>
                                            <hr>
                                        <br>";
                                    // echo "<h1 style='font-size:60px'>Priority Task</h1>";
                                    // echo "<hr style='height: 2px; background-color: #0D333E; border: none; width:95%;'>";
                                    echo "<div class='taskContainer'>";
                                    echo "<div class='taskDetails'>";
                                    echo "<p class='highlightTask' style='color:gold'>$projectName</p>";
                                    echo "<p class='highlightDue'>Due Date: $dueDate</p>";
                                    echo "</div>";
                                    echo "<button style='width:200px; height:65px' class='startShiftBtn' type='button' onclick=\"window.location.href='finishTask.php'\"><i class='fa-solid fa-list-check'></i> Finish Task</button>";
                                    echo "</div></div>";
                                    echo "<hr style='height: 2px; background-color: #000000; border: none; width:95%;'>";
                                    $priotityTask = false;
                                } else {
                                    if (!$priotityTaskDisplayed) {
                                        echo"<div style='width:95%;' class='headerPage'>
                                                <h1 class='headerContent'>Next Tasks</h1>
                                            </div><br><br>";
                                        $priotityTaskDisplayed = true;
                                    }
                                    echo "<p class='nextTask'>$projectName - Due Date: $dueDate</p>";
                                }
                            }
                        } else {
                            echo "<h1 style='font-size:40px; text-align:center'>- No tasks found -</h1>";
                        }
            
                    ?>
                    </div>
                    <div class="team">
                        <h1>Team <?php echo $team; ?> Members:</h1>
                    <?php
                        $sqlTeam = "SELECT DISTINCT e.*, p.projectName, p.dueDate
                                    FROM employee e
                                    LEFT JOIN (
                                        SELECT projectName, dueDate, employeeID
                                        FROM project
                                        WHERE projectStatus = 0
                                        ORDER BY dueDate ASC
                                    ) p ON e.employeeID = p.employeeID
                                    WHERE e.employeeTeam = '$team' AND e.employeeDept = '$dept' AND e.employeeID <> '$id'
                                    GROUP BY e.employeeID
                                    ORDER BY CASE WHEN e.employeeRole = 2 THEN 0 ELSE 1 END, e.employeeID";
                        
                        // Execute the query
                        $result = mysqli_query($con, $sqlTeam);
                        
                        // Check if any results are returned
                        if (mysqli_num_rows($result) > 0) {
                            // Loop through the results and output employee name and role
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<p class='teamName'>".$row['employeeName']."</p>";
                                
                                if ($row['employeeRole'] == 2) {
                                    echo "<p class='teamDet'>Supervisor</p>";
                                    echo "<hr style='height: 2px; background-color: #ffffff; border: none;'>";
                                } elseif ($row['employeeRole'] == 3) {
                                    echo "<p class='teamDet'>".$row['projectName']."</p>";
                                }
                            }
                        } else {
                            echo "No results found.";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>