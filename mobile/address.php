<?php
// Inialize session
session_start();

// Include database connection settings
include_once 'dbcon.php';

$userUname = $_POST['userUname'];

$q = "SELECT * FROM user WHERE userUname = '$userUname'";
$res = mysqli_query($con, $q);

while ($rows = mysqli_fetch_assoc($res)) {
    $userAddress = $rows['userAddress'];
    echo $userAddress;
}

mysqli_close($con);
?>

