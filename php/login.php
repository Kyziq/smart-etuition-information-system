<?php
// After click login button 

session_start();
// Submit button name below
if (isset($_POST['submit'])) {

    // Get all the posted items
    $uname = $_POST['userUname'];
    $pword = $_POST['userPassw'];

    // Connect to database
    $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

    // Construct and run query to check for correct credentials
    $query = "select * from user where uname='$userUname' and pword='$userPassw'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows != 1) {
        mysqli_close($con);
        header("Location: login.html");
    }










    //user is admin - send to admin page
    $r = mysqli_fetch_assoc($res);
    $_SESSION['uid'] = $r['id'];
    $_SESSION['ulevel'] = $r['level'];
    if ($r['level'] == 1) {

        //clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
        header("Location: admin.php");
    }

    //user has successfully signed in
    if ($r['level'] == 2) {
        //clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
        header("Location: user.php");
    }
} else {
    header("Location: login.html");
}
