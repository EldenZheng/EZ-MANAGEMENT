<!-- 
Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
Program Name: addEmployee.php
Description: Adding Employee
First Written on: Friday, 16-June-2023
Edited on: Friday, 21-Jul-2023
-->
<?php
    include("session.php")
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
    <title>Add Employee</title>
    <style>
        .sideNav { grid-area: sidenav; }
        .content { grid-area: content; }
    </style>
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
                <li><a class="selected" href="" title="Add Employee">&nbsp;<i class="fa-solid fa-user-plus"></i> | Add Employee</a></li>
                <li><a href="manageEmployee.php" title="Manage Employee">&nbsp;<i class="fa-solid fa-users"></i> Manage Employee</a></li>
                <li><a href="attendanceReport.php" title="Attendance Report">&nbsp;<i class="fa-solid fa-business-time"></i> Attendance Report</a></li>
                <li><a href="employeeRating.php" title="Employee Rating">&nbsp;<i class="fa-solid fa-thumbs-up"></i> Employee Ratings</a></li>
                <li><a href="deleteEmployee.php" title="Fire Employee">&nbsp;<i class="fa-solid fa-user-xmark"></i> Layoff Employee</a></li>
                <hr>
                <li><a href="logout.php" title = "Logout">&nbsp;<i class="fa-solid fa-right-from-bracket"></i> Logout</a><br></li>
            </ul>
        </div>
        <div class="content">
            <div class="headerPage">
                <h1 class="headerContent">Please fill-in the details</h1>
            </div><br><br>
            <!-- <hr style='height: 2px; background-color: #0D333E; border: none;'> -->
            <form id="regForm" method="POST" class="regis-form-container">
                <div class="left-side">
                    <label>Employee Name:</label><br>
                    <input type="text" name="txtUsername" id="username" placeholder="Input Employee Name" autofocus="autofocus" required>
                    <br><br>
                    <label>Password:</label><br>
                    <input type="password" name="txtPass" id="password" placeholder="Input Password" maxlength="10" required>
                    <br><br>
                    <label>Employee IC:</label><br>
                    <input type="text" name="txtIC" id="ic" placeholder="Input Employee IC" required>
                    <br><br>
                    <label>Employee Role:</label><br>
                    <select name="txtRole" id="Role" required>
                    <option value="">Select Employee Role</option>
                    <option value="1">HR Employee</option>
                    <option value="2">Employee Supervisor</option>
                    <option value="3">Employee</option>
                    </select>
                    <br><br>
                    <label>Employee Dept:</label><br>
                    <select name="txtDept" id="dept" required>
                    <option value="">Select Employee Department</option>
                    <option value="HR Department">HR Department</option>
                    <option value="IT Department">IT Department</option>
                    <option value="Sales">Sales Department</option>
                    <option value="Marketing">Marketing Department</option>
                    </select>
                </div>
                <div class="right-side">
                    <label>Employee Team:</label><br>
                    <select name="txtTeam" id="Team" required>
                    <option value="">Select Employee Team</option>
                    <option value="1">Team 1</option>
                    <option value="2">Team 2</option>
                    <option value="3">Team 3</option>
                    </select>
                    <br><br>
                    <label>Employee E-mail:</label><br>
                    <input type="email" name="email_check" id="email" placeholder="Input E-mail" required><br>
                    <span id="msg"></span>
                    <br><br>
                    <label>Employee Phone Number:</label><br>
                    <input type="tel" name="txtPN" id="phoneNum" placeholder="Input Phone Number" required>
                    <br><br>
                    <label>Employee Address:</label><br>
                    <input type="text" name="txtAddress" id="address" placeholder="Input Employee Address" required>
                    <br><br>
                    <button style='width:200px; height:60px' class='apprvBtn' type="Submit" id="add"><i class="fa-solid fa-user-plus"></i> Add Employee</button>
                    <div id="error_msg"></div>
                </div>
                </form>
        </div>
    </div>
        
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
				url: 'addingEmployee.php',
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
							
			
			$('#add').click(function(e){
				
				var name = $('#username').val();
				var email = $('#email').val();
				var password = $('#password').val();
				var ic = $('#ic').val();
                var dept = $('#dept').val();
                var team = $('#Team').val();
                var role = $('#Role').val();
                var phonenum = $('#phoneNum').val();
                var addr = $('#address').val();

				var $regForm = $('#regForm');
				if (!$regForm[0].checkValidity()) {
					$regForm.find(':submit').click();
				}				
				
				if (email_state == false) {
					$('#error_msg').text('Fix the errors first');
					e.preventDefault();
				} else {
					$('#error_msg').text("");
					
					$.ajax({
						url: 'addingEmployee.php',
						type: 'post',
						data: {
							'BtnAdd':1,
                            'txtUsername': name,
							'txtPass': password,
							'txtIC': ic,
                            'txtDept': dept,
                            'txtRole': role,
                            'txtTeam':team,
                            'email': email,
                            'txtPN': phonenum,
                            'txtAddress': addr
						},
						success: function(response) {
							if(response=='Employee Updated!'){
								alert('Employee added to the database');
							}else{
                                $('#error_msg').text(response);
								alert(response);
							}											
						}
					});
				}
			});
			
		});	
	</script>
</body>
</html>