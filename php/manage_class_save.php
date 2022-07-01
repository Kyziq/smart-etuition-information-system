<?php
session_start();
// Admin's
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
    // Check if save is clicked
    if (isset($_POST['saveClassButton'])) {
        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Success popup
        echo
        "
            <script>
                alert('Class saving successful!');
                window.location.href='manage_class.php';
            </script>
        ";

        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    }
}
