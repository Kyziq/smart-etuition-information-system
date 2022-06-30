<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback</title>
</head>

<body>

    <?php
    session_start();
    // Student
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($result);

        echo "<br><h2>Welcome to Feedback Page, " . $r['userName'] . "</h2><a href=student.php>Go back to student dashboard</a><br><br>";

        echo '<form method="post" action="feedback_save.php">';
        echo "<br>Name: " . $r['userName']; // Table title
        date_default_timezone_set('Asia/Singapore');
        $date = date('d-m-y h:i:s A');
        echo "<br>Date: " . $date;
        echo '<br>Title: <input type="text" placeholder="Enter your title" name="fbTitle"';
        echo '<br><br>Comment: <br><textarea placeholder="Enter your comment" rows="8" cols="80" name="fbComment"></textarea>';
        echo '<br><input type="submit" name="submitFbButton" value="Submit"> <button type="reset">Reset</button>';
        echo "</form>";

        //construct and run query to list user's feedbacks
        $q = "SELECT * FROM feedback WHERE stuID=" . $_SESSION['userID'];
        $res = mysqli_query($con, $q);
        echo "<br><h3>My Feedback:</h3>\n";
        echo "<table border=1>\n";
        echo    "<tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Comment</th>
                    <th>Feedback Date</th>
                </tr>\n";
        while ($r = mysqli_fetch_assoc($res)) {
            echo "<tr><td>" . $r['fbID'] . "</td><td>" . $r['fbTitle'] . "</td><td>" . $r['fbComment'] . "</td><td>" . $r['fbDate'] . "</td></tr>\n";
        }
        echo "</table>";

        mysqli_close($con);
    }
    // Admin
    else if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
        $res = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($res);
        echo "<br><h2>Welcome to Feedback Page, admin " . $r['userName'] . "</h2><a href=admin.php>Go back to admin dashboard</a><br><br>";

        // Construct and run query to list all students' feedbacks
        $q = "SELECT * FROM feedback";
        $res = mysqli_query($con, $q);
        echo "<br><h3>Students' Feedback:</h3>\n";
        echo "<table border=1>\n";
        echo    "<tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Comment</th>
                    <th>Feedback Date</th>
                </tr>\n";
        while ($r = mysqli_fetch_assoc($res)) {
            echo "<tr><td>" . $r['fbID'] . "</td><td>" . $r['fbTitle'] . "</td><td>" . $r['fbComment'] . "</td><td>" . $r['fbDate'] . "</td></tr>\n";
        }
        echo "</table>";

        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    }
    ?>
</body>

</html>