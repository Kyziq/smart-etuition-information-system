<?php
session_start();
if (isset($_POST['newPasswordButton'])) {
    // Connect to database 
    include_once 'dbcon.php';

    // Get all the posted items
    $newPassword = $_POST['newPassword'];
    $userEmail = $_POST['userEmail'];

    // Construct and run query to update new password using prepared statements
    $q = "UPDATE user SET userPassw=? WHERE userEmail=?";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $q))
        echo "SQL statement failed";
    else {
        mysqli_stmt_bind_param($stmt, "ss", $newPassword, $userEmail);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
    }

    /* Old
    // Construct and run query to store new feedback
    $q = "UPDATE user SET userPassw='$newPassword' WHERE userEmail='$userEmail'";
    $res = mysqli_query($con, $q);
    */

    // Success popup
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
