<?php
session_start();
if (isset($_POST['newPasswordButton'])) {
    // Connect to database 
    include_once 'dbcon.php';

    // Get all the posted items
    $newPassword = mysqli_real_escape_string($con, $_POST['newPassword']);
    $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);

    // Construct and run query to store new feedback using prepared statements
    $q = "UPDATE user SET userPassw='$newPassword' WHERE userEmail='$userEmail'";
    $res = mysqli_query($con, $q);

    echo
    "
        <script>
            alert('New password saved!');
            window.location.href='login.php';
        </script>
        ";

    // Clear results and close the connection
    // mysqli_free_result($res);
    mysqli_close($con);
} else
    header("Location: new_password.php");
