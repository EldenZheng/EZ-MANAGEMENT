<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: HomeHR.php
Description: Home Page for HR
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="UI.css"rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .shift { grid-area: shift; }
        .shiftStarts { grid-area: shift; }
        .content { grid-area: content; }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".Leave").hide();
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
        // OLD FUNCTION
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
        function showreqLet(){
            $(".Leave").hide();
            $(".Letter").show();
        }
        function showreqLeav(){
            $(".Letter").hide();
            $(".Leave").show();
        }
        function approveLetterRequest(id){
            document.getElementById('id02').style.display='block';
            $.ajax({
                url: "approveLetterRequest.php",
                method: "POST",
                data: {
					'letterID' : id
				},
                success: function(response) {
                    // Handle the response from the PHP script
                    if(response=="Employee's Letter Request Approved!"){
                        alert("Employee's Letter Request Approved!");
                        location.reload();
                    }
                    else{
                        alert(response)
                        location.reload();
                    }
                    // window.location.reload(function() {
                    //     showreqLet();
                    // });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                }
            });
        }
        function rejectLetterRequest(id){
            document.getElementById('id02').style.display='block';
            $.ajax({
                url: "rejectLetterRequest.php",
                method: "POST",
                data: {
					'letterID' : id
				},
                success: function(response) {
                    // Handle the response from the PHP script
                    if(response=="Employee's Letter Request Rejected!"){
                        alert("Employee's Letter Request Rejected!");
                        location.reload();
                    }
                    else{
                        alert(response)
                        location.reload();
                    }
                    // window.location.reload(function() {
                    //     showreqLet();
                    // });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                }
            });
        }
        function approveLeaveRequest(id){
            document.getElementById('id02').style.display='block';
            $.ajax({
                url: "approveLeaveRequest.php",
                method: "POST",
                data: {
					'leaveID' : id
				},
                success: function(response) {
                    // Handle the response from the PHP script
                    if(response=="Employee's Leave Request Approved!"){
                        alert("Employee's Leave Request Approved!");
                        location.reload();
                    }
                    else{
                        alert(response)
                        location.reload();
                    }
                    // window.location.reload(function() {
                    //     showreqLeav(); // Execute the showreqLet() function after the page reloads
                    // });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                }
            });
        }
        function rejectLeaveRequest(id){
            document.getElementById('id02').style.display='block';
            $.ajax({
                url: "rejectLeaveRequest.php",
                method: "POST",
                data: {
					'leaveID' : id
				},
                success: function(response) {
                    // Handle the response from the PHP script
                    if(response=="Employee's Leave Request Rejected!"){
                        alert("Employee's Leave Request Rejected!");
                        location.reload();
                    }
                    else{
                        alert(response)
                        location.reload();
                    }
                    // window.location.reload(function() {
                    //     showreqLeav(); // Execute the showreqLet() function after the page reloads
                    // });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error: " + error);
                }
            });
        }
        function enableApproveButton(letterID) {
            var approveButton = document.getElementById('approveButton_' + letterID);
            approveButton.disabled = false;
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
                <!-- <hr> -->
                <li><a style="margin-top:20px;font-size:25px"href="Profile.php" title="Edit Your Profile">&nbsp;<i class="fa-solid fa-pen-to-square"></i> Edit Profile</a></li>
                <hr>
                <li><a class="selected" href="" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> | Home</a></li>
                <li><a href="addEmployee.php" title="Add Employee">&nbsp;<i class="fa-solid fa-user-plus"></i> Add Employee</a></li>
                <li><a href="manageEmployee.php" title="Manage Employee">&nbsp;<i class="fa-solid fa-users"></i> Manage Employee</a></li>
                <li><a href="attendanceReport.php" title="Attendance Report">&nbsp;<i class="fa-solid fa-business-time"></i> Attendance Report</a></li>
                <li><a href="employeeRating.php" title="Employee Rating">&nbsp;<i class="fa-solid fa-thumbs-up"></i> Employee Ratings</a></li>
                <li><a href="deleteEmployee.php" title="Fire Employee">&nbsp;<i class="fa-solid fa-user-xmark"></i> Layoff Employee</a></li>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
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
        
        
        <div class="content">
            <div class="shift">
                <h1 id="shiftStatus"></h1>
                <button type="button" id="startShiftBtn" class="startShiftBtn" onclick="startShift()"><i class="fa-solid fa-clock"></i> &nbsp;&nbsp;Start Shift</button>
            </div>
            <div class="shiftStarts" style="display: none;">
                <h1 id="shiftDuration"></h1>
                <div class="shiftStarts-buttons">
                    <!-- <a onclick="refreshDuration()">Refresh Time</a> OLD FUNCTION-->
                    <button type="button" class="endShiftBtn" onclick="endShift()"><i class="fa-solid fa-stopwatch"></i> &nbsp;&nbsp;End Shift</button>
                </div>
            </div><br><br>
            <div class="tab">
                <button type="button" onclick="showreqLet()"><i class="fa-solid fa-file-lines"></i> Request Letter</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" onclick="showreqLeav()"><i class="fa-solid fa-person-walking"></i> Request Leave</button>
            </div><br><br>
            <div class="Letter">
                <h1>List of Employee's Letter Request</h1>
                <hr>
                <?php
                    $sqlLet="SELECT r.*, e.employeeName FROM requestletter r
                            LEFT JOIN employee e ON r.employeeID = e.employeeID
                            WHERE r.approvalStatus = 0";
                    $letterResult = mysqli_query($con, $sqlLet);
                    if (mysqli_num_rows($letterResult) > 0) {
                        echo "<table>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Generate Letter</th>
                                    <th>Action</th>
                                </tr>";
                        
                        while ($Row = mysqli_fetch_assoc($letterResult)) {
                            $letterID = $Row['letterID'];
                            echo "<tr>
                                    <td>".$Row['employeeID']."</td>
                                    <td>".$Row['employeeName']."</td>
                                    <td>
                                        <a href='generateReferralLetter.php?letID=".$Row['letterID']."' target='_blank' onclick='enableApproveButton($letterID)'><i class='fa-solid fa-file-arrow-down'></i> Generate Letter</a>
                                    </td>
                                    <td>
                                        <button class='apprvBtn' id='approveButton_$letterID' onclick='approveLetterRequest($letterID)' disabled><i class='fa-solid fa-check'></i> Approve</button>
                                        <button class='rjctBtn' onclick='rejectLetterRequest($letterID)'><i class='fa-solid fa-xmark'></i> Reject</button>
                                </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "No Request found.";
                    }
                ?>
            </div>
            <div class="Leave">
                <h1>List of Employee's Leave Request</h1>
                <hr style="height: 2px; background-color: #0D333E; border: none;">
                <?php
                    $sqlLeav="SELECT r.*, e.employeeName FROM requestleave r
                    LEFT JOIN employee e ON r.employeeID = e.employeeID
                    WHERE r.approvalStatus = 0";
                    $leaveResult = mysqli_query($con, $sqlLeav);
                    if (mysqli_num_rows($leaveResult) > 0) {
                        echo "<table>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Leave Type</th>
                                    <th>Leave Date</th>
                                    <th>Leave Duration</th>
                                    <th>Action</th>
                                </tr>";
                        
                        while ($Rows = mysqli_fetch_assoc($leaveResult)) {
                            echo "<tr>
                                    <td>".$Rows['employeeID']."</td>
                                    <td>".$Rows['employeeName']."</td>
                                    <td>".$Rows['leaveType']."</td>
                                    <td>".$Rows['leaveDate']."</td>
                                    <td>".$Rows['leaveDuration']." Day(s)</td>
                                    <td>
                                        <button class='apprvBtn' onclick='approveLeaveRequest(".$Rows['leaveID'].")'><i class='fa-solid fa-check'></i> Approve</button>
                                        <button class='rjctBtn' onclick='rejectLeaveRequest(".$Rows['leaveID'].")'><i class='fa-solid fa-xmark'></i> Reject</button>
                                    </td>
                                </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "No Request found.";
                    }
                ?>
            </div>
            
    </div>
</body>
</html>