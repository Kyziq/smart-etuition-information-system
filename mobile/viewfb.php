<?php 
include "dbcon.php";

$q = "SELECT * FROM feedback";
$result = mysqli_query($con, $q) or die(mysqli_error($con));

while($rows = mysqli_fetch_array($result , MYSQLI_ASSOC)){
	$json[]=$rows;
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($con);
?>