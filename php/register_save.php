<?php

if (isset($_POST['registerButton'])) {

    // Get all the posted items
    $userUname = $_POST['userUname'];
    $userPassw = $_POST['userPassw'];
    $userName = $_POST['userName'];
    $userPhone = $_POST['userPhone'];
    $userEmail = $_POST['userEmail'];
    $userGender = $_POST['userGender'];
    $userBirthdate = $_POST['userBirthdate'];
    $userAddress = $_POST['userAddress'];

    // Connect to database
    $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

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
} else {
    header("Location: register.php");
}
