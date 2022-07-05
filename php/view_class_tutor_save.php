<?php
session_start();
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 2) {
    if (isset($_POST['saveClassButton'])) {
        // Get all the posted items
        $classID = $_POST['classID'];
        $classLink = $_POST['classLink'];

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to update class database
        $q = "UPDATE class SET classLink='$classLink' WHERE classID='$classID'";
        $res = mysqli_query($con, $q);

        // Success popup    
        echo
        "
            <script>
                alert('New class link saved succesfully!');
                window.location.href='tutor.php';
            </script>
        ";

        // Clear results and close the connection
        //mysqli_free_result($res);
        mysqli_close($con);
    } else {
        header("Location: tutor.php");
    }
} else {
    header("Location: login.php");
}
