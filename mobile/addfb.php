<?php
// Include database connection settings
include_once 'dbcon.php';

$userID = $_POST['userID'];
$userID = $_POST['userID'];
$userID = $_POST['userID'];
$userID = $_POST['userID'];


$q = "SELECT * FROM user WHERE userUname='userUname'";
$result = mysqli_query($con, $q);
$rows = mysqli_num_rows($result);

if ($rows > 0) {
    echo "Data is already saved";
} else {
    $q = "INSERT INTO user(userID, userUname, userPassw, userName, userPhone, userEmail, userAddress, userGender) VALUES 
	('$userID', '$userUname', '$userPassw', '$userName', '$userPhone', '$userEmail', '$userAddress', '$userGender')";
    $input = mysqli_query($con, $q);

    if ($input) {
        echo "Registration successful!\nPlease wait a few seconds.";
    }
}
/*
$userBirthdate=$_POST['userBirthdate'];

, userBirthdate
, '$userBirthdate'
*/
