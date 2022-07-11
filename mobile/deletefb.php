<?php
// Include database connection settings
include 'dbcon.php';

$fbID = $_POST['fbID'];

$q="DELETE FROM feedback WHERE fbID='$fbID'";
$results=mysqli_query($con,$q) or die(mysqli_error($con));

if ($results==1) echo "Feedback deleted!";
mysqli_close($con);
?>