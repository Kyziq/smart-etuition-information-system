<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    </style>
</head>

<body>
    <?php
    // Admin Main Page
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to list admin details
        $q = "select userUname, userName, userPhone, userEmail, userGender, userBirthdate, userAddress from user where userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($result);
        echo "<br><h2>Welcome admin " . $r['userUname'] . "</h2><a href=logout.php>Logout</a>";
        echo "<h3>Name: " . $r['userName'] . "</h3>";
        echo "<h3>Phone Number: " . $r['userPhone'] . "</h3>";
        echo "<h3>Email: " . $r['userEmail'] . "</h3>";

        if ($r['userGender'] == 1) // 1 == Male, 2 == Female
            $gender = "Male";
        else if ($r['userGender'] == 2)
            $gender = "Female";
        echo "<h3>Gender: " . $gender . "</h3>";

        echo "<h3>Birthdate: " . $r['userBirthdate'] . "</h3>";
        echo "<h3>Address: " . $r['userAddress'] . "</h3>";

        mysqli_free_result($result);
    } else {
        header("Location: login.php");
    }

    echo "<a href=verify_subject.php><h3>Verify Subject Registration</h3></a>";
    mysqli_close($con);
    ?>
</body>

</html>