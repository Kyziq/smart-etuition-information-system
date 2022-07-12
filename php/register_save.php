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
    if (isset($_POST['registerButton'])) {
        // Connect to database 
        include_once 'dbcon.php';
        // Get all the posted items
        $userUname = mysqli_real_escape_string($con, $_POST['userUname']);
        $userPassw = mysqli_real_escape_string($con, $_POST['userPassw']);
        $userName = mysqli_real_escape_string($con, $_POST['userName']);
        $userPhone = mysqli_real_escape_string($con, $_POST['userPhone']);
        $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
        $userGender = mysqli_real_escape_string($con, $_POST['userGender']);
        $userBirthdate = mysqli_real_escape_string($con, $_POST['userBirthdate']);
        $userAddress = mysqli_real_escape_string($con, $_POST['userAddress']);

        // Construct and run query to check if username is taken
        $q = "SELECT * FROM user WHERE userUname='$userUname'";
        $res = mysqli_query($con, $q);

        if (mysqli_num_rows($res) != 0) {
            // Fail popup
            echo
            "
            <script>
                // Error popup
                Swal.fire({
                    icon: 'error',
                    title: 'Registration failed. The username has been taken.',
                    text: '(Auto close in 5 seconds)',
                    showConfirmButton: true,
                    confirmButtonText: 'Confirm',
                    backdrop: `#192e59`,
                    timer: 5000,
                    willClose: () => {
                        window.location.href = 'register.php';
                    }
                })
            </script>
            ";
        } else {
            // Construct and run query to store new user
            $q =    "INSERT INTO user(userUname, userPassw, userName, userPhone, userEmail, userGender, userBirthdate, userAddress) 
                VALUES ('$userUname','$userPassw','$userName','$userPhone','$userEmail','$userGender','$userBirthdate','$userAddress')";
            $res = mysqli_query($con, $q);

            // Success popup
            echo
            "
            <script>
                // Error popup
                Swal.fire({
                    icon: 'success',
                    title: 'Registration successful.',
                    text: '(Auto close in 5 seconds)',
                    showConfirmButton: true,
                    confirmButtonText: 'Confirm',
                    backdrop: `#192e59`,
                    timer: 5000,
                    willClose: () => {
                        window.location.href = 'login.php';
                    }
                })
            </script>
            ";
        }
        // Clear result and close the connection
        // mysqli_free_result($res);
        mysqli_close($con);
    } else
        header("Location: register.php");
    ?>
</body>

</html>