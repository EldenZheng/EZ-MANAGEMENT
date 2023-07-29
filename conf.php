<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: conf.php
// Description: to connect to database
// First Written on: Friday, 16-June-2023
// Edited on: Friday, 21-Jul-2023
$con=mysqli_connect("localhost","root","","ez management");

if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
?>