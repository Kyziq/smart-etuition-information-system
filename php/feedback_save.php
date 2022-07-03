<?php
session_start();
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
    if (isset($_POST['submitFbButton'])) {
        // Get all the posted items
        $fbTitle = $_POST['fbTitle'];
        $fbComment = $_POST['fbComment'];
        $userID = $_SESSION['userID'];

        // Connect to database 
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        /* 
        textarea -
        Apostrophes have special meaning to SQL, so to get them into the data they need to be "escaped" PHP 
        has a quick function for this that also does some security checks to help prevent your database from getting hacked.
        */
        $fbComment = mysqli_real_escape_string($con, $fbComment);

        // Construct and run query to store new feedback
        $q = "INSERT INTO feedback(fbTitle, fbComment, adminID, stuID) VALUES ('$fbTitle', '$fbComment', NULL, '$userID')";
        $res = mysqli_query($con, $q);

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
    } else {
        header("Location: feedback.php");
    }
} else {
    header("Location: login.php");
}
