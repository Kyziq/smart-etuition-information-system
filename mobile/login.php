<?php
include "dbconn.php";
$userUname=$_POST['userUname'];
$userPassw=$_POST['userPassw'];

$q = "SELECT * FROM user WHERE userName='$userName' AND userPassw='$userPassw'";
$result = mysqli_query($con, $q);
$rows = mysqli_num_rows($result);

if ($rows>0) {
	echo "Login Successful!";
}
else {
	echo "Login Unsuccessful:(";
}
?>