<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">
    <!-- ChartJS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Title -->
    <link rel="icon" href="../images/icon.ico" />
    <title>Admin Dashboard</title>
</head>

<body>
    <?php
    // Admin Dashboard
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1)
        // Connect to database 
        include_once 'dbcon.php';
    else
        header("Location: login.php");
    ?>
    <!-- Admin Navigation -->
    <div class="container">
        <div class="navigation">
            <!-- Dashboard List -->
            <ul>
                <li>
                    <a href="admin.php">
                        <span class="icon">
                            <img src="../images/logocircle.png" alt="Logo Let Us Score!" id="logoLUS" />
                        </span>
                    </a>
                </li>
                <li>
                    <a href="admin.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="manage_student.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Manage Student</span>
                    </a>
                </li>
                <li>
                    <a href="manage_tutor.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Manage Tutor</span>
                    </a>
                </li>
                <li>
                    <a href="manage_class.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Manage Class</span>
                    </a>
                </li>
                <li>
                    <a href="verify_subject.php">
                        <span class="icon">
                            <ion-icon name="checkmark-outline"></ion-icon>
                        </span>
                        <span class="title">Class Verification</span>
                    </a>
                </li>
                <li>
                    <a href="view_class_admin.php">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                        <span class="title">Class Details</span>
                    </a>
                </li>
                <li>
                    <a href=feedback.php>
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Feedback</span>
                    </a>
                </li>
                &nbsp;
                <li>
                    <a href=logout.php>
                        <span class="icon" style="color:#ed2146;">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title" style="color:#ed2146;">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main -->
        <div class="main">
            <div class="topbar">
                <!-- Menu toggle -->
                <div class="toggle">
                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/xhebrhsj.json" trigger="loop-on-hover" colors="primary:#121331" state="hover" style="width:45px;height:45px">
                    </lord-icon>
                </div>
                <!-- Time update (every 1s) on top -->
                <span>
                    <div style="position: absolute; right: 500px; top: 5px;">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/drtetngs.json" trigger="loop-on-hover" colors="primary:#192e59" style="width:50px;height:50px">
                        </lord-icon>
                    </div>
                    <script>
                        setInterval(function() {
                            document.getElementById('current-time').innerHTML = new Date().toString();
                        }, 1);
                    </script>
                    <div style='font-family: "Helvetica", sans-serif; font-size: 20px; font-weight: 500;' id='current-time'></div>
                </span>
            </div>
            <div class="details" style="display: inline-block;">
                <div style='text-align:center'>
                    <form method="post" action="view_class_admin.php">
                        <h2>Choose the day and the subject to view the class list below:</h2>
                        <br>
                        <select name="day">
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select> <br>
                        <button type="submit" name="subject" value="Mathematics" class="btn">
                            <span class="btnText"> Mathematics </span>
                        </button>&nbsp;&nbsp;
                        <button type="submit" name="subject" value="Additional Mathematics" class="btn">
                            <span class="btnText"> Add. Mathematics </span>
                        </button>&nbsp;&nbsp;
                        <button type="submit" name="subject" value="Physics" class="btn">
                            <span class="btnText"> Physics </span>
                        </button>&nbsp;&nbsp;
                        <button type="submit" name="subject" value="Chemistry" class="btn">
                            <span class="btnText"> Chemistry </span>
                        </button>&nbsp;&nbsp;
                        <button type="submit" name="subject" value="Biology" class="btn">
                            <span class="btnText"> Biology </span>
                        </button>
                    </form>
                </div>
                <div class="recentOrders">
                    <?php
                    // Construct and run query to display student details
                    if (isset($_POST['day'])) {
                        $classDay = $_POST['day'];
                        $classSubject = $_POST['subject'];

                        $q = "SELECT u.userID, u.userLevel, u.userName, u.userPhone, u.userEmail, u.userGender, u.userBirthdate, u.userAddress, r.registerDate
                        FROM user u, class c, register r 
                        WHERE c.classDay='$classDay' AND c.classSubject='$classSubject' AND u.userLevel='3' AND r.registerApproval='1' AND u.userID=r.stuID AND r.classID=c.classID
                        ORDER BY u.userName";
                        $res = mysqli_query($con, $q);
                        $num = mysqli_num_rows($res);
                    ?>
                        <div class="cardHeader">
                            <h2>
                                Class List (
                                <?php
                                echo $classDay;
                                echo " | ";
                                echo $classSubject;
                                ?> )
                            </h2>
                        </div>
                        <?php
                        if ($res) {
                            if ((mysqli_num_rows($res)) > 0) {
                        ?>
                                <div style="max-height: 600px; overflow-y: scroll;">
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <td>Name</td>
                                                <td>Phone</td>
                                                <td>E-mail</td>
                                                <td>Gender</td>
                                                <td>Birthdate</td>
                                                <td>Registered Date</td>
                                                <td>Address</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                // Construct and run query to list user's classes
                                                while ($r = mysqli_fetch_assoc($res)) {
                                                ?>
                                            <tr>
                                                <td> <?php echo $r["userName"] ?></td>
                                                <td> <?php echo $r["userPhone"] ?></td>
                                                <td> <?php echo $r["userEmail"] ?></td>
                                                <td>
                                                    <?php
                                                    if ($r["userGender"] == 1)
                                                        echo "Male";
                                                    else if ($r["userGender"] == 2)
                                                        echo "Female";
                                                    ?>
                                                </td>
                                                <td> <?php echo $r["userBirthdate"] ?></td>
                                                <td> <?php echo $r["registerDate"] ?></td>
                                                <td> <?php echo $r["userAddress"] ?></td>
                                            </tr>
                                        <?php
                                                }
                                        ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- #Scripts -->
    <script src="../js/dash.js"></script>

    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <?php
    // Clear results and close the connection
    mysqli_free_result($res);
    mysqli_close($con);
    ?>
</body>

</html>