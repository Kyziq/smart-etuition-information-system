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
        $subject = $_POST['subject'];
        $link = $_POST['link'];
        $day = $_POST['day'];
        $time = $_POST['time'];
        $fee = $_POST['fee'];

        // Construct and run query to update class database
        $q = "UPDATE class SET classSubject='$subject', classLink='$link', classDay='$day', classTime='$time', classFee='$fee' WHERE classID=$classID";
        $res = mysqli_query($con, $q);

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
    } else
        header("Location: manage_class.php");
}
