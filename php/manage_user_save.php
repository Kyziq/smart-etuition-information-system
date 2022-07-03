<?php
session_start();
// Admin's
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
    // Check if save is clicked
    if (isset($_POST['saveUserButton'])) {
        // Get all the posted items
        $userID = $_POST['userID'];
        $userUname = $_POST['userUname'];
        $userName = $_POST['userName'];
        $userPhone = $_POST['userPhone'];
        $userEmail = $_POST['userEmail'];
        $userGender = $_POST['userGender'];
        $userBirthdate = $_POST['userBirthdate'];
        $userAddress = $_POST['userAddress'];

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to update class database
        $q = "UPDATE user SET userUname='$userUname', userName='$userName', userPhone='$userPhone', userEmail='$userEmail', userGender='$userGender', userBirthdate='$userBirthdate', userAddress='$userAddress' WHERE userID=$userID";
        $res = mysqli_query($con, $q);

        // Success popup
        echo
        "
            <script>
                alert('User saving successful!');
                window.location.href='manage_user.php';
            </script>
        ";

        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    } else
        header("Location: manage_user.php");
}
