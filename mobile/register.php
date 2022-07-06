<?php
include "dbconn.php";
$userID=$_POST['userID'];
$userUname=$_POST['userUname'];
$userPassw=$_POST['userPassw'];
$userName=$_POST['userName'];
$userPhone=$_POST['userPhone'];
$userEmail=$_POST['userEmail'];

$q = "SELECT * FROM user WHERE userName='userName'";
$result = mysqli_query($con, $q);
$rows = mysqli_num_rows($result);

if ($rows > 0) {
	echo "Data is already saved";
}
else {
	$q = "INSERT INTO user(userID, userUnam, userPassw, userName, userPhone, userEmail) VALUES 
	('$userID', '$userUnam', '$userPassw', '$userName', '$userPhone', '$userEmail')";
	$input = mysqli_query($con, $q);
	if ($input) {
		echo "Registration Successful!";
	}
}

?>