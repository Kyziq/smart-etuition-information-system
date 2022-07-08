<?php
session_start();
// Admin's
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
    // Check if save is clicked
    if (isset($_POST['saveUserButton'])) {
        // Connect to database 
        include_once 'dbcon.php';
        // Get all the posted items
        $userID = $_POST['userID'];
        $userLevel = $_POST['userLevel'];
        //$userUname = $_POST['userUname'];
        $userName = $_POST['userName'];
        $userPhone = $_POST['userPhone'];
        $userEmail = $_POST['userEmail'];
        $userGender = $_POST['userGender'];
        $userBirthdate = $_POST['userBirthdate'];
        $userAddress = $_POST['userAddress'];

        // Construct and run query to update class database
        $q = "UPDATE user SET userName='$userName', userPhone='$userPhone', userEmail='$userEmail', userGender='$userGender', userBirthdate='$userBirthdate', userAddress='$userAddress' WHERE userID=$userID";
        $res = mysqli_query($con, $q);

        if ($userLevel == 2) // Tutor
        {
            // Success popup
            echo
            "
            <script>
                alert('User saving successful!');
                window.location.href='manage_tutor.php';
            </script>
        ";
        } else if ($userLevel == 3) { // Student
            // Success popup
            echo
            "
            <script>
                alert('User saving successful!');
                window.location.href='manage_student.php';
            </script>
        ";
        }

        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    } else
        header("Location: manage_user.php");
} else
    header("Location: login.php");
