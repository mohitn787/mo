<?php
ob_start(); //Turns on output buffering


// whenever their is a error in the input box of the registration form all the valid values also vanishes hence to store all the valid inputs such that the user will only need to modify the invalid inputs for that we wiil use to store it in session variables
session_start(); //allows to store the variable in session variables

$timezone =date_default_timezone_set("Asia/Kolkata"); // sets the timezone
$con = mysqli_connect("localhost","root","","tsp_project");
if(mysqli_connect_errno()) {
	echo "Failed to connect: ".mysqli_connect_errno();
}