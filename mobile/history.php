<?php 
include "dbcon.php";

$stuID = $_POST['stuID'];

$q = "SELECT * FROM feedback WHERE stuID = '$stuID'";
$result = mysqli_query($con, $q) or die(mysqli_error($con));

while($rows = mysqli_fetch_array($result)){
	echo "Feedback ID\t: ";
	echo $rows["fbID"];
	echo "\n";
	echo "Title\t\t\t\t\t\t\t: ";
	echo $rows["fbTitle"];
	echo "\n";
	echo "Comment\t\t\t: ";
	echo $rows["fbComment"];
	echo "\n";
    echo "Date\t\t\t\t\t\t\t: ";
	echo $rows["fbDate"];  
	echo "\n";
	echo "___________________________________________________";
	echo "||";
}
mysqli_close($con);
?>