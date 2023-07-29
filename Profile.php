<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: Profile.php
Description: to self modify user's profile
First Written on: Friday, 23-June-2023
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
    <title>Edit Profile</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .content { grid-area: content; }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#HR").hide();
            $("#supervisor").hide();
            $("#employee").hide();
        <?php
            echo "console.log('" . $role . "');";
            if($role === '1'){
                echo'$("#HR").show();';
                echo'$("#supervisor").hide();';
                echo'$("#employee").hide();';
            }else if($role === '2'){
                echo'$("#HR").hide();';
                echo'$("#supervisor").show();';
                echo'$("#employee").hide();';
            }else if($role === '3'){
                echo'$("#HR").hide();';
                echo'$("#supervisor").hide();';
                echo'$("#employee").show();';
            }
        ?>
        });
    </script>
</head>
<body>
<body>
    <div class="container">
        <div class="sideNav" id="HR">
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
                <li><a class="selected" style="margin-top:20px;font-size:25px"href="Profile.php" title="Edit Your Profile">&nbsp;<i class="fa-solid fa-pen-to-square"></i> | Edit Profile</a></li>
                <hr>
                <li><a href="HomeHR.php" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> Home</a></li>
                <li><a href="addEmployee.php" title="Add Employee">&nbsp;<i class="fa-solid fa-user-plus"></i> Add Employee</a></li>
                <li><a href="manageEmployee.php" title="Manage Employee">&nbsp;<i class="fa-solid fa-users"></i> Manage Employee</a></li>
                <li><a href="attendanceReport.php" title="Attendance Report">&nbsp;<i class="fa-solid fa-business-time"></i> Attendance Report</a></li>
                <li><a href="employeeRating.php" title="Employee Rating">&nbsp;<i class="fa-solid fa-thumbs-up"></i> Employee Ratings</a></li>
                <li><a href="deleteEmployee.php" title="Fire Employee">&nbsp;<i class="fa-solid fa-user-xmark"></i> Layoff Employee</a></li>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
        <div class="sideNav" id="supervisor">
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
                <li><a class="selected" style="margin-top:20px;font-size:25px"href="Profile.php" title="Edit Your Profile">&nbsp;<i class="fa-solid fa-pen-to-square"></i> | Edit Profile</a></li>
                <hr>
                <li><a href="HomeSupervisor.php" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> Home</a></li>
                <li><a onclick="document.getElementById('reqLet').style.display='block'">&nbsp;<i class="fa-solid fa-file-lines"></i> Request Letter</a></li>        
                <li><a onclick="document.getElementById('reqLeav').style.display='block'">&nbsp;<i class="fa-solid fa-person-walking"></i> Request Leave</a></li>
                <!-- <li><a href="Assigntask.php" title="Assign Task for Team Member">Assign Task</a></li> -->
                <li><a href="Grade.php" title="Grade Team Member">&nbsp;<i class="fa-solid fa-pen-ruler"></i> Grade Employee</a></li>
                <br><br>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
        <div class="sideNav" id="employee">
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
                <li><a class="selected" style="margin-top:20px;font-size:25px"href="Profile.php" title="Edit Your Profile">&nbsp;<i class="fa-solid fa-pen-to-square"></i> | Edit Profile</a></li>
                <hr>
                <li><a href="HomeEmployee.php" title="Home">&nbsp;<i class="fa-solid fa-house-user"></i> Home</a></li>
                <li><a onclick="document.getElementById('reqLet').style.display='block'">&nbsp;<i class="fa-solid fa-file-lines"></i> Request Letter</a></li>        
                <li><a onclick="document.getElementById('reqLeav').style.display='block'">&nbsp;<i class="fa-solid fa-person-walking"></i> Request Leave</a></li>
                <br><br>
                <hr>
                <li><a href="logout.php" title = "Logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
        <div class="content">
            <div class="headerPage">
                <h1 class="headerContent">Please Modify The Necessary Details</h1>
            </div>
        <!-- <h1 style="text-align: center; font-size:50px">Please Modify The Necessary Details</h1>
		<hr style='height: 2px; background-color: #0D333E; border: none;'> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
		$('document').ready(function() {
			var email_state = false;
			$('#email').blur(function(){
				var emailAdd = $('#email').val();
				if (emailAdd == ''){
					email_state = false;
					return;
				}
								
			$.ajax({
				url: 'emailCheck.php',
				type: 'post',
				data: {
					'email_check' : 1,
					'email' : emailAdd
				},
				success: function(response){
				$('#msg').text(response);
					if(response == 'not_available') {
						email_state = false;
						$('#msg').text("Email already exist!");
					} else if (response == 'available') {
						email_state = true;
						$('#msg').text("Email available");
					}
				}
			});
			});
		});	
	</script>
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
                        <a onclick="document.getElementById('reqLet').style.display='none'" title="Close Modal" style="cursor: pointer;font-size:20px"><i class='fa-solid fa-xmark'></i> No</a>
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
            </div><br>
            <form action="UpdateEmployee.php" method="post" class="regis-form-container">
                <div class="left-side">
                    <input type="hidden" name="txtID" value="<?php echo $id; ?>">
                    <label>Employee Name:</label><br>
                    <input type="text" name="txtUsername" id="username" placeholder="Input Employee Name" value="<?php echo $name ?>" required>
                    <br><br>
                    <label>Password:</label><br>
                    <input type="text" name="txtPass" id="password" placeholder="Input Password" value="<?php echo $pass ?>"  maxlength="10" required>
                    <br><br>
                    <label>Employee IC:</label><br>
                    <input type="text" name="txtIC" id="ic" placeholder="Input Employee IC" value="<?php echo $ic ?>" required>
                    <br><br>
                </div>
                    <div style="display:none;">
                        <label>Employee Role:</label><br>
                        <select name="txtRole" id="Role" required>
                            <option value="">Select Employee Role</option>
                            <option value="1" <?php if ($role == '1') echo 'selected'; ?>>HR Employee</option>
                            <option value="2" <?php if ($role == '2') echo 'selected'; ?>>Employee Supervisor</option>
                            <option value="3" <?php if ($role == '3') echo 'selected'; ?>>Employee</option>
                        </select>
                        <br><br>
                        <label>Employee Dept:</label><br>
                        <select name="txtDept" id="dept" required>
                            <option value="">Select Employee Department</option>
                            <option value="HR Department" <?php if ($dept == 'HR Department') echo 'selected'; ?>>HR Department</option>
                            <option value="IT Department" <?php if ($dept == 'IT Department') echo 'selected'; ?>>IT Department</option>
                            <option value="Sales" <?php if ($dept == 'Sales') echo 'selected'; ?>>Sales Department</option>
                            <option value="Marketing" <?php if ($dept == 'Marketing') echo 'selected'; ?>>Marketing Department</option>
                        </select>
                
                        <label>Employee Role:</label><br>
                        <select name="txtTeam" id="Team" required>
                            <option value="">Select Employee Team</option>
                            <option value="0" <?php if ($team == '0') echo 'selected'; ?>>Team 1</option>
                            <option value="1" <?php if ($team == '1') echo 'selected'; ?>>Team 1</option>
                            <option value="2" <?php if ($team == '2') echo 'selected'; ?>>Team 2</option>
                            <option value="3" <?php if ($team == '3') echo 'selected'; ?>>Team 3</option>
                        </select>
                    </div>
                <div class="right-side">
                    <label>Employee E-mail:</label><br>
                    <input type="email" name="email_check" id="email" placeholder="Input E-mail" value="<?php echo $email?>" required><br>
                    <span id="msg"></span>
                    <br><br>
                    <label>Employee Phone Number:</label><br>
                    <input type="text" name="txtPN" id="phoneNum" placeholder="Input Employee Phone Number" value="<?php echo $phone?>" required>
                    <br><br>
                    <label>Employee Address:</label><br>
                    <input type="text" name="txtAddress" id="address" placeholder="Input Employee Address" value="<?php echo $address?>" required>
                    <br><br>
                    <button style='width:200px; height:60px; text-align:center' class='apprvBtn' id="update" type="Submit" name="BtnUpdate"><i class='fa-solid fa-pen-to-square'></i> Update</button><br>
                </div>
            </form>	
        </div>
    </div>
  
</body>
</html>