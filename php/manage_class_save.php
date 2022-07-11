<?php
session_start();
// Admin's
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
    // Check if save is clicked
    if (isset($_POST['saveClassButton'])) {
        // Connect to database 
        include_once 'dbcon.php';

        // Get all the posted items
        $classID = $_POST['classID'];
        $classSubject = $_POST['subject'];
        $classLink = $_POST['link'];
        $classDay = $_POST['day'];
        $classTime = $_POST['time'];
        $classFee = $_POST['fee'];
        $adminID = $_SESSION['userID']; // Admin ID who made the change will be recorded

        // Construct and run query to update class details using prepared statements
        $q = "UPDATE class SET classSubject=?, classLink=?, classDay=?, classTime=?, classFee=?, adminID=? WHERE classID=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $q))
            echo "SQL statement failed";
        else {
            mysqli_stmt_bind_param($stmt, "ssssiii", $classSubject, $classLink, $classDay, $classTime, $classFee, $adminID, $classID);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
        }

        /* Old
        // Get all the posted items
        $classID = $_POST['classID'];
        $subject = $_POST['subject'];
        $link = $_POST['link'];
        $day = $_POST['day'];
        $time = $_POST['time'];
        $fee = $_POST['fee'];
        $adminID = $_SESSION['userID']; // Admin ID who made the change will be recorded

        // Construct and run query to update class database
        $q = "UPDATE class SET classSubject='$subject', classLink='$link', classDay='$day', classTime='$time', classFee='$fee', adminID='$adminID' WHERE classID=$classID";
        $res = mysqli_query($con, $q);
        */

        // Success popup
        echo
        "
            <script>
                alert('Class saving successful!');
                window.location.href='manage_class.php';
            </script>
        ";

        // Clear results and close the connection
        //mysqli_free_result($res);
        mysqli_close($con);
    } else
        header("Location: manage_class.php");
} else
    header("Location: login.php");
