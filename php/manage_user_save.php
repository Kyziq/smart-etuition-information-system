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

        // Construct and run query to update user details using prepared statements
        $q = "UPDATE user SET userName=?, userPhone=?, userEmail=?, userGender=?, userBirthdate=?, userAddress=? WHERE userID=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $q))
            echo "SQL statement failed";
        else {
            mysqli_stmt_bind_param($stmt, "sssissi", $userName, $userPhone, $userEmail, $userGender, $userBirthdate, $userAddress, $userID);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
        }

        /* Old
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
        */

        // Success popup
        if ($userLevel == 2) // Tutor
        {
            echo
            "
            <script>
                alert('User saving successful!');
                window.location.href='manage_tutor.php';
            </script>
        ";
        } else if ($userLevel == 3) { // Student
            echo
            "
            <script>
                alert('User saving successful!');
                window.location.href='manage_student.php';
            </script>
        ";
        }

        // Clear results and close the connection
        // mysqli_free_result($res);
        mysqli_close($con);
    } else
        header("Location: manage_user.php");
} else
    header("Location: login.php");
