<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($result);

        echo '<form method="post" action="save_feedback.php">';
        echo "<br>Name: " . $r['userName']; // Table title
        date_default_timezone_set('Asia/Singapore');
        $date = date('d-m-y h:i:s');
        echo "<br>Date: " . $date;
        echo '<br>Title: <input type="text" placeholder="Enter your title" name="fbTitle"';
        echo '<br><br>Comment: <br><textarea placeholder="Enter your comment" rows="8" cols="80" name="fbComment"></textarea>';
        echo '<br><input type="submit" name="submitFbButton" value="Submit"> <button type="reset">Reset</button>';
        echo "</form>";
    }
    ?>
</body>

</html>