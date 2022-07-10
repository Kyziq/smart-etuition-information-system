<?php 
session_start();
include_once "dbcon.php";

$userID = $_POST['userID'];

$q = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($con, $q) or die(mysqli_error($con));

while($rows = mysqli_fetch_array($result)){
	echo "User ID\t: ";
	echo $rows["userID"];
	echo "\n";
	echo "Name\t\t: ";
	echo $rows["userName"];
	echo "\n";
	echo "Phone\t\t\t\t: ";
	echo $rows["userPhone"];
	echo "\n";
	echo "Email\t\t\t\t: ";
	echo $rows["Email"];
	echo "\n";
	echo "Birthdate\t\t: ";
	echo $rows["userBirthdate"];
	echo "\n";
    echo "Address\t\t: ";
    echo $rows["userAddress"];
	echo "\n";
	echo "______________________________________________________________________________________";
	echo "||";
}
mysqli_close($con);
?>