<?php
// Include database connection settings
include_once 'dbcon.php';

/*
$userUname = $_POST['userUname'];
//test
$q = "SELECT userID FROM user WHERE userUname= '$userUname'";
$query = mysqli_query($con, $q);
$stuID = mysqli_fetch_array($query);
*/

$stuID = $_POST['stuID'];
$fbID = $_POST['fbID'];
$fbTitle = $_POST['fbTitle'];
$fbComment = $_POST['fbComment'];

$q = "SELECT * FROM feedback WHERE stuID = 'stuID'";
$result = mysqli_query($con, $q);
$rows = mysqli_num_rows($result);

if ($rows > 0) {
    echo "Data is already saved";
} else {
    $q = "INSERT INTO feedback(fbID, fbTitle, fbComment, stuID) VALUES ('$fbID', '$fbTitle', '$fbComment', '$stuID')";
    $input = mysqli_query($con, $q);

    if ($input) {
        echo "Feedback saved successfully!\nPlease wait a few seconds.";
    }
}
/*
$userBirthdate=$_POST['userBirthdate'];

, userBirthdate
, '$userBirthdate'
*/
