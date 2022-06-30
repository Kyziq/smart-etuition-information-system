<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
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
        $q = "SELECT userUname FROM user WHERE userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($result);
        echo "<br><h2>Welcome to Course Registration Page, " . $r['userUname'] . "</h2><a href=student.php>Go back to student dashboard</a><br><br>";

        echo "
        <p>Choose your desired classes below. For each class/subject would cost RM50</p>
        <form id='courseForm' method='post'>
            <table id='table1' style width=30%>
            <caption>Let Us Score! Tuition Timetable</caption>
                <tr>
                    <th>Time</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
                <tr>
                    <td>8:00 a.m. - 9:00 a.m. (Mathematics)</td>
                    <td> <input type='radio' name='Mathematics' id='MathsSaturday'> </td>
                    <td> <input type='radio' name='Mathematics' id='MathsSunday'> </td>
                </tr>
                <tr>
                    <td>9:00 a.m. - 10:00 a.m. (Additional Mathematics)</td>
                    <td> <input type='radio' name='AddMaths' id='AddMathsSaturday'> </td>
                    <td> <input type='radio' name='AddMaths' id='AddMathsSunday'> </td>
                </tr>
                <tr>
                    <td>1:00 p.m. - 2:00 p.m. (Physics)</td>
                    <td> <input type='radio' name='Physics' id='PhysicsSaturday'> </td>
                    <td> <input type='radio' name='Physics' id='PhysicsSunday'> </td>
                </tr>
                <tr>
                    <td>2:00 p.m. - 3:00 p.m. (Chemistry)</td>
                    <td> <input type='radio' name='Chemistry' id='ChemistrySaturday'> </td>
                    <td> <input type='radio' name='Chemistry' id='ChemistrySunday'> </td>
                </tr>
                <tr>
                    <td>3:00 p.m. - 4:00 p.m. (Biology)</td>
                    <td> <input type='radio' name='Biology' id='BiologySaturday'> </td>
                    <td> <input type='radio' name='Biology' id='BiologySunday'> </td>
                </tr>
            </table>
            <button type='submit'>Submit</button>
        </form>
        ";
    }
    ?>
</body>

</html>