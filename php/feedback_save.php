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
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
        if (isset($_POST['submitFbButton'])) {
            // Connect to database 
            include_once 'dbcon.php';

            // Get all the posted items
            $fbTitle = $_POST['fbTitle'];
            $fbComment = $_POST['fbComment'];
            $userID = $_SESSION['userID'];
            $adminID = NULL;

            // Construct and run query to store new feedback using prepared statements
            $q =    "INSERT INTO feedback(fbTitle, fbComment, adminID, stuID) 
                VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt, $q))
                echo "SQL statement failed";
            else {
                mysqli_stmt_bind_param($stmt, "ssii", $fbTitle, $fbComment, $adminID, $userID);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
            }

            // Clear results and close the connection
            //mysqli_free_result($res);
            mysqli_close($con);
        } else
            header("Location: feedback.php");
    } else
        header("Location: login.php");
    ?>
    <script>
        // Success popup
        Swal.fire({
            icon: 'success',
            title: 'Feedback has been submitted.',
            text: '(Auto close in 5 seconds)',
            showConfirmButton: true,
            confirmButtonText: 'Confirm',
            backdrop: `#192e59`,
            timer: 5000,
            willClose: () => {
                window.location.href = "feedback.php";
            }
        })
    </script>
</body>

</html>