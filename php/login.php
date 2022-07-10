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
    <title>Login Page</title>
</head>

<body>
    <span id="register">
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
                        <input type="text" placeholder="Username" name="userUname" required />
                        <span class="text">
                            <?php
                            // Check for wrong password
                            if (isset($_GET["msg"]) && $_GET["msg"] == 'failed')
                                echo '<span style="color: #ed2146; font-size: 15px;"><b>Wrong username or password!</b></span>';
                            ?>
                        </span>
                    </div>

                    <div class="input-field">
                        <label>Password</label>
                        <input type="password" placeholder="Password" name="userPassw" required />
                        <span class="text">
                            <a href="forgot_password.php">Forgot your password?</a>
                        </span>
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
            <span class="text">Don't have an account?
                <a href="register.php">Register Now</a>
            </span>
        </div>
        <script src="../js/script.js"></script>
    </span>
</body>

</html>