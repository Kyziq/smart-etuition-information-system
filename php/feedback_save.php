<?php
session_start();
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
    if (isset($_POST['submitFbButton'])) {
        // Connect to database 
        include_once 'dbcon.php';

        // Get all the posted items
        $fbTitle = mysqli_real_escape_string($con, $_POST['fbTitle']);
        $fbComment = mysqli_real_escape_string($con, $_POST['fbComment']);
        $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
        $adminID = NULL;

        // Construct and run query to store new feedback using prepared statements
        $q =    "INSERT INTO feedback(fbTitle, fbComment, adminID, stuID) 
                VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $q))
            echo "SQL statement failed";
        else {
            mysqli_stmt_bind_param($stmt, "ssii", $fbTitle, $fbComment, $adminID, $userID);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
        }

        echo
        "
        <script>
            alert('New feedback saved!');
            window.location.href='feedback.php';
        </script>
        ";

        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    } else
        header("Location: feedback.php");
} else
    header("Location: login.php");
