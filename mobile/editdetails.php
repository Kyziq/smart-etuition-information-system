<?php

include "dbcon.php";

$userUname = $_POST['userUname']; 
$userName = $_POST["userName"];
$userPhone = $_POST["userPhone"];
$userEmail = $_POST["userEmail"];
$userAddress = $_POST["userAddress"];

$q = "SELECT * FROM user WHERE userUname = '$userUname'";
$query = mysqli_query($con, $q);

$result = mysqli_num_rows($query);

if ($result>0) {
    $query = "UPDATE user SET userName = '$userName', userPhone = '$userPhone', userEmail = '$userEmail', userAddress = '$userAddress' WHERE userUname='$userUname'";
    $input = mysqli_query ($con, $query);
    echo "Data successfully saved!";
}
else {
    echo "Data not found";
}

?>