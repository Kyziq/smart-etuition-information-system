<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Class</title>
</head>

<body>
    <?php
    session_start();
    // Admin's
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to display username
        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
        $res = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($res);
        echo "<br><h2>Welcome to Manage Class Page, admin " . $r['userName'] . "</h2><a href=admin.php>Go back to admin dashboard</a><br><br>";


        // Construct and run query to list all classes registration
        $q = "SELECT * FROM class";
        $res = mysqli_query($con, $q);

        // Pending
        echo    "<br><h3>Classes Table:</h3>";
        echo    "<form method='post' action='manage_class_save.php'>";
        echo    "<table border='1' style='text-align:center;'>";
        echo    "<tr>
                    <th>Class ID</th>
                    <th>Class Subject</th>
                    <th>Class Link</th>
                    <th>Class Day</th>
                    <th>Class Time</th>
                    <th>Class Fee</th>
                    <th>Total Student</th>
                    <th>Action (Save)</th>
                </tr>";
        while ($r = mysqli_fetch_assoc($res)) {
            // Output all classes in a table
            echo    "<tr>
                        <td><input type='text' id='subject' style='text-align:center;' size='1' placeholder='" . $r['classID'] . "'disabled></td>
                        <td><input type='text' style='text-align:center;' size='20' value='" . $r['classSubject'] . "'></td>
                        <td><input type='text' style='text-align:center;' size='30' value='" . $r['classLink'] . "'></td>
                        <td><input type='text' style='text-align:center;' size='10' value='" . $r['classDay'] . "'></td>
                        <td><input type='text' style='text-align:center;' size='10' value='" . $r['classTime'] . "'></td>
                        <td><input type='text' style='text-align:center;' size='2' value='" . $r['classFee'] . "'></td>
                        <td><input type='text' style='text-align:center;' size='1' value='" . $r['totalStudent'] . "'disabled></td>
                        <td>
                            <button type='submit'>
                            <img
                                src='../images/icons/floppy-disk-solid.svg'
                                id='saveClassButton'
                                height='25px'
                            />
                            </button>
                        </td>
                    </tr>";
        }
        echo "</table>";
        echo "</form>";
        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    }
    ?>

</body>

</html>