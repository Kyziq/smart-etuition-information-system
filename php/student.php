<?php
// Student Main Page
session_start();
if(isset($_SESSION['userName']) && $_SESSION['ulevel']==3) {

    //connect to db
    $con=mysqli_connect('localhost','root','','smartetuition') or die(mysqli_error($con));

    //construct and run query to list user details
    $q="select userUname from user where id=".$_SESSION['userID'];
    $res=mysqli_query($con,$q);
    $r=mysqli_fetch_assoc($res);
    echo "<br><h2>Welcome ".$r['userUname']."</h2>";
    echo "<br><h3>Phone Number: ".$r['userPhone']."</h3>";
    echo "<br><h3>Email: ".$r['userEmail']."</h3>";
    echo "<br><h3>Gender: ".$r['userGender']."</h3>";
    echo "<br><h3>Birthdate: ".$r['userBirthdate']."</h3>";
    echo "<br><h3>Address: ".$r['userAddress']."</h3>";

    //construct and run query to display timetable
    $q="select * from class";
    $res=mysqli_query($con,$q);

    echo "<table> <caption>Let Us Score! Tuition Timetable</caption>";
    echo "
        <tr>
        	<th>Time</th>
            <th>Saturday</th>
            <th>Sunday</th>
        </tr>
        <tr>
        	<td>8:00 a.m. - 9:00 a.m.</td>
            <td colspan="2">Mathematics</td>
        </tr>
        <tr>
            <td>9:00 a.m. - 10:00 a.m.</td>
            <td colspan="2">Additional<br>Mathematics</td>
        </tr>
        <tr>
            <td>1:00 p.m. - 2:00 p.m.</td>
            <td colspan="2">Physics</td>
        </tr>
        <tr>
            <td>2:00 p.m. - 3:00 p.m.</td>
            <td colspan="2">Chemistry</td>
        </tr>
        <tr>
            <td>3:00 p.m. - 4:00 p.m.</td>
            <td colspan="2">Biology</td>
        </tr>";
    echo "</table>";

    //clear results and close the connection
    mysqli_free_result($res);
    mysqli_close($con);
}
else {
    header("Location: login.html");
}
?>