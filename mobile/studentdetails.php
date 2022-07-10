<?php 
include "dbcon.php";

//$userID = @$_POST['userID']; 
$userID = 23;
$q = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($con, $q) or die(mysqli_error($con));

while($rows = mysqli_fetch_array($result)) {
	echo "User ID\t\t: ";
	echo $rows["userID"];
	echo "\n";
	echo "Name\t\t\t: ";
	echo $rows["userName"];
	echo "\n";
	echo "Phone\t\t: ";
	echo $rows["userPhone"];
	echo "\n";
	echo "Email\t\t\t: ";
	echo $rows["userEmail"];
	echo "\n";
	echo "Birthdate\t: ";
	echo $rows["userBirthdate"];
	echo "\n";
    echo "Address\t\t: ";
    echo $rows["userAddress"];
	echo "\n";
	echo "______________________________________________________________________________________";
	echo "||";
}

mysqli_free_result($result);
mysqli_close($con);
?>