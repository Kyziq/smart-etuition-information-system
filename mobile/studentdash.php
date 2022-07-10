<?php 
session_start();
include_once "dbcon.php";

$userID = $_POST['userID'];

$q = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($con, $q) or die(mysqli_error($con));

mysqli_close($con);
?>