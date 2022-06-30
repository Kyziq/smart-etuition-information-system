<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
        if (isset($_POST['registerButton'])) {
            //get all the posted items
            $fbTitle = $_POST['fbTitle'];
            $fbComment = $_POST['fbComment'];
            $userID = $_SESSION['userID'];

            // Connect to db
            $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

            //construct and run query to store course registration
            $result = mysqli_query($con, $q);

            while ($r = mysqli_fetch_assoc($result)) {
                $q = "INSERT INTO feedback(fbTitle, fbComment, adminID, stuID) VALUES ('$fbTitle','$fbComment', NULL, '$userID')";
            }

            echo "<h1>New feedback saved.  <a href=student.php>Student Dashboard</a></h1>";

            //clear results and close the connection
            //    mysqli_free_result($res);
            mysqli_close($con);
        } else {
            header("Location: student.php");
        }
    } else {
        header("Location: login.html");
    }
    ?>
</body>

</html>