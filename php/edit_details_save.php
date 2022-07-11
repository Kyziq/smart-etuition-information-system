<!DOCTYPE html>
<html lang="en">

<head>
    <script src='../js/sweetalert2/sweetalert2.all.min.js'></script>
    <style>
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    // Student or Tutor
    if (isset($_SESSION['userID']) && ($_SESSION['userLevel'] == 2 || $_SESSION['userLevel'] == 3)) {
        // Check if save is clicked
        if (isset($_POST['editDetailsButton'])) {
            // Connect to database 
            include_once 'dbcon.php';

            // Get all the posted items
            $userID = $_POST['userID'];
            $userUname = $_POST['userUname'];
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userEmail = $_POST['userEmail'];
            $userGender = $_POST['userGender'];
            $userBirthdate = $_POST['userBirthdate'];
            $userAddress = $_POST['userAddress'];

            // Construct and run query to update new details using prepared statements
            $q = "UPDATE user SET userUname=?, userName=?, userPhone=?, userEmail=?, userGender=?, userBirthdate=?, userAddress=? WHERE userID=?";
            $stmt = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt, $q))
                echo "SQL statement failed";
            else {
                mysqli_stmt_bind_param($stmt, "ssssissi", $userUname, $userName, $userPhone, $userEmail, $userGender, $userBirthdate, $userAddress, $userID);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
            }

            /* Old
            // Get all the posted items
            $userID = $_POST['userID'];
            $userUname = $_POST['userUname'];
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userEmail = $_POST['userEmail'];
            $userGender = $_POST['userGender'];
            $userBirthdate = $_POST['userBirthdate'];
            $userAddress = $_POST['userAddress'];

            // Construct and run query to update class database
            $q = "UPDATE user SET userUname='$userUname', userName='$userName', userPhone='$userPhone', userEmail='$userEmail', userGender='$userGender', userBirthdate='$userBirthdate', userAddress='$userAddress' WHERE userID=$userID";
            $res = mysqli_query($con, $q);
            */

            // Clear results and close the connection
            // mysqli_free_result($res);
            mysqli_close($con);
        } else
            header("Location: edit_details.php");
    } else
        header("Location: login.php");
    ?>
    <script>
        // Success popup
        Swal.fire({
            icon: 'success',
            title: 'New details has been saved.',
            text: '(Auto close in 5 seconds)',
            showConfirmButton: true,
            confirmButtonText: 'Confirm',
            backdrop: `#192e59`,
            timer: 5000,
            willClose: () => {
                window.location.href = "edit_details.php";
            }
        })
    </script>
</body>

</html>