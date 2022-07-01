<?php
session_start();
// Admin's
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
    // Check if save is clicked
    if (isset($_POST['deleteFbButton'])) {
        // Get the posted item
        $fbID = $_POST['fbID'];

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to update class database
        $q = "DELETE FROM feedback WHERE fbID='$fbID'";
        $res = mysqli_query($con, $q);

        // Success popup
        echo
        "
            <script>
                alert('Feedback deletion succesful!');
                window.location.href='feedback.php';
            </script>
        ";

        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    } else
        header("Location: feedback.php");
}
