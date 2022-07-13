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
    <title>Code Verification</title>

    <script src='../js/sweetalert2/sweetalert2.all.min.js'></script>
</head>

<body>
    <?php
    session_start();
    include_once 'dbcon.php';

    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['forgotPasswordButton'])) {
        // Get posted item
        $_SESSION['userEmail'] = mysqli_real_escape_string($con, $_POST['userEmail']);
        $_SESSION['userCode'] = rand(999999, 111111);
        // Construct and run query to check for existing e-mail
        $q = "SELECT userEmail FROM user WHERE userEmail LIKE '%" . $_SESSION['userEmail'] . "%'";
        $res = mysqli_query($con, $q);
        $num = mysqli_num_rows($res);

        /*
        // No email found
        if (!$num) {
            echo
            "
                <div class='popup'>
                <script>
                // Error popup
                Swal.fire({
                    icon: 'error',
                    title: 'No email found.',
                    text: '(Auto close in 5 seconds)',
                    showConfirmButton: true,
                    confirmButtonText: 'Confirm',
                    backdrop: `#192e59`,
                    timer: 5000,
                    willClose: () => {
                        window.location.href = 'forgot_password.php';
                    }
                })
                </script>
                </div>
            ";
        }*/
    }
    function sendmail()
    {
        $name = "Let Us Score! (Smart E-Tuition";  // Name of website
        $to = $_SESSION['userEmail'];  // Mail of receiver
        $subject = "Forgot your password?";
        $body = "We received a request to change the password associated with your email address (" . $_SESSION['userEmail'] . ").
        The code required to change your password is " . $_SESSION['userCode'];
        $from = "smartetuition@gmail.com";  //
        $password = "wcrziscpyuxhnbjj ";  //

        // Ignore from here

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();

        // To Here

        //SMTP Settings
        $mail->isSMTP();
        $mail->SMTPKeepAlive = true;
        // $mail->SMTPDebug = 3;  Keep it commented this is used for debugging                          
        $mail->Host = "smtp.gmail.com"; // smtp address of email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // Enter email address whom want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;


        if ($mail->send()) {
            echo "<mark>Your email <b>(" . $_SESSION['userEmail'] . " )</b> has been sent a code. Enter the code in the box above.</mark>";
        } else {
            header("Location: forgot_password.php");
            echo "<mark><b>Something is wrong: </b></mark>" . $mail->ErrorInfo;
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
            <header>Code Verification</header>
            <form method="post" action="new_password.php">
                <br>
                <div class="fields">
                    <div class="input-field">
                        <label>Enter code</label>
                        <input type="hidden" name="userEmail" value=<?php echo $_SESSION['userEmail'] ?> />
                        <input type="text" placeholder="Code" name="userCode" required />
                        <span class="text">
                            <?php
                            sendmail();
                            ?>
                        </span>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" name="resetCodeButton" value="Submit">
                        <span class="btnText">Submit</span>
                    </button>
                </div>
            </form>
            <span class="text">
                <a href="register.php">Register</a> |
                <a href="login.php">Login</a>
            </span>
        </div>
        <?php
        // Construct and run query to update code
        $userEmail = $_SESSION['userEmail'];
        $userCode = $_SESSION['userCode'];
        $q = "UPDATE user SET userCode='$userCode' WHERE userEmail='$userEmail'";
        $res = mysqli_query($con, $q);
        ?>
        <script src="../js/script.js"></script>
    </span>
</body>

</html>