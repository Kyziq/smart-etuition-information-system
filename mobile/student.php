<?php 
include "dbcon.php";

$q = "SELECT * FROM user WHERE userLevel = 3";
$result = mysqli_query($con, $q) or die(mysqli_error($con));

while($rows = mysqli_fetch_array($result)){
	echo "User ID\t\t\t: ";
	echo $rows["userID"];
	echo "\n";
	echo "Username\t\t: ";
	echo $rows["userUname"];
	echo "\n";
	echo "Name\t\t\t\t: ";
	echo $rows["userName"];
	echo "\n";
	echo "Phone\t\t\t: ";
	echo $rows["userPhone"];
	echo "\n";
	echo "Email\t\t\t\t: ";
	echo $rows["userEmail"];
	echo "\n";
	echo "Birthdate\t\t: ";
	echo $rows["userBirthdate"];
	echo "\n";
	echo "Address\t\t\t: ";
	echo $rows["userAddress"];
	echo "\n";
	echo "______________________________________________________________________________________";
	echo "||";
}
mysqli_close($con);
?>