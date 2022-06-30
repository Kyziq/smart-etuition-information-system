<?php
session_start();
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
    if (isset($_POST['submitFbButton'])) {
        //get all the posted items
        $fbTitle = $_POST['fbTitle'];
        $fbComment = $_POST['fbComment'];
        $userID = $_SESSION['userID'];

        // Connect to db
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        //construct and run query to store new van  
        $q = "INSERT INTO feedback(fbTitle, fbComment, adminID, stuID) VALUES ('$fbTitle','$fbComment', NULL, '$userID')";
        $res = mysqli_query($con, $q);

        echo
        "
        <script>
            alert('New feedback saved!');
            window.location.href='student.php';
        </script>
        ";

        // Clear results and close the connection
        // mysqli_free_result($res);
        mysqli_close($con);
    } else {
        header("Location: student.php");
    }
} else {
    header("Location: login.php");
}
