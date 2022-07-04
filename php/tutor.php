<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">

    <!-- Image beside title -->
    <link rel="icon" href="../images/icon.ico" />

    <title>Tutor Dashboard</title>
</head>

<body>
    <?php
    // Student Main Page
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 2) {

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        /*while ($r = mysqli_fetch_assoc($res)) {
            echo "<tr><td>" . $r['classTime'] . "</td><td>" . $r['classSubject'] . "</td><td>" . $r['classDay'] . "</td></tr>";
        }*/
    } else {
        header("Location: login.php");
    }

    ?>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="tutor.php">
                        <span class="icon">
                            <img src="../images/logocircle.png" alt="Logo Let Us Score!" id="logoLUS" />
                        </span>
                        <!-- <span class="title">Let Us Score</span> -->
                    </a>
                </li>
                <li>
                    <a href="tutor.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="edit_details.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">User Data</span>
                    </a>
                </li>

                <li>
                    <a href="view_class_tutor.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Class Details</span>
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
                            document.getElementById('current-time').innerHTML = new Date().toString();
                        }, 1);
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
                <span style="color:#192e59">
                    Student
                </span>
                -->
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">Tutor</div>
                        <div class="cardName">
                            <?php
                            $q = "SELECT userName, userGender FROM user WHERE userID=" . $_SESSION['userID'];
                            $res = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($res);
                            echo "<i>" . $r['userName'] . "</i>";
                            ?>
                        </div>
                    </div>
                    <div class="iconBx">
                        <?php
                        // Male Icon
                        if ($r['userGender'] == 1) { ?>
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/eszyyflr.json" trigger="loop" delay="750" colors="primary:#192e59,secondary:#192e59" stroke="80" style="width:80px;height:80px">
                            </lord-icon>
                        <?php
                            // Female Icon
                        } else if ($r['userGender'] == 2) { ?>
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/bwnhdkha.json" trigger="loop" delay="750" colors="primary:#192e59,secondary:#192e59" stroke="80" style="width:80px;height:80px">
                            </lord-icon>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                            // Construct and run query to check for total classes
                            $q = "SELECT count(c.classID) AS total FROM user u, register r,class c WHERE r.registerApproval=1 AND r.classID=c.classID AND u.userID=r.stuID AND u.userID=" . $_SESSION['userID'];
                            $res = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($res);
                            echo $r['total'];
                            ?>
                        </div>
                        <div class="cardName">
                            <i>My Students</i>
                        </div>
                    </div>

                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/zpxybbhl.json" trigger="loop" delay="750" colors="primary:#192e59,secondary:#192e59" stroke="70" style="width:85px;height:85px">
                        </lord-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                            // Construct and run query to check for total classes
                            $q = "SELECT count(c.classID) AS total FROM user u, register r,class c WHERE r.registerApproval=1 AND r.classID=c.classID AND u.userID=r.stuID AND u.userID=" . $_SESSION['userID'];
                            $res = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($res);
                            echo $r['total'];
                            ?>
                        </div>
                        <div class="cardName"><i>My Class</i></div>
                    </div>

                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/osqwjgzg.json" trigger="loop" delay="750" colors="primary:#192e59" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">Class Link</div>
                        <div class="cardName">
                            <i>
                                <a href="mailto:smartetuition@gmail.com">
                                    <ion-icon name="mail-outline"></ion-icon> <b><u>Saturday</u></b>
                                </a>&nbsp;&nbsp;
                                <a href="https://wa.link/cuxs3j" target=_blank">
                                    <ion-icon name="logo-whatsapp"></ion-icon> <b><u>Sunday</u></b>
                                </a>
                            </i>
                        </div>
                    </div>
                    <!--
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/cnyeuzxc.json" trigger="loop" delay="750" colors="primary:#192e59" state="morph-phone-signal-start" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                    -->
                </div>
            </div>

            <!-- ================ TimeTable  ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2><?php
                            $q = "select userName from user where userID=" . $_SESSION['userID'];
                            $res = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($res);
                            echo $r['userName'];
                            ?> 's Tuition Timetable</h2>
                    </div>
                    <?php
                    // Construct and run query to display timetable
                    $q = "SELECT userID, classSubject, classDay, classTime, registerApproval FROM user u, class c, register r WHERE userID=" . $_SESSION['userID'] . " AND u.userID=r.stuID AND r.classID=c.classID AND r.registerApproval=1";
                    $res = mysqli_query($con, $q);
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <td>Time</td>
                                <td>Saturday</td>
                                <td>Sunday</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mathematics -->
                            <tr>
                                <td>8:00 a.m. - 9:00 a.m.</td>
                                <td>
                                    <?php
                                    $r = mysqli_fetch_assoc($res);
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "08:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "08:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <!-- Add. Mathematics -->
                            <tr>
                                <td>9:00 a.m. - 10:00 a.m.</td>
                                <td>
                                    <?php
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "09:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "09:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <!-- Physics -->
                            <tr>
                                <td>1:00 p.m. - 2:00 p.m.</td>
                                <td>
                                    <?php
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "13:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "13:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <!-- Chemistry -->
                            <tr>
                                <td>2:00 p.m. - 3:00 p.m.</td>
                                <td>
                                    <?php
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "14:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "14:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <!-- Biology -->
                            <tr>
                                <td>3:00 p.m. - 4:00 p.m.</td>
                                <td>
                                    <?php
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "15:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "15:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php //mysqli_free_result($res);
                    ?>
                </div>

                <!-- ================= Student's Details ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>My Details</h2>
                    </div>

                    <table>
                        <tr>
                            <td>
                                <h4>
                                    Name<br />
                                    <span>
                                        <?php
                                        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
                                        $res = mysqli_query($con, $q);
                                        $r = mysqli_fetch_assoc($res);
                                        echo $r['userName'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>
                                    Phone<br />
                                    <span>
                                        <?php
                                        $q = "SELECT userPhone FROM user WHERE userID=" . $_SESSION['userID'];
                                        $res = mysqli_query($con, $q);
                                        $r = mysqli_fetch_assoc($res);
                                        echo $r['userPhone'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>
                                    Email<br />
                                    <span>
                                        <?php
                                        $q = "SELECT userEmail FROM user WHERE userID=" . $_SESSION['userID'];
                                        $res = mysqli_query($con, $q);
                                        $r = mysqli_fetch_assoc($res);
                                        echo $r['userEmail'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>
                                    Birthdate<br />
                                    <span>
                                        <?php
                                        $q = "SELECT userBirthdate FROM user WHERE userID=" . $_SESSION['userID'];
                                        $res = mysqli_query($con, $q);
                                        $r = mysqli_fetch_assoc($res);
                                        echo $r['userBirthdate'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>
                                    Gender<br />
                                    <span>
                                        <?php
                                        $q = "SELECT userGender FROM user WHERE userID=" . $_SESSION['userID'];
                                        $res = mysqli_query($con, $q);
                                        $r = mysqli_fetch_assoc($res);
                                        if ($r['userGender'] == 1) // 1 == Male, 2 == Female
                                            $gender = "Male";
                                        else if ($r['userGender'] == 2)
                                            $gender = "Female";
                                        echo $gender;
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>
                                    Address<br />
                                    <span>
                                        <?php
                                        $q = "SELECT userAddress FROM user WHERE userID=" . $_SESSION['userID'];
                                        $res = mysqli_query($con, $q);
                                        $r = mysqli_fetch_assoc($res);
                                        echo $r['userAddress'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- JS scripts -->
    <script src="../js/dash.js"></script>
    <script src="../js/script.js"></script>
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