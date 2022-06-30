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
    $q = "select * from user where userName='$userName'";
    $result = mysqli_query($con, $q);
    $rows = mysqli_num_rows($result);
    if ($rows != 0) header("Location: register.html");

    // Construct and run query to store new user
    $q = "insert into user(userUname, userPassw, userName, userPhone, userEmail, userGender, userBirthdate, userAddress) 
        values ('$userUname','$userPassw','$userName','$userPhone','$userEmail','$userGender','$userBirthdate','$userAddress')";

    $result = mysqli_query($con, $q);

    // Success popup
    echo
    "
    <script>
        alert('Registration successful.');
        window.location.href='login.html';
    </script>
    ";

    // Clear results
    // mysqli_free_result($res);

    // Close conection
    mysqli_close($con);
} else {
    header("Location: register.html");
}
