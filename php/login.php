<?php
// After click login button 

session_start();
// Submit button name below
if (isset($_POST['login'])) {

    // Get all the posted items
    $userUname = $_POST['userUname'];
    $userPassw = $_POST['userPassw'];

    // Connect to database
    $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

    // Construct and run query to check for correct credentials
    $query = "select * from user where userUname='$userUname' and userPassw='$userPassw'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows != 1) {
        mysqli_close($con);
        header("Location: login.html");
    }

    $r = mysqli_fetch_assoc($res);
    $_SESSION['uid'] = $r['id'];
    $_SESSION['ulevel'] = $r['level'];

    // Check if user is admin - send to admin page
    if ($r['level'] == 1) {

        // clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
        header("Location: admin.php");
    }

    // Check if user is tutor - send to admin page
    if ($r['level'] == 2) {
        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
        header("Location: tutor.php");
    }

    // Check if user is student - send to admin page
    if ($r['level'] == 3) {
        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
        header("Location: student.php");
    }
} else {
    header("Location: login.html");
}
