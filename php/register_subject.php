<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Registration</title>
    <style>
        #table1,
        #table1 th,
        #table1 td {
            border: 1.5px solid black;
            border-collapse: collapse;
        }

        #table1 th {
            background-color: lightblue;
        }

        #table1 td {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php session_start();
    // Student
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to list user details
        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($result);
        echo "<br><h2>Welcome to Subject Registration Page, " . $r['userName'] . "</h2><a href=student.php>Go back to student dashboard</a><br><br>";

        echo '
        <p>Select the course(s) from the list below for your SPM journey in Let Us Score. You may either take only one, some, or include them all. It would cost RM50 for each individual class.</p>
        <form id="subjectForm" method="post"  action="register_subject_save.php" enctype="multipart/form-data">
            <table id="table1" style="width:30%;">
            <caption>Let Us Score! Tuition Timetable</caption>
                <tr>
                    <th>Subject</th>
                    <th>Time</th>
                    <th>Saturday | Slots</th>
                    <th>Sunday | Slots</th>
                </tr>
                <tr>
                    <td>Mathematics</td>
                    <td>8:00 a.m. - 9:00 a.m.</td>
                    <td> 
                        <input type="radio" name="Mathematics" value="1"> |
                        ';
        $q = "SELECT totalStudent FROM class WHERE classID='1'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                    <td> <input type="radio" name="Mathematics" value="2"> |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='2'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                </tr>
                <tr>
                    <td>Additional Mathematics</td>
                    <td>9:00 a.m. - 10:00 a.m.</td>
                    <td> <input type="radio" name="AddMaths" value="3">  |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='3'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                    <td> <input type="radio" name="AddMaths" value="4">  |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='4'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                </tr>
                <tr>
                    <td>Physics</td>
                    <td>1:00 p.m. - 2:00 p.m.</td>
                    <td> <input type="radio" name="Physics" value="5">  |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='5'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                    <td> <input type="radio" name="Physics" value="6"> |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='6'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                </tr>
                <tr>
                    <td>Chemistry</td>
                    <td>2:00 p.m. - 3:00 p.m.</td>
                    <td> <input type="radio" name="Chemistry" value="7">  |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='7'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                    <td> <input type="radio" name="Chemistry" value="8">  |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='8'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                </tr>
                <tr>
                    <td>Biology</td>
                    <td>3:00 p.m. - 4:00 p.m.</td>
                    <td> <input type="radio" name="Biology" value="9">  |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='9'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                    <td> <input type="radio" name="Biology" value="10">  |
                    ';
        $q = "SELECT totalStudent FROM class WHERE classID='10'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_assoc($result);
        echo implode(",", $row);
        echo '/10
                    </td>
                </tr>
            </table>
            Payment Proof: 
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <br><br>
            <button type="submit" name="subjectButton" value="Submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
        ';
    }
    ?>
</body>

</html>