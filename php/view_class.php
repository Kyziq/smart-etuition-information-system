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
    // Student's
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Student's name
        $q = "select userName from user where userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($result);
        echo $r['userName'] . "'s classes";


        // Construct and run query to list user's classes
        $q = "  SELECT c.classID, c.classSubject, c.classTime, c.classLink, c.totalStudent, tutor.userName, tutor.userEmail, tutor.userPhone 
                FROM register r, user u, user tutor, class c 
                WHERE c.classID=r.classID AND r.stuID=u.userID AND r.registerApproval='1' AND tutor.userLevel='2' AND tutor.userID=c.tutorID";

        $result = mysqli_query($con, $q);

        echo "<table border='1' style='text-align:center;'>";
        echo    "<tr>
                    <th>Class Subject</th>
                    <th>Class Time</th>
                    <th>Class Link</th>
                    <th>Total Student(s)</th>
                    <th>Tutor's Name</th>
                    <th>Tutor's Phone</th>
                    <th>Tutor's Email</th>
                </tr>\n";
        while ($r = mysqli_fetch_assoc($result)) {
            echo    "<tr>
                        <td>" . $r['classSubject'] . "</td>
                        <td>" . $r['classTime'] . "</td>
                        <td>
                            <a href='" . $r['classLink'] . "'>
                                " . $r['classLink'] . "
                            </a>
                        </td>
                        <td>" . $r['totalStudent'] . "</td>
                        <td>" . $r['userName'] . "</td>
                        <td>" . $r['userEmail'] . "</td>
                        <td>" . $r['userPhone'] . "</td>
                    </tr>";
        }
        echo "</table>";

        mysqli_close($con);
    }
    ?>
</body>

</html>