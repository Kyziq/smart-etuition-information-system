<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #timetable,
        #timetable th,
        #timetable td {
            border: 1.5px solid black;
            border-collapse: collapse;
        }

        #timetable th {
            background-color: lightblue;
        }

        #timetable td {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    // Student Main Page
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to list user details
        $q = "select userUname, userName, userPhone, userEmail, userGender, userBirthdate, userAddress from user where userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($result);
        echo "<br><h2>Welcome " . $r['userUname'] . "</h2><a href=logout.php>Logout</a>";
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

        // Construct and run query to display timetable

        $q = "SELECT userID, userName, userUname, classSubject, classDay, classTime FROM user u, class c, register r WHERE userID=" . $_SESSION['userID'] . " AND u.userID=r.stuID AND r.classID=c.classID";
        $result = mysqli_query($con, $q);

        echo "<table id='timetable'> <caption>" . $r['userName'] . "'s Tuition Timetable</caption>"; // Table title


        echo "
            <tr>
                <th>Time</th>
                <th>Subject</th>
                <th>Day</th>
            </tr>";
        while ($r = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $r['classTime'] . "</td><td>" . $r['classSubject'] . "</td><td>" . $r['classDay'] . "</td></tr>";
        }
        /*
        while ($r = mysqli_fetch_assoc($result)) {
            echo "         
            <tr>
            <td>8:00 a.m. - 9:00 a.m.</td>
            <td colspan='1'>";

            if ($r['classTime'] == "08:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
            } else
                echo "No class";
            echo "</td>";
            echo "<td>";
            if ($r['classTime'] == "08:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
            } else {
                echo "No class";
            }
            echo "</td>
            </tr>
    
    
            <tr>
            <td>9:00 a.m. - 10:00 a.m.</td>
                <td colspan='1'>";
            if ($r['classTime'] == "09:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
            } else
                echo "No class";
            echo "</td>";
            echo "<td>";
            if ($r['classTime'] == "09:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
            } else {
                echo "No class";
            }
            echo "</td>
            </tr>
    
            
            <tr>
            <td>1:00 p.m. - 2:00 p.m.</td>
                <td colspan='1'>";
            if ($r['classTime'] == "13:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
            } else
                echo "No class";
            echo "</td>";
            echo "<td>";
            if ($r['classTime'] == "13:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
            } else {
                echo "No class";
            }
            echo "</td>
            </tr>
    
    
            <tr>
            <td>2:00 p.m. - 3:00 p.m.</td>
                <td colspan='1'>";
            if ($r['classTime'] == "14:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
            } else
                echo "No class";
            echo "</td>";
            echo "<td>";
            if ($r['classTime'] == "14:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
            } else {
                echo "No class";
            }
            echo "</td>
            </tr>
    
    
            <tr>
            <td>3:00 p.m. - 4:00 p.m.</td>
                <td colspan='1'>";
            if ($r['classTime'] == "15:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
            } else
                echo "No class";
            echo "</td>";
            echo "<td>";
            if ($r['classTime'] == "15:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
            } else {
                echo "No class";
            }
            echo "</td>
            </tr>";
        }*/
        echo "</table>";

        //clear results and close the connection
        mysqli_free_result($result);
        mysqli_close($con);
    } else {
        header("Location: login.html");
    }
    echo "<a href=add_feedback.php><h3>Submit feedback</h3></a>";
    ?>
</body>

</html>