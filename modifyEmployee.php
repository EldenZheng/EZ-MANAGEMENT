<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: modifyEmployee.php
Description: to modify the selected employee from manageEmployee.php
First Written on: Wednesday, 21-Jul-2023
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Employee</title>
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
                <li><a class="selected" href="manageEmployee.php" title="Manage Employee">&nbsp;<i class="fa-solid fa-users"></i> | Manage Employee</a></li>
                <li><a href="attendanceReport.php" title="Attendance Report">&nbsp;<i class="fa-solid fa-business-time"></i> Attendance Report</a></li>
                <li><a href="employeeRating.php" title="Employee Rating">&nbsp;<i class="fa-solid fa-thumbs-up"></i> Employee Ratings</a></li>
                <li><a href="deleteEmployee.php" title="Fire Employee">&nbsp;<i class="fa-solid fa-user-xmark"></i> Layoff Employee</a></li>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
		<div class="content">
		<?php
			$empID = $_GET['employeeID'];
			$sql="SELECT * FROM employee WHERE employeeID='$empID'";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_assoc($result);

			$id = $row['employeeID'];
			$name = $row['employeeName'];
			$dept = $row['employeeDept'];
			$role = $row['employeeRole'];
			$email = $row['employeeEmail'];
			$phone = $row['employeePhonenum'];
			$address = $row['employeeAddress'];
			$hiredDate = $row['employeeHireddate'];
			$totRating = $row['employeeTotalRating'];
			$team = $row['employeeTeam'];
			$password = $row['employeePassword'];
			$ic = $row['employeeIC'];
		?>
		<a href="manageEmployee.php" style="text-decoration:none;">
			<svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 32 32">
				<defs>
					<style>.cls-1{fill:#0D333E;}</style>
				</defs>
				<g data-name="arrow left" id="arrow_left">
					<path class="cls-1" d="M22,29.73a1,1,0,0,1-.71-.29L9.93,18.12a3,3,0,0,1,0-4.24L21.24,2.56A1,1,0,1,1,22.66,4L11.34,15.29a1,1,0,0,0,0,1.42L22.66,28a1,1,0,0,1,0,1.42A1,1,0,0,1,22,29.73Z"/>
				</g>
			</svg>
		<span style="font-size:40px;">Back to Manage Employee</span></a><br><br>
		<!-- <a href="manageEmployee.php" style="text-decoration:none;">
		<span style="font-size:40px;"><i class="fa-solid fa-arrow-left-long"></i>Back to Manage Employee</span></a>
		<br><br> -->
		<div class="headerPage">
			<h1 class="headerContent">Please Modify The Necessary Details</h1>
		</div><br><br>
		<!-- <h1 style="text-align: center; font-size:50px">Please Modify The Necessary Details</h1>
		<hr style='height: 2px; background-color: #0D333E; border: none;'> -->
		<form action="UpdateEmployee.php" method="post" class="regis-form-container">
			<div class="left-side">
				<input type="hidden" name="txtID" value="<?php echo $id; ?>">
				<label>Employee ID:</label><br>
				<label name="txtID" id="txtID" disabled><?php echo $id; ?></label>
				<br><br>
				<label>Employee Name:</label><br>
				<input type="text" name="txtUsername" id="username" placeholder="Input Employee Name" value="<?php echo $name; ?>" required>
				<br><br>
				<label>Password:</label><br>
				<input type="text" name="txtPass" id="password" placeholder="Input Password" value="<?php echo $password; ?>"  maxlength="10" required>
				<br><br>
				<label>Employee IC:</label><br>
				<input type="text" name="txtIC" id="ic" placeholder="Input Employee IC" value="<?php echo $ic; ?>" required>
				<br><br>
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
					<option value="Multimedia" <?php if ($dept == 'Multimedia') echo 'selected'; ?>>Multimedia Department</option>
					<option value="Sales" <?php if ($dept == 'Sales') echo 'selected'; ?>>Sales Department</option>
					<option value="Marketing" <?php if ($dept == 'Marketing') echo 'selected'; ?>>Marketing Department</option>
				</select>
			</div>
			<div class="right-side">
				<label>Employee Team:</label><br>
				<select name="txtTeam" id="Team" required>
					<option value="">Select Employee Team</option>
					<option value="1" <?php if ($team == '1') echo 'selected'; ?>>Team 1</option>
					<option value="2" <?php if ($team == '2') echo 'selected'; ?>>Team 2</option>
					<option value="3" <?php if ($team == '3') echo 'selected'; ?>>Team 3</option>
				</select>
				<br><br>
				<label>Employee E-mail:</label><br>
				<input type="email" name="email_check" id="email" placeholder="Input E-mail" value="<?php echo $email; ?>" required><br>
				<span id="msg"></span>
				<br><br>
				<label>Employee Phone Number:</label><br>
				<input type="tel" name="txtPN" id="phoneNum" placeholder="Input Employee Phone Number" value="<?php echo $phone; ?>" required>
				<br><br>
				<label>Employee Address:</label><br>
				<input type="text" name="txtAddress" id="address" placeholder="Input Employee Address" value="<?php echo $address; ?>" required>
				<br><br>
				<button style='width:200px; height:60px' class='apprvBtn' id="update" type="Submit" class="butn" name="BtnUpdate"><i class='fa-solid fa-pen-to-square'></i> Update</button><br>
			</div>
		</form>
		</div>
	</div>
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$('document').ready(function() {
	$('#Role').change(function() {
		if ($(this).val() === '1') { // HR Employee selected
			$('#dept').val('HR Department'); // Set HR Department as selected
			$('#dept').prop('disabled', true); // Disable department selection
			$('#Team').val('0');
			$('#Team').prop('disabled', true); // Disable team selection
		} else {
			$('#dept').prop('disabled', false); // Enable department selection
			$('#Team').prop('disabled', false); // Enable team selection
		}
	});
	$('#dept').change(function() {
		if ($(this).val() === 'HR Department') { // HR Employee selected
			$('#Role').val('1'); // Set HR Department as selected
			$('#dept').prop('disabled', true); // Disable department selection
			$('#Team').val('0');
			$('#Team').prop('disabled', true); // Disable team selection
		} else {
			$('#dept').prop('disabled', false); // Enable department selection
			$('#Team').prop('disabled', false); // Enable team selection
		}
	});
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
