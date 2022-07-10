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
    <title>Forgot Password</title>
</head>

<body>
    <span id="register">
        <div class="logoImage">
            <a href="../home.html">
                <img src="../images/logocircle.png" alt="Logo Let Us Score!" />
            </a>
        </div>
        <div class="container">
            <header>Trouble Logging In?</header>
            <form method="post" action="reset_code.php">
                <br>
                <div class="fields">
                    <div class="input-field">
                        <label>Enter your email address</label>
                        <input type="text" placeholder="Email address" name="userEmail" required />
                        <span class="text">
                        </span>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" name="forgotPasswordButton" value="Submit">
                        <span class="btnText"> Continue </span>
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