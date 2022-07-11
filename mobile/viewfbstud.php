<?php 
include "dbcon.php";

$q = "SELECT * FROM feedback WHERE stuID = '$stuID'";
$result = mysqli_query($con, $q) or die(mysqli_error($con));

while($rows = mysqli_fetch_array($result)){
	echo "Feedback ID\t: ";
	echo $rows["fbID"];
	echo "\n";
	echo "Student ID\t\t: ";
	echo $rows["stuID"];
	echo "\n";
	echo "Date\t\t\t\t: ";
	echo $rows["fbDate"];
	echo "\n";
	echo "Title\t\t\t\t: ";
	echo $rows["fbTitle"];
	echo "\n";
	echo "Comment\t\t: ";
	echo $rows["fbComment"];
	echo "\n";
	echo "______________________________________________________________________________________";
	echo "||";
}
mysqli_close($con);
?>