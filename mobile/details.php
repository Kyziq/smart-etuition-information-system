<?php 

include "dbcon.php";
$userUname = $_POST['userUname']; 
$q = "SELECT * FROM user WHERE userUname = '$userUname'";
$query = mysqli_query($con, $q);


while($rows = mysqli_fetch_array($query)) {
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
	echo "||";
}

mysqli_close($con);
?>