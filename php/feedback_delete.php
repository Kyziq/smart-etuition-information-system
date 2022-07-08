<?php
session_start();
// Admin's
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
    // Check if save is clicked
    if (isset($_POST['deleteFbButton'])) {
        // Connect to database 
        include_once 'dbcon.php';
        // Get the posted item
        $fbID = $_POST['fbID'];

        // Construct and run query to update class database
        $q = "DELETE FROM feedback WHERE fbID='$fbID'";
        $res = mysqli_query($con, $q);

        // Success popup
        /*
        echo
        "
            <script>
                alert('Feedback deletion succesful!');
                window.location.href='feedback.php';
            </script>
        ";*/
        header("Location: feedback.php");

        // Clear results and close the connection
        // mysqli_free_result($res);
        mysqli_close($con);
    } else
        header("Location: feedback.php");
} else
    header("Location: login.php");
