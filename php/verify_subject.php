<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Verification</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {

        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));
        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
        $res = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($res);
        echo "<br><h2>Welcome to Feedback Page, admin " . $r['userName'] . "</h2><a href=admin.php>Go back to admin dashboard</a><br><br>";

        // Construct and run query to list all subjects registration
        $q = "SELECT * FROM register";
        $res = mysqli_query($con, $q);
        echo "<br><h3>Students' Registration:</h3>\n";
        echo "<table border=1>";
        echo    "<tr>
                <th>Class ID</th>
                <th>Student ID</th>
                <th>Registration Date</th>
                <th>Proof of Payment</th>
                <th>Registration Approval</th>
                <th>Action</th>
            </tr>";

        while ($r = mysqli_fetch_assoc($res)) {
            // Register text for 1-3 (from database)
            if ($r['registerApproval'] == 1)
                $registerText = "Accepted";
            else if ($r['registerApproval'] == 2)
                $registerText = "Declined";
            else if ($r['registerApproval'] == 3)
                $registerText = "Pending";

            $image = $r['proofPayment'];

            // Output all registration in a table
            echo    "<tr>
                        <td>" . $r['classID'] . "</td>
                        <td>" . $r['stuID'] . "</td>
                        <td>" . $r['registerDate'] . "</td>
                        <td> 
                            <a href='$image' target=;_blank;>Image</a>
                        </td>
                        <td>" . $registerText . " </td>
                        <td><button>Approve</button></td>
                    </tr>";
        }
        echo "</table>";


        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    }
    ?>
</body>

</html>