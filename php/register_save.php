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
            alert('Registration failed. The username has been taken.');
            window.location.href='register.php';
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
            alert('Registration successful.');
            window.location.href='login.php';
        </script>
        ";
    }
    // Clear ress and close the connection
    mysqli_free_result($res);
    mysqli_close($con);
} else
    header("Location: register.php");
