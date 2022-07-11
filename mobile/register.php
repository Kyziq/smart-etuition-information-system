<?php
// Include database connection settings
include 'dbcon.php';

$userID = $_POST['userID'];
$userUname = $_POST['userUname'];
$userPassw = $_POST['userPassw'];
$userName = $_POST['userName'];
$userPhone = $_POST['userPhone'];
$userEmail = $_POST['userEmail'];
$userAddress = $_POST['userAddress'];
$userGender = $_POST['userGender'];

$q = "SELECT * FROM user WHERE userUname='$userUname'";
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
