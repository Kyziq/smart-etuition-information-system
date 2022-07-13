<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Iconscout CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- Title -->
    <link rel="icon" href="../images/icon.ico" />
    <title>New Password</title>

    <script src='../js/sweetalert2/sweetalert2.all.min.js'></script>
</head>

<body>
    <?php
    session_start();
    include_once 'dbcon.php';

    if (isset($_POST['resetCodeButton'])) {
        $userCode = mysqli_real_escape_string($con, $_POST['userCode']);
        $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);

        // Construct and run query to check for existing e-mail
        $q = "SELECT userCode FROM user WHERE userCode LIKE '%" . $userCode . "%'";
        $res = mysqli_query($con, $q);
        $num = mysqli_num_rows($res);

        // User code is not the same
        if (!$num) {
            /*
            echo
            "
                <script>
                // Error popup
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong code entered.',
                    text: '(Auto close in 5 seconds)',
                    showConfirmButton: true,
                    confirmButtonText: 'Confirm',
                    backdrop: `#192e59`,
                    timer: 5000,
                    willClose: () => {
                        window.location.href = 'reset_code.php';
                    }
                })
                </script>
            ";
            */
            header("Location: reset_code.php");
        }
    }
    ?>


    <span id="register">
        <div class="logoImage">
            <a href="../home.html">
                <img src="../images/logocircle.png" alt="Logo Let Us Score!" />
            </a>
        </div>
        <div class="container">
            <header>New Password</header>
            <form method="post" action="new_password_save.php">
                <br>
                <div class="fields">
                    <div class="input-field">
                        <label>Enter the new password</label>
                        <input type="hidden" name="userEmail" value=<?php echo $userEmail ?> />
                        <input type="text" placeholder="New password" name="newPassword" required />

                        <span class="text">

                        </span>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" name="newPasswordButton" value="Submit">
                        <span class="btnText">Submit</span>
                    </button>
                </div>
            </form>
            <span class="text">
                <a href="register.php">Register</a> |
                <a href="login.php">Login</a>
            </span>
        </div>
        <script src="../js/script.js"></script>
    </span>
</body>

</html>