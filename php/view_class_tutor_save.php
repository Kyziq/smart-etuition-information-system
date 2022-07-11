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
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 2) {
        if (isset($_POST['saveClassButton'])) {
            // Connect to database 
            include_once 'dbcon.php';

            // Get all the posted items
            $classID = $_POST['classID'];
            $classLink = $_POST['classLink'];

            // Construct and run query to update class link using prepared statements
            $q = "UPDATE class SET classLink=? WHERE classID=?";
            $stmt = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt, $q))
                echo "SQL statement failed";
            else {
                mysqli_stmt_bind_param($stmt, "si", $classLink, $classID);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
            }

            /* Old
        // Get all the posted items
        $classID = $_POST['classID'];
        $classLink = $_POST['classLink'];

        // Construct and run query to update class database
        $q = "UPDATE class SET classLink='$classLink' WHERE classID='$classID'";
        $res = mysqli_query($con, $q);
        */

            // Clear results and close the connection
            //mysqli_free_result($res);
            mysqli_close($con);
        } else
            header("Location: tutor.php");
    } else {
        header("Location: login.php");
    }
    ?>
    <script>
        // Success popup
        Swal.fire({
            icon: 'success',
            title: 'New class link has been saved.',
            text: '(Auto close in 5 seconds)',
            showConfirmButton: true,
            confirmButtonText: 'Confirm',
            backdrop: `#192e59`,
            timer: 5000,
            willClose: () => {
                window.location.href = "tutor.php";
            }
        })
    </script>
</body>

</html>