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
        if (isset($_POST['courseButton'])) {
            // Get all the posted items
            if (isset($_POST['Mathematics']))
                $maths = $_POST['Mathematics'];
            if (isset($_POST['AddMaths']))
                $addmaths = $_POST['AddMaths'];
            if (isset($_POST['Physics']))
                $physics = $_POST['Physics'];
            if (isset($_POST['Chemistry']))
                $chemistry = $_POST['Chemistry'];
            if (isset($_POST['Biology']))
                $biology = $_POST['Biology'];


            // Connect to db
            $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

            $query = "SELECT * FROM user, class WHERE userID=" . $_SESSION['userID'];
            $result = mysqli_query($con, $query);
            $r = mysqli_fetch_assoc($result);
            $stuID = $r['userID'];
            $registerApproval = 3; // 1- approved 2- declined  3- pending

            /*
            //construct and run query to store course registration
            $result = mysqli_query($con, $q);

            while ($r = mysqli_fetch_assoc($result)) {
                $q = "INSERT INTO feedback(fbTitle, fbComment, adminID, stuID) VALUES ('$fbTitle','$fbComment', NULL, '$userID')";
            }
            */
            if (isset($_POST['Mathematics'])) {
                $q = "INSERT INTO register(classID, stuID, registerApproval) VALUES ('$maths', '$stuID', '$registerApproval')";
                mysqli_query($con, $q);
            }
            if (isset($_POST['AddMaths'])) {
                $q = "INSERT INTO register(classID, stuID, registerApproval) VALUES ('$addmaths', '$stuID', '$registerApproval')";
                mysqli_query($con, $q);
            }
            if (isset($_POST['Physics'])) {
                $q = "INSERT INTO register(classID, stuID, registerApproval) VALUES ('$physics', '$stuID', '$registerApproval')";
                mysqli_query($con, $q);
            }
            if (isset($_POST['Chemistry'])) {
                $q = "INSERT INTO register(classID, stuID, registerApproval) VALUES ('$chemistry', '$stuID', '$registerApproval')";
                mysqli_query($con, $q);
            }
            if (isset($_POST['Biology'])) {
                $q = "INSERT INTO register(classID, stuID, registerApproval) VALUES ('$biology', '$stuID', '$registerApproval')";
                mysqli_query($con, $q);
            }

            // Success popup
            echo
            "
            <script>
                alert('Subject(s) registration successful');
                window.location.href='student.php';
            </script>
            ";

            // Clear results and close the connection
            // mysqli_free_result($res);
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