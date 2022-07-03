<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">

    <!-- JS scripts -->
    <script src="../js/dash.js"></script>
    <script src="../js/script.js"></script>
    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Image beside title -->
    <link rel="icon" href="../images/icon.ico" />

    <title>Class Details</title>
</head>

<body>
    <?php
    session_start();
    // Student's
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));
    ?>
        <!-- =============== Navigation ================ -->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="student.php">
                            <span class="icon">
                                <img src="../images/logocircle.png" alt="Logo Let Us Score!" id="logoLUS" />
                            </span>
                            <!-- <span class="title">Let Us Score</span> -->
                        </a>
                    </li>
                    <li>
                        <a href="student.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="studentdetails.html">
                            <span class="icon">
                                <ion-icon name="options-outline"></ion-icon>
                            </span>
                            <span class="title">Update Details</span>
                        </a>
                    </li>

                    <li>
                        <?php
                        // Construct and run query to check for existing subject registration
                        $q = "SELECT * FROM user u, register r WHERE u.userID=r.stuID AND userID=" . $_SESSION['userID'];
                        $res = mysqli_query($con, $q);
                        $num = mysqli_num_rows($res);

                        if ($res) {
                            if ($num <= 0) {
                                // Will display subject registration option if student does not register yet
                        ?>
                                <a href=register_subject.php>
                                    <span class="icon">
                                        <ion-icon name="person-add-outline"></ion-icon>
                                    </span>
                                    <span class="title">Register Subject(s)</span>
                                </a>
                            <?php
                                mysqli_free_result($res);
                            }
                            ?>
                    </li>

                    <li>
                        <a href="view_class.php">
                            <span class="icon">
                                <ion-icon name="create-outline"></ion-icon>
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

                    <li>
                        <a href=logout.php>
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ========================= Main ==================== -->
            <div class="main">
                <div class="topbar">
                    <!-- Options menu toggle -->
                    <div class="toggle">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/xhebrhsj.json" trigger="loop-on-hover" colors="primary:#121331" state="hover" style="width:45px;height:45px">
                        </lord-icon>
                    </div>

                    <!-- Time update (every 1s) on top -->
                    <span>
                        <script>
                            setInterval(function() {
                                document.getElementById('current-time').innerHTML = new Date().toTimeString();
                            }, 1000);
                        </script>
                        <div style='font-family: "Helvetica", sans-serif; font-size: 20px; font-weight: 500;' id='current-time'></div>
                    </span>


                    <!-- 
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here" />
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                
                <div class="user">
                    <img src="../images/icons/user-solid.svg" alt="" />
                </div>
                -->
                </div>
                <!-- ================ Order Details List ================= -->
                <div class="details" style="display: inline-block;">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>
                                <?php
                                $q = "select userName from user where userID=" . $_SESSION['userID'];
                                $res = mysqli_query($con, $q);
                                $r = mysqli_fetch_assoc($res);
                                echo $r['userName'];
                                ?>
                                's Classes
                            </h2>

                        </div>

                        <?php
                            // Construct and run query to check for existing class
                            $q = "  SELECT c.classID, c.classSubject, c.classTime, c.classLink, c.classDay, c.totalStudent, tutor.userName, tutor.userEmail, tutor.userPhone 
                        FROM register r, user u, user tutor, class c 
                        WHERE c.classID=r.classID AND r.stuID=u.userID AND r.registerApproval='1' AND tutor.userLevel='2' AND tutor.userID=c.tutorID";
                            $res = mysqli_query($con, $q);
                            $num = mysqli_num_rows($res);

                            if ($res) {
                                if ($num > 0) {
                        ?>
                                <table style="width: 97%;">
                                    <thead>
                                        <tr>
                                            <td>Class Subject</td>
                                            <td>Class Day</td>
                                            <td>Class Time</td>
                                            <td>Class Link</td>
                                            <td>Total Student(s)</td>
                                            <td>Tutor's Name</td>
                                            <td>Tutor's Phone</td>
                                            <td>Tutor's Email</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            // Construct and run query to list user's classes
                                            while ($r = mysqli_fetch_assoc($res)) {
                                            ?>
                                        <tr>
                                            <td> <?php echo $r["classSubject"] ?></td>
                                            <td> <?php echo $r["classDay"] ?></td>
                                            <td>
                                                <?php
                                                // Class Time Checker
                                                if ($r["classTime"] == "08:00:00")
                                                    $time = "8.00 a.m. - 9.00 a.m.";
                                                else if ($r["classTime"] == "09:00:00")
                                                    $time = "9.00 a.m. - 10.00 a.m.";
                                                else if ($r["classTime"] == "13:00:00")
                                                    $time = "1.00 p.m. - 2.00 p.m.";
                                                else if ($r["classTime"] == "14:00:00")
                                                    $time = "2.00 p.m. - 3.00 p.m.";
                                                else if ($r["classTime"] == "15:00:00")
                                                    $time = "3.00 p.m. - 4.00 p.m.";
                                                echo $time
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $r["classLink"]; ?>" class="b">
                                                    <?php echo $r["classLink"] ?>
                                                </a>
                                            </td>
                                            <td> <?php echo $r["totalStudent"] ?></td>
                                            <td> <?php echo $r["userName"] ?></td>
                                            <td> <?php echo $r["userEmail"] ?></td>
                                            <td> <?php echo $r["userPhone"] ?></td>
                                        </tr>
                                        </tr>
                                    <?php
                                            }
                                    ?>
                                    </tr>
                                    </tbody>
                                </table>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php
                        }
                        // Clear results and close the connection
                        mysqli_close($con);
                        mysqli_free_result($res);
                    } else {
                        header("Location: login.php");
                    }
?>
</body>

</html>