<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Image beside title -->
    <link rel="icon" href="../images/icon.ico" />

</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Smart E-Tuition Register</title>
        <!-- CSS -->
        <link rel="stylesheet" href="../css/style.css" />
        <!-- Iconscout CSS -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    </head>

    <body id="register">
        <div class="logoImage">
            <a href="../home.html">
                <img src="../images/logocircle.png" alt="Logo Let Us Score!" />
            </a>
        </div>
        <div class="container">
            <header>Login Page</header>
            <form name="loginForm" method="post" action="login_success.php">
                <div class="fields">
                    <div class="input-field">
                        <label>Username</label>
                        <input type="text" placeholder="Enter your username" name="userUname" required />
                    </div>
                    <div class="input-field">
                        <label>Password</label>
                        <input type="password" placeholder="Enter your password" name="userPassw" required />
                        <?php
                        // Check for wrong password
                        if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                            echo
                            '
                            <p style="color: #ed2146; font-size: 15px;"><b>Wrong Password!</b></p>
                            ';
                        }
                        ?>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" name="loginButton" value="Submit">
                        <span class="btnText"> Login ‎ ‎ ‎</span>
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/iifryyua.json" trigger="loop" colors="primary:#ffffff" state="hover-3" style="width:32px;height:32px">
                        </lord-icon>
                    </button>
                </div>
            </form>
            <span class="text">Not a member?
                <a href="register.html">Register Now</a>
            </span>
        </div>

        <script src="../js/script.js"></script>
    </body>

    </html>

    <?php

    ?>
</body>

</html>